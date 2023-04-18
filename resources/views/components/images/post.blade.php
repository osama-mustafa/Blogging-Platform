@props([
        'post',
        'width',
        'height',
        'postImage',
        'defaultImage'
    ])

@if ($post->image)
    <img 
        src="{{ $postImage }}"
        width="{{ $width }}"
        height="{{ $height}}"
    >
@else
    <img
        src="{{ $defaultImage }}"
        width="{{ $width }}"
        height="{{ $height }}"
    >
@endif
