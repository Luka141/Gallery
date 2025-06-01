document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-nav-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const galleryGrids = document.querySelectorAll('.gallery-grid');
    const dropdownToggle = document.getElementById('galleryFilterDropdown');
    
    let isFiltering = false;
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (isFiltering) return;
            
            isFiltering = true;
            
            showLoadingEffect();
            
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            this.classList.add('active');
            
            const filterType = this.getAttribute('data-filter');
            
            updateDropdownText(this.textContent.trim());
            
            setTimeout(() => {
                filterGalleryItems(filterType);
                filterRandomSections(filterType);
                hideLoadingEffect();
                isFiltering = false;
            }, 300);
        });
        
        button.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(5px) scale(1.02)';
            }
        });
        
        button.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(0) scale(1)';
            }
        });
    });
    
    /**
     */
    function showLoadingEffect() {
        const loadingOverlay = createLoadingOverlay();
        document.body.appendChild(loadingOverlay);
        
        setTimeout(() => {
            loadingOverlay.style.opacity = '1';
        }, 10);
    }
    
    /**
     */
    function hideLoadingEffect() {
        const loadingOverlay = document.querySelector('.filter-loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.style.opacity = '0';
            setTimeout(() => {
                loadingOverlay.remove();
            }, 300);
        }
    }
    
    /**
     */
    function createLoadingOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'filter-loading-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        `;
        
        const spinner = document.createElement('div');
        spinner.style.cssText = `
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        `;
        
        if (!document.querySelector('#spinner-animation')) {
            const style = document.createElement('style');
            style.id = 'spinner-animation';
            style.textContent = `
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
        }
        
        overlay.appendChild(spinner);
        return overlay;
    }
    
    /**
     */
    function updateDropdownText(newText) {
        if (dropdownToggle) {
          
            dropdownToggle.style.transition = 'opacity 0.2s ease';
            dropdownToggle.style.opacity = '0.5';
            
            setTimeout(() => {
                dropdownToggle.textContent = newText;
                dropdownToggle.style.opacity = '1';
                
                dropdownToggle.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    dropdownToggle.style.transform = 'scale(1)';
                }, 150);
            }, 200);
        }
    }
    
    /**
    
     * @param {string} filterType 
     */
    function filterGalleryItems(filterType) {
        galleryGrids.forEach(grid => {
            const items = grid.querySelectorAll('.gallery-item');
            
            items.forEach((item, index) => {
                setTimeout(() => {
                    if (filterType === 'all') {
                        showItem(item);
                    } else {
                        if (item.classList.contains(filterType + '-item')) {
                            showItem(item);
                        } else {
                            hideItem(item);
                        }
                    }
                }, index * 50); 
            });
        });
    }
    
  
    function showItem(item) {
        item.style.transition = 'all 0.4s ease';
        item.style.display = 'block';
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px) scale(0.9)';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0) scale(1)';
        }, 10);
    }
    
   
    function hideItem(item) {
        item.style.transition = 'all 0.3s ease';
        item.style.opacity = '0';
        item.style.transform = 'translateY(-20px) scale(0.9)';
        
        setTimeout(() => {
            item.style.display = 'none';
        }, 300);
    }
    
    /**
     * @param {string} filterType - 
     */
    function filterRandomSections(filterType) {
        const randomSections = document.querySelectorAll('.random-section');
        
        randomSections.forEach((section, index) => {
            const sectionGrid = section.querySelector('.gallery-grid');
            
            if (sectionGrid) {
                const sectionType = sectionGrid.getAttribute('data-type');
                
                setTimeout(() => {
                    if (filterType === 'all') {
                        showSection(section);
                    } else if (filterType === sectionType) {
                        showSection(section);
                    } else {
                        hideSection(section);
                    }
                }, index * 100);
            }
        });
    }
    
  
    function showSection(section) {
        section.style.transition = 'all 0.5s ease';
        section.style.display = 'block';
        section.style.opacity = '0';
        section.style.transform = 'translateX(-30px)';
        
        setTimeout(() => {
            section.style.opacity = '1';
            section.style.transform = 'translateX(0)';
        }, 10);
    }
    
  
    function hideSection(section) {
        section.style.transition = 'all 0.4s ease';
        section.style.opacity = '0';
        section.style.transform = 'translateX(30px)';
        
        setTimeout(() => {
            section.style.display = 'none';
        }, 400);
    }
    
   
    function initializeFilter() {
        setTimeout(() => {
            filterGalleryItems('all');
            filterRandomSections('all');
        }, 100);
        
        const filterDropdown = document.querySelector('.dropdown-toggle');
        if (filterDropdown) {
            filterDropdown.style.animation = 'pulse 0.6s ease-in-out';
        }
    }
    
    function updateItemCounter() {
        const visibleItems = document.querySelectorAll('.gallery-item[style*="display: block"], .gallery-item:not([style*="display: none"])');
        console.log(` Showing ${visibleItems.length} items`);
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === '1') filterButtons[0]?.click(); // All
        if (e.key === '2') filterButtons[1]?.click(); // Images
        if (e.key === '3') filterButtons[2]?.click(); // Videos
    });
    
    initializeFilter();
    
    console.log('Gallery Filter initialized with modern animations!');
});