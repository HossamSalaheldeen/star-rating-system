<?php

namespace App\Http\Controllers\Admin;

use App\Enums\NotificationEnum;
use App\Enums\ScoreStatusEnum;
use App\Enums\ScoreStringTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Score;
use App\Models\SmartGoal;
use App\Models\Team;
use App\Models\User;
use App\Notifications\GlobalNotification;
use App\Services\Notification\NotifyTeamService;
use App\Services\Notification\NotifyUserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $type
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(Request $request, $type)
    {
        if ( !$this->isTypeValid($type) )
            return redirect()->route('admin.scores.index', [ 'type' => ScoreStringTypeEnum::TEAMS ]);

        $filterData          = $request->only('name');
        $filterData[ $type ] = true;
        $scores              = Score::filter($filterData)
                                    ->with(['answer.participantable', 'answer.training'])
                                    ->whereHas('answer', function (Builder $query) {
                                        $query->whereHasMorph(
                                            'participantable',
                                            [User::class, Team::class],
                                            function (Builder $query, $type) {
                                                $query->when($type === User::class,function (Builder $query){
                                                    $query->forParent(Auth::id());
                                                },function (Builder $query){
                                                    $query->forCreator(Auth::id());
                                                });
                                            }
                                        );
                                    })
            ->paginate(20);

        if ( $request->ajax() )
            return \view('admin.scores.partials.index-tabs.' . $type, compact('scores'));

        return view('admin.scores.index', compact('scores'));
    }

    private function isTypeValid($type)
    {
        $types = [ ScoreStringTypeEnum::TEAMS,ScoreStringTypeEnum::INDIVIDUALS ];
        return in_array($type, $types);
    }


    /**
     * Display the specified resource.
     *
     * @param $type
     * @param Score $score
     * @return Application|Factory|View|RedirectResponse|Response
     */
    public function show($type, Score $score)
    {
        if ( !$this->isTypeValid($type) )
            return redirect()->route('admin.scores.index', [ 'type' => ScoreStringTypeEnum::TEAMS ]);

        $score->load([
            'answer.plans.message',
            'answer.plans.channel',
            'answer.plans.image',
        ]);
        return view('admin.scores.show', compact('score'));
    }

    public function publish(Score $score, Request $request)
    {
        $this->authorize('publish', $score);

        $request->validate([
            'scores'                 => [ 'required', 'array', 'distinct', 'filled' ],
            'scores.*'               => [ 'required', 'array', 'distinct', 'filled' ],
            'scores.*.score'         => [ 'required', 'integer', 'min:0', 'max:10' ],
            'scores.*.smart_goal_id' => [ 'required', 'exists:smart_goals,id' ],
        ]);
        $totalSmartGoalScore = 0;
        foreach ( $request->scores as $scoreData ) {
            SmartGoal::where('id', $scoreData[ 'smart_goal_id' ])->update([ 'score' => $scoreData[ 'score' ]]);
            $totalSmartGoalScore += $scoreData[ 'score' ];
        }
        $score->update([
            'status'           => ScoreStatusEnum::PUBLISHED,
            'smart_goal_score' => $totalSmartGoalScore * 0.5,
            'smart_goal_percentage' => $totalSmartGoalScore / (count($request->scores) * 10) * 0.5
        ]);

        $this->notifyParticipants($score);

        return SuccessResource::make([
            'message'  => 'score published successfully',
            'redirect' => route('admin.scores.index', [ 'type' => 'teams' ])
        ]);
    }

    private function notifyParticipants($score)
    {
        $participantable = $score->answer->participantable;
        if ( $participantable instanceof User )
            NotifyUserService::make()->handle(customCollect([
                'users'        => [ $participantable ],
                'notification' => new GlobalNotification(NotificationEnum::USER_SCORE_PUBLISHED, [ 'type' => ScoreStringTypeEnum::INDIVIDUALS, 'score' => $score->id ], 'System')
            ]));
        else if ( $participantable instanceof Team )
            NotifyTeamService::make()->handle(customCollect([
                'teams'               => [ $participantable ],
                'leaderNotification'  => new GlobalNotification(NotificationEnum::TEAM_LEADER_SCORE_PUBLISHED, [ 'type' => ScoreStringTypeEnum::TEAMS, 'score' => $score->id ], 'System'),
                'membersNotification' => new GlobalNotification(NotificationEnum::TEAM_MEMBER_SCORE_PUBLISHED, [ 'type' => ScoreStringTypeEnum::TEAMS, 'score' => $score->id ], 'System'),
            ]));
    }


}
