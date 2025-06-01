@foreach($videos as $video)
    @php
        $videoPath = $video->path ?? $video->url ?? $video->file_path ?? '';
        $thumbnailPath = $video->thumbnail_path ?? $video->thumbnail ?? $video->poster ?? '';

        if (str_starts_with($videoPath, 'storage/')) {
            $fullVideoPath = asset($videoPath);
        } elseif (str_starts_with($videoPath, 'http')) {
            $fullVideoPath = $videoPath;
        } else {
            $fullVideoPath = asset('storage/' . $videoPath);
        }

        $fullThumbnailPath = '';
        if (!empty($thumbnailPath)) {
            if (str_starts_with($thumbnailPath, 'storage/')) {
                $fullThumbnailPath = asset($thumbnailPath);
            } elseif (str_starts_with($thumbnailPath, 'http')) {
                $fullThumbnailPath = $thumbnailPath;
            } else {
                $fullThumbnailPath = asset('storage/' . $thumbnailPath);
            }
        } else {
            $videoName = pathinfo($videoPath, PATHINFO_FILENAME);
            $videoDir = dirname($videoPath);
            $autoThumbnail = $videoDir . '/' . $videoName . '.jpg';
            $fullThumbnailPath = asset('storage/' . $autoThumbnail);
        }
    @endphp

    <div class="gallery-item fade-in-on-load video-item" data-type="video">
        <div class="gallery-item-wrapper video-wrapper">
            <a href="{{ route('gallery.video.show', $video->id) }}">
                <div class="video-container">
                    <video preload="metadata"
                           @if($fullThumbnailPath) poster="{{ $fullThumbnailPath }}" @endif
                           onloadeddata="this.classList.add('loaded')"
                           muted>
                        <source src="{{ $fullVideoPath }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <div class="video-play-overlay">
                        <div class="overlay-content">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Standard overlay info -->
                <div class="item-overlay">
                    <div class="overlay-content">
                        <i class="fas fa-play"></i>
                        <p class="overlay-title">{{ $video->title ?? 'Video' }}</p>
                        @if(!empty($video->description))
                            <p class="overlay-description">{{ Str::limit($video->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>
@endforeach