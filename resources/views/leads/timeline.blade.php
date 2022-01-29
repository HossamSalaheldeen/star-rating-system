<ul class="timeline">
    @forelse($timelines as $timeline)
        <li class="event">
            <a href="" data-date="{{$timeline->created_at}}">New Web Design</a>
            <p>{{$timeline->description}}</p>
        </li>
    @empty
        <li class="event">
            <p>No timeline yet!</p>
        </li>
    @endforelse
</ul>
