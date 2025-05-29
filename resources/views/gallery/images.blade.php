@foreach($images as $image)
<div class="gallery-item" data-type="image">
    <a href="{{ route('gallery.show', $image->id) }}" data-lightbox="gallery" data-title="{{ $image->title }}">
        <img src="{{ $image->fullImgFileUrl() }}" alt="{{ $image->title }}" loading="lazy">
    </a>
    <div class="item-caption">
        <h5>{{ $image->title }}</h5>
        @if($image->description)
            <p class="item-description" title="{{ $image->description }}">{{ $image->description }}</p>
        @endif
    </div>
</div>
@endforeach