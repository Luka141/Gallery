document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    initializeFilters();

    function initializeFilters() {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', handleFilterClick);
        });
    }

    function handleFilterClick(event) {
        const clickedBtn = event.target;
        
        filterBtns.forEach(btn => btn.classList.remove('active'));
        
        clickedBtn.classList.add('active');

        const filterValue = clickedBtn.getAttribute('data-filter');

        filterGalleryItems(filterValue);
    }

    function filterGalleryItems(filterValue) {
        galleryItems.forEach(item => {
            const itemType = item.getAttribute('data-type');
            
            if (filterValue === 'all' || itemType === filterValue) {
                showItem(item);
            } else {
                hideItem(item);
            }
        });
    }

    function showItem(item) {
        item.style.display = 'block';
        item.classList.remove('hidden');
        item.classList.add('visible');
    }

    function hideItem(item) {
        item.classList.add('hidden');
        item.classList.remove('visible');
        
        setTimeout(() => {
            if (item.classList.contains('hidden')) {
                item.style.display = 'none';
            }
        }, 300);
    }

    function animateNewItems() {
        const newItems = document.querySelectorAll('.gallery-item:not(.animated)');
        
        newItems.forEach((item, index) => {
            item.classList.add('animated');
            item.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // Call this function if you add new gallery items dynamically
    window.refreshGalleryAnimation = animateNewItems;
});