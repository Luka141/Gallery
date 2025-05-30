// Gallery JavaScript Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize gallery
    initializeGallery();
    setupFilters();
    setupLightbox();
    setupVideoPlayers();
});

function initializeGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const sizes = ['size-1x1', 'size-2x1', 'size-1x2', 'size-2x2'];
    
    // Assign random sizes to gallery items
    galleryItems.forEach((item, index) => {
        let sizeClass;
        
        // Strategic size assignment
        if (index === 0 || index === 5) {
            sizeClass = 'size-2x2'; // Make some items larger
        } else if (index % 4 === 0) {
            sizeClass = 'size-2x1';
        } else if (index % 6 === 0) {
            sizeClass = 'size-1x2';
        } else {
            sizeClass = 'size-1x1';
        }
        
        item.classList.add(sizeClass);
    });
}

function setupFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Filter items with animation
            filterItems(galleryItems, filter);
        });
    });
}

function filterItems(items, filter) {
    items.forEach((item, index) => {
        const itemType = item.getAttribute('data-type');
        
        if (filter === 'all' || itemType === filter) {
            // Show item with delay for stagger effect
            setTimeout(() => {
                item.classList.remove('hidden');
                item.style.animation = `fadeInUp 0.6s ease-out ${index * 0.1}s both`;
            }, index * 50);
        } else {
            // Hide item immediately
            item.classList.add('hidden');
        }
    });
}

function setupLightbox() {
    // Configure lightbox if available
    if (typeof lightbox !== 'undefined') {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': false,
            'positionFromTop': 50
        });
    }
}

function setupVideoPlayers() {
    const videoPlayBtns = document.querySelectorAll('.video-play-btn');
    
    videoPlayBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const videoItem = this.closest('.gallery-item');
            const videoUrl = videoItem.getAttribute('data-video-url');
            
            if (videoUrl) {
                openVideoModal(videoUrl);
            } else {
                // Fallback for demo
                console.log('Video player would open here');
                alert('Video functionality - URL: ' + (videoUrl || 'demo video'));
            }
        });
    });
}

function openVideoModal(videoUrl) {
    // Create video modal
    const modal = document.createElement('div');
    modal.className = 'video-modal';
    modal.innerHTML = `
        <div class="video-modal-content">
            <span class="video-modal-close">&times;</span>
            <video controls autoplay>
                <source src="${videoUrl}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    `;
    
    // Add modal styles
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    `;
    
    modal.querySelector('.video-modal-content').style.cssText = `
        position: relative;
        max-width: 90%;
        max-height: 90%;
    `;
    
    modal.querySelector('video').style.cssText = `
        width: 100%;
        height: auto;
        max-height: 80vh;
    `;
    
    modal.querySelector('.video-modal-close').style.cssText = `
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        z-index: 10000;
    `;
    
    document.body.appendChild(modal);
    
    // Close modal functionality
    const closeModal = () => {
        document.body.removeChild(modal);
    };
    
    modal.querySelector('.video-modal-close').addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
}

// Utility function for responsive grid
function handleResize() {
    const galleryGrid = document.querySelector('.gallery-grid');
    const containerWidth = galleryGrid.offsetWidth;
    
    // Adjust grid based on container width
    if (containerWidth < 480) {
        galleryGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(100px, 1fr))';
    } else if (containerWidth < 768) {
        galleryGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(120px, 1fr))';
    } else {
        galleryGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(150px, 1fr))';
    }
}

// Add resize listener
window.addEventListener('resize', debounce(handleResize, 300));

// Debounce utility function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Lazy loading for images
function setupLazyLoading() {
    const images = document.querySelectorAll('.gallery-item img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize lazy loading if supported
if ('IntersectionObserver' in window) {
    setupLazyLoading();
}