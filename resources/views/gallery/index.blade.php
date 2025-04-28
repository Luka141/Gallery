@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="my-4">Gallery</h1>
    
    <div class="filter-controls mb-4">
        <button class="btn btn-primary filter-btn active" data-filter="all">All</button>
        <button class="btn btn-outline-primary filter-btn" data-filter="image">Image</button>
        <button class="btn btn-outline-primary filter-btn" data-filter="video">Video</button>
    </div>
    
    <div class="gallery-grid">
        @foreach($images as $image)
            <div class="gallery-item" data-type="image">
                <a href="{{ $image->fullImgFileUrl() }}" data-lightbox="gallery" data-title="{{ $image->title }}">
                    <img src="{{ $image->fullImgFileUrl() }}" alt="{{ $image->title }}">
                </a>
                <div class="item-caption">
                    <h5>{{ $image->title }}</h5>
                    @if($image->description)
                        <p class="item-description">{{ $image->description }}</p>
                    @endif
                </div>
            </div>
        @endforeach
       
        @foreach($videos as $video)
            <div class="gallery-item" data-type="video">
                <div class="video-container">
                    <video controls poster="{{ $video->getThumbnailFullUrl() }}">
                        <source src="{{ $video->getVideoFullUrl() }}" type="video/mp4">
                        loading
                    </video>
                </div>
                <div class="item-caption">
                    <h5>{{ $video->title }}</h5>
                    @if($video->description)
                        <p class="item-description">{{ $video->description }}</p>
                    @endif
                </div>
            </div>
        @endforeach
        
        @if($images->isEmpty() && $videos->isEmpty())
            <div class="col-12 text-center">
                <p>Empty</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
@endsection

@section('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/lightbox-init.js') }}"></script>
@endsection