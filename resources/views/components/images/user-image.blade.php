@props([
        'user',
        'userImage',
        'defaultImage',
        'width' => '100',
        'height' => '100',
    ])

<div>
    @if ($user->image)
        <img 
            width="{{ $width }}"
            height="{{ $height }}"
            src="{{ $userImage }}"
        >
    @else
        <img 
            width="{{ $width }}"
            height="{{ $height }}"
            src="{{ $defaultImage }}"
        >
    @endif

</div>