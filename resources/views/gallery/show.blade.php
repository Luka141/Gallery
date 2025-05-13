@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="back-button-container">
        <a href="{{ url()->previous() }}" class="back-button">
            <svg class="back-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Go back
        </a>
    </div>

    <div class="content-card">

        <div class="mobile-title">
            <h1 class="image-title-mobile">
                {{ $image->title ?? $video->title ?? 'Untitled' }}
            </h1>
        </div>

        <div class="content-wrapper">
            <div class="image-container">
                <div class="image-wrapper">
                    <div class="image-box">

                        @if(isset($image))
                            <img src="{{ $image->file_url ?? $image->fullImgFileUrl() }}" alt="{{ $image->title }}" class="main-image">
                            <a href="{{ $image->file_url ?? $image->fullImgFileUrl() }}" class="zoom-button" data-lightbox="image-gallery" data-title="{{ $image->title }}">
                                <svg class="zoom-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                </svg>
                            </a>
                        @endif

                        @if(isset($video))
                            <video controls width="100%" class="main-image">
                                <source src="{{ $video->file_url ?? asset('storage/' . $video->file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                    </div>
                </div>
            </div>

            <div class="details-container">
                <div class="desktop-title">
                    <h1 class="image-title-desktop">
                        {{ $image->title ?? $video->title ?? 'Untitled' }}
                    </h1>
                </div>

                @if(($image->description ?? null) || ($video->description ?? null))
                    <div class="description-container">
                        <p class="description-text">
                            {{ $image->description ?? $video->description }}
                        </p>
                    </div>
                @endif

                @if(isset($image) && isset($image->content) && is_array($image->content))
                    @php 
                        $hasMetaInfo = false;
                        $metaData = [];

                        foreach($image->content as $block) {
                            if($block['type'] === 'image_info') {
                                $hasMetaInfo = true;
                                $metaData = $block['data'];
                                break;
                            }
                        }
                    @endphp

                    <div class="meta-info">
                        <h2 class="meta-title">More Information</h2>

                        @if($hasMetaInfo)
                            @if(!empty($metaData['artist']))
                                <div class="meta-item">
                                    <strong>Author:</strong> {{ $metaData['artist'] }}
                                </div>
                            @endif
                            @if(!empty($metaData['year']))
                                <div class="meta-item">
                                    <strong>Year:</strong> {{ $metaData['year'] }}
                                </div>
                            @endif
                            @if(!empty($metaData['technique']))
                                <div class="meta-item">
                                    <strong>Technique:</strong> {{ $metaData['technique'] }}
                                </div>
                            @endif
                            @if(!empty($metaData['size']))
                                <div class="meta-item">
                                    <strong>Size:</strong> {{ $metaData['size'] }}
                                </div>
                            @endif
                        @else
                            <p class="no-info">No information</p>
                        @endif
                    </div>

                    @php
                        $hasAdditionalContent = false;
                        if (isset($image->content) && is_array($image->content)) {
                            foreach($image->content as $block) {
                                if(in_array($block['type'], ['heading', 'paragraph']) && !empty($block['data']['content'])) {
                                    $hasAdditionalContent = true;
                                    break;
                                }
                            }
                        }
                    @endphp

                    @if($hasAdditionalContent)
                        <div class="meta-info">
                            <h2 class="meta-title">More Information</h2>
                            @foreach($image->content as $block)
                                @if($block['type'] === 'heading')
                                    <h3 class="meta-item" style="font-weight: 600;">{{ $block['data']['content'] }}</h3>
                                @elseif($block['type'] === 'paragraph')
                                    <div class="meta-item description-text">
                                        {!! $block['data']['content'] !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endif

                @if(isset($video) && isset($video->content) && is_array($video->content))
                    @php 
                        $hasVideoMetaInfo = false;
                        $videoMetaData = [];

                        foreach($video->content as $block) {
                            if($block['type'] === 'video_info') {
                                $hasVideoMetaInfo = true;
                                $videoMetaData = $block['data'];
                                break;
                            }
                        }
                    @endphp

                    <div class="meta-info">
                        <h2 class="meta-title">Video Information</h2>

                        @if($hasVideoMetaInfo)
                            @if(!empty($videoMetaData['creator']))
                                <div class="meta-item">
                                    <strong>Creator:</strong> {{ $videoMetaData['creator'] }}
                                </div>
                            @endif
                            @if(!empty($videoMetaData['year']))
                                <div class="meta-item">
                                    <strong>Year:</strong> {{ $videoMetaData['year'] }}
                                </div>
                            @endif
                            @if(!empty($videoMetaData['duration']))
                                <div class="meta-item">
                                    <strong>Duration:</strong> {{ $videoMetaData['duration'] }}
                                </div>
                            @endif
                            @if(!empty($videoMetaData['resolution']))
                                <div class="meta-item">
                                    <strong>Resolution:</strong> {{ $videoMetaData['resolution'] }}
                                </div>
                            @endif
                        @else
                            <p class="no-info">No video information</p>
                        @endif
                    </div>

                    @php
                        $hasVideoAdditionalContent = false;
                        if (isset($video->content) && is_array($video->content)) {
                            foreach($video->content as $block) {
                                if(in_array($block['type'], ['heading', 'paragraph']) && !empty($block['data']['content'])) {
                                    $hasVideoAdditionalContent = true;
                                    break;
                                }
                            }
                        }
                    @endphp

                    @if($hasVideoAdditionalContent)
                        <div class="meta-info">
                            <h2 class="meta-title">More Information</h2>
                            @foreach($video->content as $block)
                                @if($block['type'] === 'heading')
                                    <h3 class="meta-item" style="font-weight: 600;">{{ $block['data']['content'] }}</h3>
                                @elseif($block['type'] === 'paragraph')
                                    <div class="meta-item description-text">
                                        {!! $block['data']['content'] !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/show.js') }}"></script>
@endsection