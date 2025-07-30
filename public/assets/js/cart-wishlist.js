// Universal Cart and Wishlist Management
class CartWishlistManager {
    constructor() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        this.initializeEventListeners();
        this.updateCounts();
    }

    initializeEventListeners() {
        // Add to cart buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.add-to-cart-btn')) {
                e.preventDefault();
                const button = e.target.closest('.add-to-cart-btn');
                const itemId = button.getAttribute('data-item-id') || button.getAttribute('data-product-id');
                const itemType = button.getAttribute('data-item-type') || 'product';
                if (itemId) {
                    this.addToCart(itemId, itemType, button);
                }
            }
        });

        // Wishlist toggle buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.wishlist-toggle-btn') || e.target.closest('.wishlist-btn')) {
                e.preventDefault();
                const button = e.target.closest('.wishlist-toggle-btn, .wishlist-btn');
                const itemId = button.getAttribute('data-item-id') || button.getAttribute('data-product-id');
                const itemType = button.getAttribute('data-item-type') || 'product';
                if (itemId) {
                    this.toggleWishlist(itemId, itemType, button);
                }
            }
        });

        // Quick add to cart from product listings
        document.addEventListener('click', (e) => {
            if (e.target.closest('.quick-add-cart')) {
                e.preventDefault();
                const button = e.target.closest('.quick-add-cart');
                const itemId = button.getAttribute('data-item-id') || button.getAttribute('data-product-id');
                const itemType = button.getAttribute('data-item-type') || 'product';
                if (itemId) {
                    this.addToCart(itemId, itemType, button);
                }
            }
        });

        // Cart remove buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.remove-cart-item')) {
                e.preventDefault();
                const button = e.target.closest('.remove-cart-item');
                const itemId = button.getAttribute('data-item-id') || button.getAttribute('data-product-id');
                const itemType = button.getAttribute('data-item-type') || 'product';
                if (itemId && confirm('Remove this item from cart?')) {
                    window.removeCartItem(itemId, itemType, button);
                }
            }
        });

        // Cart quantity buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.qty-btn')) {
                e.preventDefault();
                const button = e.target.closest('.qty-btn');
                const input = button.parentNode.querySelector('input[type="number"]');
                const itemId = input.getAttribute('data-item-id') || input.getAttribute('data-product-id');
                const itemType = input.getAttribute('data-item-type') || 'product';
                
                if (button.classList.contains('inc')) {
                    const newValue = parseInt(input.value) + 1;
                    input.value = newValue;
                    window.updateCartQuantity(itemId, itemType, newValue, input);
                } else if (button.classList.contains('dec')) {
                    const newValue = Math.max(0, parseInt(input.value) - 1);
                    input.value = newValue;
                    window.updateCartQuantity(itemId, itemType, newValue, input);
                }
            }
        });

        // Cart quantity input change
        document.addEventListener('change', (e) => {
            if (e.target.matches('input[data-item-id], input[data-product-id]')) {
                const input = e.target;
                const itemId = input.getAttribute('data-item-id') || input.getAttribute('data-product-id');
                const itemType = input.getAttribute('data-item-type') || 'product';
                const quantity = Math.max(0, parseInt(input.value) || 0);
                input.value = quantity;
                window.updateCartQuantity(itemId, itemType, quantity, input);
            }
        });
    }

    async addToCart(itemId, itemType = 'product', button = null) {
        try {
            // Check authentication first
            const authCheck = await this.checkAuthentication();
            if (!authCheck.authenticated) {
                // Redirect directly to login page without showing popup
                const currentUrl = window.location.href;
                const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
                window.location.href = loginUrl;
                return;
            }

            if (button) {
                this.setButtonLoading(button, 'Adding...');
            }

            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    item_id: itemId,
                    item_type: itemType,
                    quantity: 1
                })
            });

            const data = await response.json();

            if (button) {
                this.resetButtonLoading(button);
            }

            if (data.success) {
                const itemName = itemType === 'cooked_food' ? 'Cooked food' : 'Product';
                this.showToast(`${itemName} added to cart!`, 'success');
                this.updateCartCount();
                
                // Update button text temporarily
                if (button) {
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-check me-2"></i>Added!';
                    button.classList.add('btn-success');
                    
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('btn-success');
                    }, 2000);
                }
            } else {
                if (response.status === 401) {
                    // Redirect directly to login page without showing popup
                    const currentUrl = window.location.href;
                    const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
                    window.location.href = loginUrl;
                } else {
                    this.showToast(data.message || 'Error adding to cart', 'error');
                }
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            if (button) {
                this.resetButtonLoading(button);
            }
            this.showToast('Error adding to cart', 'error');
        }
    }

    async toggleWishlist(itemId, itemType = 'product', button = null) {
        try {
            // Check authentication first
            const authCheck = await this.checkAuthentication();
            if (!authCheck.authenticated) {
                // Redirect directly to login page without showing popup
                const currentUrl = window.location.href;
                const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
                window.location.href = loginUrl;
                return;
            }

            if (button) {
                this.setButtonLoading(button);
            }

            const response = await fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    item_id: itemId,
                    item_type: itemType
                })
            });

            const data = await response.json();

            if (button) {
                this.resetButtonLoading(button);
            }

            if (data.success) {
                // Update button state
                if (button) {
                    const heartIcon = button.querySelector('i');
                    if (data.added || data.action === 'added') {
                        button.classList.add('active');
                        heartIcon.className = 'fa-solid fa-heart';
                        heartIcon.style.color = '#e74c3c';
                        button.setAttribute('title', 'Remove from wishlist');
                        const itemName = itemType === 'cooked_food' ? 'Cooked food' : 'Product';
                        this.showToast(`${itemName} added to wishlist!`, 'success');
                    } else {
                        button.classList.remove('active');
                        heartIcon.className = 'fa-regular fa-heart';
                        heartIcon.style.color = '';
                        button.setAttribute('title', 'Add to wishlist');
                        const itemName = itemType === 'cooked_food' ? 'Cooked food' : 'Product';
                        this.showToast(`${itemName} removed from wishlist`, 'info');
                        
                        // If we're on the wishlist page, remove the item
                        const wishlistItem = document.getElementById(`wishlist-item-${itemType}-${itemId}`);
                        if (wishlistItem) {
                            wishlistItem.remove();
                            
                            // Check if wishlist is now empty
                            const wishlistItems = document.querySelectorAll('[id^="wishlist-item-"]');
                            if (wishlistItems.length === 0) {
                                location.reload(); // Reload to show empty state
                            }
                        }
                    }
                }
                
                this.updateWishlistCount();
            } else {
                if (response.status === 401) {
                    // Redirect directly to login page without showing popup
                    const currentUrl = window.location.href;
                    const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
                    window.location.href = loginUrl;
                } else {
                    this.showToast(data.message || 'Error updating wishlist', 'error');
                }
            }
        } catch (error) {
            console.error('Error toggling wishlist:', error);
            if (button) {
                this.resetButtonLoading(button);
            }
            this.showToast('Error updating wishlist', 'error');
        }
    }

    async checkAuthentication() {
        try {
            const response = await fetch('/api/auth-check', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.csrfToken
                }
            });
            
            if (response.ok) {
                const data = await response.json();
                return { authenticated: data.authenticated };
            }
            
            return { authenticated: false };
        } catch (error) {
            // Fallback: assume not authenticated if check fails
            console.error('Auth check failed:', error);
            return { authenticated: false };
        }
    }

    showLoginPrompt(action) {
        // Remove any existing login modals first to prevent duplicates
        const existingModals = document.querySelectorAll('.login-prompt-modal, .login-required-modal, #loginRequiredModal, #authRequiredModal');
        existingModals.forEach(modal => {
            if (modal.parentNode) {
                modal.parentNode.removeChild(modal);
            }
        });

        const modal = this.createLoginModal(action);
        document.body.appendChild(modal);
        modal.style.display = 'block';
        
        // Auto remove after 10 seconds
        setTimeout(() => {
            if (modal.parentNode) {
                modal.parentNode.removeChild(modal);
            }
        }, 10000);
    }

    createLoginModal(action) {
        const modal = document.createElement('div');
        modal.className = 'login-prompt-modal';
        
        // Store current page URL for redirect after login
        const currentUrl = window.location.href;
        const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;
        const registerUrl = `/register?redirect=${encodeURIComponent(currentUrl)}`;
        
        modal.innerHTML = `
            <div class="login-prompt-backdrop" onclick="this.parentElement.remove()"></div>
            <div class="login-prompt-content">
                <div class="login-prompt-header">
                    <h5><i class="fas fa-paw me-2" style="color: #FA441D;"></i>Login Required</h5>
                    <button class="close-btn" onclick="this.closest('.login-prompt-modal').remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="login-prompt-body">
                    <div class="login-icon mb-3">
                        <i class="fas fa-heart" style="color: #FA441D; font-size: 3rem; opacity: 0.8;"></i>
                    </div>
                    <p>You need to be logged in to ${action}.</p>
                    <p class="text-muted small">Join our pet-loving community!</p>
                    <div class="login-prompt-actions">
                        <a href="${loginUrl}" class="btn btn-primary theme-btn">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                        <a href="${registerUrl}" class="btn btn-outline-theme ms-2">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                        <button class="btn btn-light ms-2" onclick="this.closest('.login-prompt-modal').remove()">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        // Add styles
        if (!document.getElementById('login-prompt-styles')) {
            const styles = document.createElement('style');
            styles.id = 'login-prompt-styles';
            styles.textContent = `
                .login-prompt-modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                    display: none;
                }
                
                .login-prompt-backdrop {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6);
                    backdrop-filter: blur(3px);
                }
                
                .login-prompt-content {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: white;
                    border-radius: 20px;
                    min-width: 420px;
                    max-width: 90vw;
                    box-shadow: 0 20px 60px rgba(250, 68, 29, 0.2);
                    animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                    overflow: hidden;
                }
                
                @keyframes modalSlideIn {
                    from {
                        opacity: 0;
                        transform: translate(-50%, -60%) scale(0.8);
                    }
                    to {
                        opacity: 1;
                        transform: translate(-50%, -50%) scale(1);
                    }
                }
                
                .login-prompt-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 2rem 2rem 1rem;
                    background: linear-gradient(135deg, #FFF8E5 0%, #FFF3D6 100%);
                    border-bottom: 1px solid rgba(250, 68, 29, 0.1);
                }
                
                .login-prompt-header h5 {
                    margin: 0;
                    color: #2c3e50;
                    font-weight: 700;
                    font-size: 1.4rem;
                    flex: 1;
                }
                
                .close-btn {
                    background: rgba(250, 68, 29, 0.1);
                    border: none;
                    color: #FA441D;
                    font-size: 1.2rem;
                    cursor: pointer;
                    padding: 8px;
                    border-radius: 50%;
                    transition: all 0.3s ease;
                    width: 36px;
                    height: 36px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .close-btn:hover {
                    background: #FA441D;
                    color: white;
                    transform: rotate(90deg);
                }
                
                .login-prompt-body {
                    padding: 2rem;
                    text-align: center;
                    background: white;
                }
                
                .login-prompt-body p {
                    color: #666;
                    margin-bottom: 1rem;
                    font-size: 1.1rem;
                    line-height: 1.6;
                }
                
                .login-prompt-body p.text-muted {
                    font-size: 0.9rem;
                    margin-bottom: 2rem;
                }
                
                .login-prompt-actions {
                    display: flex;
                    justify-content: center;
                    flex-wrap: wrap;
                    gap: 0.75rem;
                }
                
                .theme-btn {
                    background: linear-gradient(135deg, #FA441D, #E63946);
                    border: none;
                    color: white;
                    padding: 12px 24px;
                    border-radius: 25px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    box-shadow: 0 4px 15px rgba(250, 68, 29, 0.3);
                }
                
                .theme-btn:hover {
                    background: linear-gradient(135deg, #E63946, #D32F2F);
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(250, 68, 29, 0.4);
                    color: white;
                    text-decoration: none;
                }
                
                .btn-outline-theme {
                    border: 2px solid #FA441D;
                    color: #FA441D;
                    background: transparent;
                    padding: 10px 24px;
                    border-radius: 25px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                }
                
                .btn-outline-theme:hover {
                    background: #FA441D;
                    color: white;
                    transform: translateY(-2px);
                    text-decoration: none;
                }
                
                .btn-light {
                    background: #f8f9fa;
                    border: 1px solid #dee2e6;
                    color: #6c757d;
                    padding: 10px 20px;
                    border-radius: 25px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }
                
                .btn-light:hover {
                    background: #e9ecef;
                    border-color: #adb5bd;
                    color: #495057;
                }
                
                .login-icon {
                    animation: heartBeat 2s infinite;
                }
                
                @keyframes heartBeat {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.1); }
                }
                
                @media (max-width: 480px) {
                    .login-prompt-content {
                        min-width: auto;
                        margin: 1rem;
                        border-radius: 15px;
                    }
                    
                    .login-prompt-header {
                        padding: 1.5rem 1.5rem 1rem;
                    }
                    
                    .login-prompt-header h5 {
                        font-size: 1.2rem;
                    }
                    
                    .login-prompt-body {
                        padding: 1.5rem;
                    }
                    
                    .login-prompt-actions {
                        flex-direction: column;
                        gap: 0.5rem;
                    }
                    
                    .login-prompt-actions .btn {
                        margin: 0 !important;
                        width: 100%;
                        justify-content: center;
                    }
                }
            `;
            document.head.appendChild(styles);
        }
        
        return modal;
    }

    setButtonLoading(button, text = null) {
        button.disabled = true;
        button.classList.add('btn-loading');
        
        if (text && !button.dataset.originalText) {
            button.dataset.originalText = button.innerHTML;
            button.innerHTML = text;
        }
    }

    resetButtonLoading(button) {
        button.disabled = false;
        button.classList.remove('btn-loading');
        
        if (button.dataset.originalText) {
            button.innerHTML = button.dataset.originalText;
            delete button.dataset.originalText;
        }
    }

    async updateCounts() {
        await Promise.all([
            this.updateCartCount(),
            this.updateWishlistCount()
        ]);
    }

    async updateCartCount() {
        try {
            const response = await fetch('/cart/count');
            const data = await response.json();
            
            const countElements = document.querySelectorAll('.cart-count');
            countElements.forEach(element => {
                const oldCount = parseInt(element.textContent) || 0;
                const newCount = data.count;
                
                element.textContent = newCount;
                element.style.display = newCount > 0 ? 'flex' : 'none';
                element.setAttribute('data-count', newCount);
                
                // Add animation if count changed
                if (oldCount !== newCount && newCount > 0) {
                    element.classList.add('updated');
                    setTimeout(() => element.classList.remove('updated'), 600);
                }
            });
        } catch (error) {
            console.error('Error updating cart count:', error);
        }
    }

    async updateWishlistCount() {
        try {
            const response = await fetch('/wishlist/count');
            const data = await response.json();
            
            const countElements = document.querySelectorAll('.wishlist-count');
            countElements.forEach(element => {
                const oldCount = parseInt(element.textContent) || 0;
                const newCount = data.count;
                
                element.textContent = newCount;
                element.style.display = newCount > 0 ? 'flex' : 'none';
                element.setAttribute('data-count', newCount);
                
                // Add animation if count changed
                if (oldCount !== newCount && newCount > 0) {
                    element.classList.add('updated');
                    setTimeout(() => element.classList.remove('updated'), 600);
                }
            });
        } catch (error) {
            console.error('Error updating wishlist count:', error);
        }
    }

    showToast(message, type = 'info') {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.cart-wishlist-toast');
        existingToasts.forEach(toast => toast.remove());

        // Create new toast
        const toast = document.createElement('div');
        toast.className = `cart-wishlist-toast alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${this.getToastIcon(type)} me-2"></i>
                <span>${message}</span>
            </div>
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        `;
        
        // Add styles if not already added
        if (!document.getElementById('toast-styles')) {
            const styles = document.createElement('style');
            styles.id = 'toast-styles';
            styles.textContent = `
                .cart-wishlist-toast {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9998;
                    min-width: 300px;
                    max-width: 400px;
                    animation: slideInRight 0.3s ease;
                }
                
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @media (max-width: 480px) {
                    .cart-wishlist-toast {
                        top: 10px;
                        right: 10px;
                        left: 10px;
                        min-width: auto;
                        max-width: none;
                    }
                }
            `;
            document.head.appendChild(styles);
        }
        
        document.body.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }
        }, 5000);
    }

    getToastIcon(type) {
        const icons = {
            'success': 'check-circle',
            'error': 'exclamation-circle',
            'warning': 'exclamation-triangle',
            'info': 'info-circle'
        };
        return icons[type] || 'info-circle';
    }

    async updateWishlistIcons() {
        try {
            const response = await fetch('/wishlist/user-products', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest', // Indicate this is an AJAX request
                    'X-CSRF-TOKEN': this.csrfToken
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                const wishlistedProductIds = data.product_ids || [];
                
                // Update all wishlist toggle buttons on the page
                document.querySelectorAll('.wishlist-toggle-btn').forEach(button => {
                    const productId = parseInt(button.getAttribute('data-product-id'));
                    const icon = button.querySelector('i');
                    
                    if (wishlistedProductIds.includes(productId)) {
                        icon.className = 'fa-solid fa-heart';
                        icon.style.color = '#e74c3c';
                        button.classList.add('active');
                        button.setAttribute('title', 'Remove from wishlist');
                    } else {
                        icon.className = 'fa-regular fa-heart';
                        icon.style.color = '';
                        button.classList.remove('active');
                        button.setAttribute('title', 'Add to wishlist');
                    }
                });
            }
        } catch (error) {
            console.error('Error updating wishlist icons:', error);
        }
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        window.cartWishlistManager = new CartWishlistManager();
        // Update wishlist icons after initialization
        setTimeout(() => {
            if (window.cartWishlistManager) {
                window.cartWishlistManager.updateWishlistIcons();
            }
        }, 100);
    });
} else {
    window.cartWishlistManager = new CartWishlistManager();
    // Update wishlist icons after initialization
    setTimeout(() => {
        if (window.cartWishlistManager) {
            window.cartWishlistManager.updateWishlistIcons();
        }
    }, 100);
}

// Export functions for backward compatibility
window.addToCart = function(productId, button = null) {
    if (window.cartWishlistManager) {
        window.cartWishlistManager.addToCart(productId, button);
    }
};

window.toggleWishlist = function(productId, button = null) {
    if (window.cartWishlistManager) {
        window.cartWishlistManager.toggleWishlist(productId, button);
    }
};

window.removeFromWishlist = function(productId) {
    if (window.cartWishlistManager) {
        // Handle removal from wishlist page specifically
        const button = event.target.closest('.wishlist-btn');
        const productCard = document.getElementById(`wishlist-item-${productId}`);
        
        if (button) window.cartWishlistManager.setButtonLoading(button);
        if (productCard) productCard.classList.add('loading');
        
        fetch('/wishlist/remove', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.cartWishlistManager.csrfToken
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Animate removal
                if (productCard) {
                    productCard.style.transition = 'all 0.3s ease';
                    productCard.style.transform = 'scale(0.8)';
                    productCard.style.opacity = '0';
                    
                    setTimeout(() => {
                        productCard.remove();
                        
                        // Check if wishlist is empty
                        const remainingItems = document.querySelectorAll('[id^="wishlist-item-"]');
                        if (remainingItems.length === 0) {
                            location.reload(); // Reload to show empty state
                        }
                    }, 300);
                }
                
                window.cartWishlistManager.updateWishlistCount();
                window.cartWishlistManager.showToast('Product removed from wishlist', 'success');
            } else {
                if (button) window.cartWishlistManager.resetButtonLoading(button);
                if (productCard) productCard.classList.remove('loading');
                window.cartWishlistManager.showToast(data.message || 'Error removing from wishlist', 'error');
            }
        })
        .catch(error => {
            if (button) window.cartWishlistManager.resetButtonLoading(button);
            if (productCard) productCard.classList.remove('loading');
            window.cartWishlistManager.showToast('Error: ' + error.message, 'error');
        });
    }
};

window.clearWishlist = function() {
    if (!confirm('Are you sure you want to clear your entire wishlist?')) return;
    
    if (window.cartWishlistManager) {
        const button = document.getElementById('clear-wishlist-btn');
        if (button) {
            window.cartWishlistManager.setButtonLoading(button);
            button.disabled = true;
        }
        
        fetch('/wishlist/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.cartWishlistManager.csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                if (button) {
                    window.cartWishlistManager.resetButtonLoading(button);
                    button.disabled = false;
                }
                window.cartWishlistManager.showToast(data.message || 'Error clearing wishlist', 'error');
            }
        })
        .catch(error => {
            if (button) {
                window.cartWishlistManager.resetButtonLoading(button);
                button.disabled = false;
            }
            window.cartWishlistManager.showToast('Error: ' + error.message, 'error');
        });
    }
};

window.updateCartCount = function() {
    if (window.cartWishlistManager) {
        window.cartWishlistManager.updateCartCount();
    }
};

window.updateWishlistCount = function() {
    if (window.cartWishlistManager) {
        window.cartWishlistManager.updateWishlistCount();
    }
};

window.showToast = function(message, type = 'info') {
    if (window.cartWishlistManager) {
        window.cartWishlistManager.showToast(message, type);
    }
};

// Cart quantity update functionality
function updateCartQuantity(itemId, itemType = 'product', quantity = 1, element = null) {
    if (element) {
        element.disabled = true;
    }

    const requestData = {
        product_id: itemId,  // Changed from item_id to product_id
        quantity: quantity,
        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    
    // Debug: Log what we're sending
    console.log('Sending cart update request:', requestData);

    fetch('/cart/update', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(requestData)
    })
    .then(response => response.json())
    .then(data => {
        if (element) {
            element.disabled = false;
        }

        if (data.success) {
            // Update cart count badge
            if (window.cartWishlistManager) {
                window.cartWishlistManager.updateCartCount();
            }

            // Update item subtotal display (quantity × unit price) - Fix for correct subtotal calculation
            if (data.new_subtotal && element) {
                const itemRow = element.closest('tr, .cart-item');
                if (itemRow) {
                    // Update subtotal elements (this should show quantity × unit price)
                    const subtotalElements = itemRow.querySelectorAll('.item-subtotal, .product-subtotal .woocommerce-Price-amount, .cart-item-price');
                    subtotalElements.forEach(subtotalElement => {
                        if (subtotalElement) {
                            subtotalElement.innerHTML = `<span class="woocommerce-Price-currencySymbol">₹</span>${parseFloat(data.new_subtotal).toFixed(2)}`;
                        }
                    });
                }
            }

            // Note: We don't update the unit price because it should remain constant
            // The unit price (per item) should not change when quantity changes
            // Only the subtotal (unit price × quantity) should update

            // Update cart total displays
            const cartTotal = document.querySelector('.cart-total, #cart-subtotal');
            if (cartTotal && data.cart_total) {
                cartTotal.textContent = parseFloat(data.cart_total).toFixed(2);
            }

            // Update shipping and final total
            const shippingElement = document.querySelector('.shipping-cost');
            if (shippingElement && data.shipping) {
                shippingElement.textContent = parseFloat(data.shipping).toFixed(2);
            }

            const finalTotalElement = document.querySelector('.final-total, #cart-total');
            if (finalTotalElement && data.final_total) {
                finalTotalElement.textContent = parseFloat(data.final_total).toFixed(2);
            }

            // Remove item if quantity is 0
            if (quantity == 0 && element) {
                const itemRow = element.closest('tr, .cart-item');
                if (itemRow) {
                    itemRow.remove();
                }
            }

            // Update cart sidebar to show proper empty state if needed
            if (typeof updateCartSidebar === 'function') {
                updateCartSidebar();
            }

            window.showToast('Cart updated successfully', 'success');
        } else {
            console.error('Cart update failed:', data);
            window.showToast(data.message || 'Failed to update cart', 'error');
        }
    })
    .catch(error => {
        if (element) {
            element.disabled = false;
        }
        console.error('Error updating cart:', error);
        window.showToast('Error updating cart', 'error');
    });
}

// Remove item from cart
function removeCartItem(itemId, itemType = 'product', element = null) {
    if (element) {
        element.disabled = true;
    }

    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            item_id: itemId,
            item_type: itemType
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count
            if (window.cartWishlistManager) {
                window.cartWishlistManager.updateCartCount();
            }

            // Remove the item row
            if (element) {
                const row = element.closest('tr');
                if (row) {
                    row.remove();
                }
            }

            // Update cart sidebar to show proper empty state if needed
            if (typeof updateCartSidebar === 'function') {
                updateCartSidebar();
            }

            // Update totals
            const cartTotal = document.querySelector('.cart-total');
            if (cartTotal) {
                cartTotal.textContent = '₹' + data.cart_total;
            }

            const finalTotalElement = document.querySelector('.final-total');
            if (finalTotalElement) {
                finalTotalElement.textContent = '₹' + data.final_total;
            }

            window.showToast('Item removed from cart', 'success');
        } else {
            if (element) {
                element.disabled = false;
            }
            window.showToast(data.message || 'Failed to remove item', 'error');
        }
    })
    .catch(error => {
        if (element) {
            element.disabled = false;
        }
        console.error('Error removing item:', error);
        window.showToast('Error removing item', 'error');
    });
}

// Make functions globally available
window.updateCartQuantity = updateCartQuantity;
window.removeCartItem = removeCartItem;
