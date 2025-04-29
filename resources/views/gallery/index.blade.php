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
@endsection

@section('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/lightbox-init.js') }}"></script>
@endsection