<?php include "style/navbar.php"; ?>

<section class="cart-section" style="padding: 60px 0; background: #f8fafc; min-height: 70vh;">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 32px; color: #1e293b; margin-bottom: 10px;">سلة التسوق</h2>
            <p style="color: #64748b; font-size: 16px;">راجع منتجاتك وأكمل عملية الشراء</p>
        </div>
        
        <div class="cart-container" style="display: grid; grid-template-columns: 1fr 400px; gap: 30px; align-items: start;">
            <div class="cart-items" id="cart-items">
                <div style="text-align: center; padding: 60px 20px;">
                    <p>جاري التحميل...</p>
                </div>
            </div>

            <div class="cart-summary" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); position: sticky; top: 100px;">
                <h3 style="margin: 0 0 20px 0; color: #1e293b; font-size: 20px;">ملخص الطلب</h3>
                <div class="summary-row" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="color: #64748b;">المجموع الفرعي:</span>
                    <span id="subtotal" style="font-weight: 600; color: #1e293b;">0 ج.م</span>
                </div>
                <div class="summary-row" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="color: #64748b;">الشحن:</span>
                    <span id="shipping" style="font-weight: 600; color: #1e293b;">0 ج.م</span>
                </div>
                <div class="summary-row total" style="display: flex; justify-content: space-between; padding: 15px 0; margin-top: 10px;">
                    <span style="font-size: 18px; font-weight: 700; color: #1e293b;">الإجمالي:</span>
                    <span id="total" style="font-size: 20px; font-weight: 700; color: #6366f1;">0 ج.م</span>
                </div>
                <button class="btn-primary checkout-btn" onclick="checkout()" style="width: 100%; margin-top: 20px; padding: 15px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; border: none; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: transform 0.2s;">
                    <i data-lucide="credit-card" style="width: 20px; height: 20px;"></i>
                    إتمام الشراء
                </button>
            </div>
        </div>
    </div>
</section>

<?php include "style/footer.php"; ?>

<script src="https://unpkg.com/lucide@latest"></script>
<script src="js/main.js"></script>
<script>
console.log('Cart page loaded');

// تأكد من تحميل الصفحة بالكامل
window.addEventListener('load', function() {
    console.log('Window loaded, rendering cart...');
    
    // انتظر شوية عشان نتأكد إن كل حاجة جاهزة
    setTimeout(function() {
        if (typeof renderCart === 'function') {
            renderCart();
            console.log('Cart rendered successfully');
        } else {
            console.error('renderCart function not found!');
        }
    }, 100);
});
</script>

<style>
.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
}

@media (max-width: 768px) {
    .cart-container {
        grid-template-columns: 1fr !important;
    }
    
    .cart-summary {
        position: static !important;
    }
}
</style>