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
        <p class="gallery-subtitle">Gallery</p>
    </div>

    <div class="filter-controls">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="image">Images</button>
        <button class="filter-btn" data-filter="video">Videos</button>
    </div>

    <div class="gallery-grid" id="gallery-grid">
        @include('gallery.images')
        
        @include('gallery.videos')
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection