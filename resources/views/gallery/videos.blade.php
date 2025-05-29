@foreach($videos as $video)
<div class="gallery-item" data-type="video">
    <div class="video-container">
        <video controls poster="{{ $video->getThumbnailFullUrl() }}" preload="metadata">
            <source src="{{ $video->getVideoFullUrl() }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="item-caption">
        <h5>{{ $video->title }}</h5>
        @if($video->description)
            <p class="item-description" title="{{ $video->description }}">{{ $video->description }}</p>
        @endif
    </div>
</div>
@endforeach