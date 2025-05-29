@extends('layouts.app')

@section('content')
<div class="modern-gallery-container">
    <div class="gallery-header">
        <h1>Gallery</h1>
        <p class="gallery-subtitle">???</p>
    </div>

    <div class="filter-controls">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="image">Images</button>
        <button class="filter-btn" data-filter="video">Videos</button>
    </div>

    <div class="gallery-grid">
        @include('gallery.images')
        @include('gallery.videos')
    </div>
</div>
@endsection

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('js/gallery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>
@endsection

@section('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="{{ asset('js/lightbox-init.js') }}"></script>
@endsection