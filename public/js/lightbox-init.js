document.addEventListener('DOMContentLoaded', function() {
    if (typeof lightbox !== 'undefined') {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Image %1 of %2",
            'alwaysShowNavOnTouchDevices': false,
            'fadeDuration': 300,
            'imageFadeDuration': 300,
            'positionFromTop': 50,
            'showImageNumberLabel': true,
            'disableScrolling': true
        });
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            if (typeof lightbox !== 'undefined' && lightbox.album.length > 0) {
                lightbox.end();
            }
        }
    });

    const galleryImages = document.querySelectorAll('.gallery-item img');
    
    galleryImages.forEach(img => {
        img.addEventListener('load', function() {
            this.classList.add('loaded');
        });
        
        if (img.complete) {
            img.classList.add('loaded');
        }
    });
});