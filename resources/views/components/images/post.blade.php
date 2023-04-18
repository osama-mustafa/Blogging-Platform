@props([
        'post',
        'width',
        'height',
        'postImage',
        'defaultImage',
        'class'
    ])

@if ($post->image)
    <img 
        src="{{ $postImage }}"
        width="{{ $width }}"
        height="{{ $height}}"
        class="{{ $class }}"
    >
@else
    <img
        src="{{ $defaultImage }}"
        width="{{ $width }}"
        height="{{ $height }}"
        class="{{ $class }}"
    >
@endif
