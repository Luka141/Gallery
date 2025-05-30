@foreach($images as $image)
    <div class="gallery-item fade-in-on-load" data-type="image">
        <a href="{{ route('gallery.show', $image->id) }}" data-lightbox="gallery" data-title="{{ $image->title }}">
            <img src="{{ $image->fullImgFileUrl() }}" alt="{{ $image->title }}" loading="lazy"
                 onload="this.classList.add('loaded')">
        </a>
        <div class="item-overlay">
            <div class="item-title">{{ $image->title }}</div>
            @if($image->description)
                <div class="item-description">
                    {{ Str::limit($image->description, 100) }}
                </div>
            @endif
        </div>
    </div>
@endforeach

