<?php

namespace App\Models;

use App\Enums\ExampleEnum;
use App\Enums\UserStatusEnum;
use App\Filters\Settings\UserFilter;
use App\Traits\HasActionsRelations;
use App\Traits\HasActiveScope;
use App\Traits\HasSelect;
use App\Traits\HasSort;
use Filter\Traits\HasFilter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use  HasFactory, Notifiable, HasRoles, HasSelect, HasFilter , HasSort, HasActionsRelations,HasActiveScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable
        = [
            'id',
            'name',
            'email',
            'password',
            'code',
            'initial_job_code',
            'manager_id',
            'department_id',
            'enterprise_id',
            'branch_id',
            'is_active',
            'remember_token',
            'created_by',
            'updated_by',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    protected $sortable = [
        'name','email'
    ];


    protected $selectable = [
        'id','name','email'
    ];




    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    /**
     * @return mixed
     * get formatted created at
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->toDateTimeString();
    }


    public function getFilterClassName()
    {
        return UserFilter::class;
    }

    public function isPasswordChanged()
    {
        return $this->passwordHistories()->exists();
    }

    public function isOwner()
    {
        return !$this->roles()->exists();
    }


    //########################################### Mutators #################################################

    /**
     * @param $value
     * hashing password when saving
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    //########################################### Scopes ###################################################

    public function scopeNotOwner($q)
    {
        return $q->whereHas('roles');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active',true);
    }


    //########################################### Relations ################################################

    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    public function manager()
    {
        return $this->belongsTo(self::class,'manager_id');
    }

    public function staff()
    {
        return $this->hasMany(self::class,'manager_id');
    }

    public function childStaff() {
        return $this->hasMany(self::class,'manager_id')->with('staff');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'created_by');
    }

    public function refererLeads()
    {
        return $this->hasMany(Lead::class,'referrer_id');
    }

    public function viewerOn()
    {
        return $this->belongsToMany(User::class, 'user_viewer', 'user_id', 'viewer_id');
    }

    public function viewedBy()
    {
        return $this->belongsToMany(User::class, 'user_viewer', 'viewer_id', 'user_id');
    }
}
