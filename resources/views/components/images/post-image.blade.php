@props([
        'post',
        'width',
        'height',
        'imagePath',
        'defaultImagePath'
    ])

@if ($post->image)
    <img src="{{ $imagePath }}/{{$post->image}}" class="img-thumbnail" width="{{$width}}" height="{{$height}}" alt="">
@else
    <img src="{{ $defaultImagePath }}" class="img-thumbnail" width="{{$width}}" height="{{$height}}" alt="">
@endif
