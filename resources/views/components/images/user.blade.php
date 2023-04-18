@props([
        'user',
        'userImage',
        'defaultImage',
        'width' => '100',
        'height' => '100',
        'class' => ''
    ])

<div>
    @if ($user->image)
        <img 
            width="{{ $width }}"
            height="{{ $height }}"
            src="{{ $userImage }}"
            class="{{ $class }}"
        >
    @else
        <img 
            width="{{ $width }}"
            height="{{ $height }}"
            src="{{ $defaultImage }}"
            class="{{ $class }}"
        >
    @endif

</div>
