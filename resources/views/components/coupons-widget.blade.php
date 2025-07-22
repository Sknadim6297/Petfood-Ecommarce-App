<div class="available-coupons-widget">
    <h5 style="color: #fa441d; margin-bottom: 15px;">
        <i class="fas fa-gift"></i> Available Coupons
    </h5>
    <div id="coupons-list">
        <!-- Coupons will be loaded here -->
    </div>
</div>

<style>
.coupon-item {
    border: 2px dashed #fa441d;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    background: linear-gradient(45deg, #fff8e5, #ffffff);
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.coupon-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(250, 68, 29, 0.2);
}

.coupon-code {
    font-size: 18px;
    font-weight: bold;
    color: #fa441d;
    margin-bottom: 5px;
}

.coupon-discount {
    font-size: 16px;
    font-weight: bold;
    color: #28a745;
    margin-bottom: 5px;
}

.coupon-condition {
    font-size: 12px;
    color: #666;
    margin-bottom: 5px;
}

.coupon-validity {
    font-size: 11px;
    color: #999;
}

.copy-code-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #fa441d;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 11px;
    cursor: pointer;
    transition: background 0.3s;
}

.copy-code-btn:hover {
    background: #e63946;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadAvailableCouponsWidget();
});

function loadAvailableCouponsWidget() {
    fetch('{{ route("coupons.available") }}')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.coupons.length > 0) {
                displayCouponsWidget(data.coupons);
            } else {
                document.getElementById('coupons-list').innerHTML = '<p style="color: #666; font-style: italic;">No coupons available at the moment.</p>';
            }
        })
        .catch(error => {
            console.error('Error loading coupons:', error);
        });
}

function displayCouponsWidget(coupons) {
    const container = document.getElementById('coupons-list');
    container.innerHTML = '';
    
    coupons.forEach(function(coupon) {
        const discountText = coupon.discount_type === 'percentage' 
            ? `${coupon.discount}% OFF` 
            : `₹${coupon.discount} OFF`;
        
        const minOrderText = coupon.min_order_amount > 0 
            ? `Min. order: ₹${coupon.min_order_amount}` 
            : 'No minimum order required';
        
        const couponHtml = `
            <div class="coupon-item" onclick="copyCouponCode('${coupon.code}')">
                <button class="copy-code-btn" onclick="event.stopPropagation(); copyCouponCode('${coupon.code}')">
                    Copy Code
                </button>
                <div class="coupon-code">${coupon.code}</div>
                <div class="coupon-discount">${discountText}</div>
                <div class="coupon-condition">${minOrderText}</div>
                <div class="coupon-validity">Valid till: ${coupon.end_date}</div>
                ${coupon.description ? `<div style="font-size: 12px; color: #555; margin-top: 5px;">${coupon.description}</div>` : ''}
            </div>
        `;
        container.insertAdjacentHTML('beforeend', couponHtml);
    });
}

function copyCouponCode(code) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(code).then(() => {
            showCopyMessage('Coupon code copied!');
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = code;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showCopyMessage('Coupon code copied!');
    }
}

function showCopyMessage(message) {
    // Create a temporary message element
    const messageEl = document.createElement('div');
    messageEl.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        z-index: 9999;
        font-size: 14px;
    `;
    messageEl.textContent = message;
    document.body.appendChild(messageEl);
    
    setTimeout(() => {
        document.body.removeChild(messageEl);
    }, 2000);
}
</script>
