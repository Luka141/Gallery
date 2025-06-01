@foreach($images as $image)
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

    <div class="gallery-item fade-in-on-load image-item" data-type="image">
        <div class="gallery-item-wrapper">
            <a href="{{ route('gallery.image.show', $image->id) }}">
                <img src="{{ $fullPath }}"
                     alt="{{ $image->title ?? 'Image' }}"
                     loading="lazy"
                     onload="this.classList.add('loaded')"
                     onerror="console.log('Image load error:', this.src); this.style.border='2px solid red';">
                <div class="item-overlay">
                    <div class="overlay-content">
                        <i class="fas fa-eye"></i>
                        <p class="overlay-title">{{ $image->title ?? 'Image' }}</p>
                        @if(!empty($image->description))
                            <p class="overlay-description">{{ Str::limit($image->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>
@endforeach
