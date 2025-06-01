@extends('layouts.app')

@section('title', 'Gallery')

@section('head')
<link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="modern-gallery-container">
    <div class="gallery-header">
        <h1>Gallery</h1>
        <p class="gallery-subtitle">Discover our collection</p>
    </div>

    <div class="gallery-grid" id="gallery-grid">
        @include('gallery.images')
        @include('gallery.videos')
    </div>

    <div class="random-section">
        <h2 class="section-title">Random Images</h2>
        <div class="gallery-grid random-images" data-type="image">
            @foreach($randomImages as $image)
                <div class="gallery-item image-item">
                    @php
                        $imagePath = $image->path ?? $image->url ?? $image->file_path ?? '';
                        
                        if (str_starts_with($imagePath, 'storage/')) {
                            $fullPath = asset($imagePath);
                        } elseif (str_starts_with($imagePath, 'http')) {
                            $fullPath = $imagePath;
                        } else {
                            $fullPath = asset('storage/' . $imagePath);
                        }
                    @endphp
                    
                    <div class="gallery-item-wrapper">
                        <a href="{{ route('gallery.image.show', $image->id) }}">
                            <img src="{{ $fullPath }}" alt="{{ $image->title ?? 'Random Image' }}" loading="lazy" 
                                 onerror="console.log('Image load error:', this.src); this.style.border='2px solid red';">
                            <div class="item-overlay">
                                <div class="overlay-content">
                                    <i class="fas fa-eye"></i>
                                    <p class="overlay-title">{{ $image->title ?? 'Random Image' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="random-section">
    <h2 class="section-title">Random Videos</h2>
    <div class="gallery-grid random-videos" data-type="video">
        @foreach($randomVideos as $video)
            @php
                $videoPath = $video->path ?? $video->url ?? $video->file_path ?? '';
                $thumbnailPath = $video->thumbnail_path ?? $video->thumbnail ?? '';
                
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
            
      <div class="gallery-item-wrapper video-wrapper">
    <a href="{{ route('gallery.video.show', $video->id) }}">
        <div class="video-container">
            <video preload="metadata" 
                   @if($fullThumbnailPath) poster="{{ $fullThumbnailPath }}" @endif
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
        <p class="overlay-title">{{ $video->title ?? 'Random Video' }}</p>
    </a>
</div>

          @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/gallery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection