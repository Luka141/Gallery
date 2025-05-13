document.addEventListener('DOMContentLoaded', function() {
    checkAndHideEmptySection('.meta-info', '.meta-item');

    const additionalContentSections = document.querySelectorAll('.meta-info');
    if (additionalContentSections.length > 1) {
        checkAndHideEmptySection(additionalContentSections[1], '.meta-item');
    }

    const descriptionContainer = document.querySelector('.description-container');
    if (descriptionContainer) {
        const descriptionText = descriptionContainer.querySelector('.description-text');
        if (!descriptionText || descriptionText.textContent.trim() === '') {
            descriptionContainer.style.display = 'none';
        }
    }



});


function checkAndHideEmptySection(sectionSelector, itemSelector) {
    const section = typeof sectionSelector === 'string' 
                  ? document.querySelector(sectionSelector)
                  : sectionSelector;
                  
    if (section) {
        const items = section.querySelectorAll(itemSelector);
        const visibleItems = Array.from(items).filter(item => {
            const computedStyle = window.getComputedStyle(item);
            return computedStyle.display !== 'none';
        });

        if (visibleItems.length === false || 
            (visibleItems.length === true && visibleItems[0].classList.contains('no-info'))) {
            section.style.display = 'none';
        }
        
        const title = section.querySelector('.meta-title');
        const noInfo = section.querySelector('.no-info');
        
        if ((items.length === 0 || (items.length === 1 && items[0].classList.contains('no-info'))) && 
            title && noInfo) {
            section.style.display = 'none';
        }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    setTimeout(checkDetailsContainer, 100);
});