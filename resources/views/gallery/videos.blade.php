@foreach($videos as $video)
    <div class="gallery-item fade-in-on-load" data-type="video">
        <div class="video-container">
            <video controls poster="{{ $video->getThumbnailFullUrl() }}"
                   preload="metadata"
                   onloadeddata="this.classList.add('loaded')">
                <source src="{{ $video->getVideoFullUrl() }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="item-overlay">
            <div class="item-title">{{ $video->title }}</div>
            @if($video->description)
                <div class="item-description">{{ Str::limit($video->description, 100) }}</div>
            @endif
        </div>
    </div>
@endforeach