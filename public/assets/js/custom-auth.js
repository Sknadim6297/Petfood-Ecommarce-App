// Custom JavaScript for PetNet
document.addEventListener('DOMContentLoaded', function() {
    // Handle dropdown clicks for both desktop and mobile
    const dropdowns = document.querySelectorAll('.login .dropdown');
    
    dropdowns.forEach(function(dropdown) {
        const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        
        if (dropdownToggle && dropdownMenu) {
            // Toggle dropdown on click
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other dropdowns first
                dropdowns.forEach(function(otherDropdown) {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('show');
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('show');
            });
            
            // Keep dropdown open when clicking on items inside
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });
    });
    
    // Store current URL before redirecting to login
    const loginLinks = document.querySelectorAll('a[href*="login"]');
    loginLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Store current URL in session storage
            if (!window.location.href.includes('login') && !window.location.href.includes('register')) {
                sessionStorage.setItem('intendedUrl', window.location.href);
            }
        });
    });
});
