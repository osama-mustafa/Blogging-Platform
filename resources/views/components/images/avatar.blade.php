@props(['user'])

<div>
    <!-- Profile image -->
    @if ($user->image)
        <div>
            <img class="big-avatar mb-3" src="{{ asset('storage/images/') }}/{{ $user->image }}" alt="avatar">
        </div>
    @else
        <div>
            <img class="big-avatar mb-3" src="{{ asset('/img/profile.png') }}" alt="avatar">
        </div>
    @endif

</div>