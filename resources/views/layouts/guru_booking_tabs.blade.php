<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link @if(@$tab == 'upcoming') active @endif" href="{{ route('gurubookings.upcoming') }}"  role="tab">Upcoming</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(@$tab == 'past') active @endif" href="{{ route('gurubookings.past') }}" role="tab">Past</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(@$tab == 'available') active @endif" href="{{ route('gurubookings.available') }}"  role="tab">Available</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(@$tab == 'pending') active @endif" href="{{ route('gurubookings.pendingRequested') }}" role="tab">Pending requested</a>
    </li>
</ul>