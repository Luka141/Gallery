@foreach($videos as $video)
<div class="gallery-item" data-type="video">
    <a href="{{ route('video.show', $video->id) }}">
        <div class="video-container" style="position: relative;">
            <video controls poster="{{ $video->getThumbnailFullUrl() }}">
                <source src="{{ $video->getVideoFullUrl() }}" type="video/mp4">
                loading
            </video> 
        </div>
    </a>
    <div class="item-caption">
        <h5>{{ $video->title }}</h5>
        @if($video->description)
            <p class="item-description" title="{{ $video->description }}">{{ $video->description }}</p>
        @endif
    </div>
</div>
@endforeach
