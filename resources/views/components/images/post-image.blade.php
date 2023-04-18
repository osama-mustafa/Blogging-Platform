@props(['post', 'width', 'height'])
@if ($post->image)
        <img src="{{ asset('storage/images') }}/{{$post->image}}" class="img-thumbnail" width="{{$width}}" height="{{$height}}" alt="">
@else
        <img src="{{ asset('img/post.png') }}" class="img-thumbnail" width="{{$width}}" height="{{$height}}" alt="">
@endif
