<?php
include "style/navbar.php";
require "functions/connection.php";

// الحصول على معرف المنتج
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($product_id <= 0) {
    header("Location: products.php");
    exit();
}

// جلب بيانات المنتج
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) == 0) {
    header("Location: products.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

// حساب السعر بعد الخصم
$final_price = $product['price'];
$discount_amount = 0;
if($product['sale'] > 0) {
    $discount_amount = $product['price'] * $product['sale'] / 100;
    $final_price = $product['price'] - $discount_amount;
}

// مسار الصورة
$image_path = "../DASHBORD/images/" . $product['img'];
$has_image = !empty($product['img']) && file_exists($image_path);

// جلب منتجات مشابهة
$similar_query = "SELECT * FROM products WHERE cat = '{$product['cat']}' AND id != $product_id LIMIT 4";
$similar_result = mysqli_query($connection, $similar_query);
?>

<style>
.product-details-section {
    padding: 4rem 0;
    background: #f8fafc;
}

.product-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.product-detail-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 3rem;
}

.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

.product-image-section {
    position: relative;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 500px;
}

.product-image-section img {
    max-width: 100%;
    max-height: 500px;
    object-fit: contain;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    animation: fadeInScale 0.6s ease;
}

.product-image-section .placeholder-image {
    width: 300px;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 16px;
}

.product-image-section .placeholder-image i {
    width: 150px;
    height: 150px;
    color: #94a3b8;
}

.discount-badge {
    position: absolute;
    top: 30px;
    right: 30px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 700;
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
    animation: pulse 2s infinite;
}

.product-info-section {
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.product-category {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 1rem;
}

.product-title {
    font-size: 2.5rem;
    color: #1e293b;
    margin-bottom: 1rem;
    font-weight: 700;
    line-height: 1.2;
}

.product-description {
    color: #64748b;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}

.price-section {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2rem;
}

.price-row {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.current-price {
    font-size: 3rem;
    font-weight: 800;
    color: #667eea;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.original-price {
    font-size: 1.5rem;
    color: #94a3b8;
    text-decoration: line-through;
}

.savings-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.product-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f8fafc;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: #f1f5f9;
    transform: translateX(-5px);
}

.feature-item i {
    width: 24px;
    height: 24px;
    color: #667eea;
}

.feature-item span {
    color: #475569;
    font-weight: 500;
}

.quantity-section {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.quantity-label {
    font-weight: 600;
    color: #1e293b;
    font-size: 1.1rem;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #f1f5f9;
    padding: 8px;
    border-radius: 12px;
}

.qty-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.qty-btn:hover {
    background: #667eea;
    color: white;
    transform: scale(1.1);
}

.qty-btn:active {
    transform: scale(0.95);
}

.qty-display {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    min-width: 50px;
    text-align: center;
}

.action-buttons {
    display: flex;
    gap: 1rem;
}

.btn-add-to-cart {
    flex: 1;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 18px 32px;
    border-radius: 16px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.btn-add-to-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
}

.btn-add-to-cart:active {
    transform: translateY(0);
}

.btn-buy-now {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 18px 32px;
    border-radius: 16px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

.btn-buy-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
}

.similar-products-section {
    padding: 3rem 0;
}

.section-title {
    font-size: 2rem;
    color: #1e293b;
    margin-bottom: 2rem;
    font-weight: 700;
    text-align: center;
}

.similar-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

@media (max-width: 968px) {
    .product-detail-grid {
        grid-template-columns: 1fr;
    }
    
    .product-image-section {
        min-height: 400px;
    }
    
    .product-title {
        font-size: 2rem;
    }
    
    .current-price {
        font-size: 2.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .product-features {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .product-info-section {
        padding: 2rem 1.5rem;
    }
    
    .product-image-section {
        padding: 2rem;
    }
    
    .price-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>

<section class="product-details-section">
    <div class="product-container">
        
        <!-- بطاقة تفاصيل المنتج -->
        <div class="product-detail-card">
            <div class="product-detail-grid">
                
                <!-- قسم الصورة -->
                <div class="product-image-section">
                    <?php if($product['sale'] > 0): ?>
                        <div class="discount-badge">
                            -<?php echo $product['sale']; ?>%
                        </div>
                    <?php endif; ?>
                    
                    <?php if($has_image): ?>
                        <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <?php else: ?>
                        <div class="placeholder-image">
                            <i data-lucide="package"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- قسم المعلومات -->
                <div class="product-info-section">
                    <span class="product-category"><?php echo htmlspecialchars($product['cat']); ?></span>
                    
                    <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                    
                    <p class="product-description">
                        منتج عالي الجودة من فئة <?php echo htmlspecialchars($product['cat']); ?>، مصمم ليلبي احتياجاتك بأفضل المواصفات والأداء المتميز. استمتع بتجربة فريدة مع هذا المنتج الرائع.
                    </p>
                    
                    <!-- قسم السعر -->
                    <div class="price-section">
                        <div class="price-row">
                            <span class="current-price"><?php echo number_format($final_price, 0); ?> ج.م</span>
                            
                            <?php if($product['sale'] > 0): ?>
                                <span class="original-price"><?php echo number_format($product['price'], 0); ?> ج.م</span>
                                <span class="savings-badge">
                                    وفّر <?php echo number_format($discount_amount, 0); ?> ج.م
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- مميزات المنتج -->
                    <div class="product-features">
                        <div class="feature-item">
                            <i data-lucide="truck"></i>
                            <span>شحن مجاني</span>
                        </div>
                        <div class="feature-item">
                            <i data-lucide="shield-check"></i>
                            <span>ضمان الجودة</span>
                        </div>
                        <div class="feature-item">
                            <i data-lucide="refresh-cw"></i>
                            <span>إرجاع مجاني</span>
                        </div>
                        <div class="feature-item">
                            <i data-lucide="clock"></i>
                            <span>توصيل سريع</span>
                        </div>
                    </div>
                    
                    <!-- الكمية -->
                    <div class="quantity-section">
                        <span class="quantity-label">الكمية:</span>
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="decreaseQuantity()">
                                <i data-lucide="minus"></i>
                            </button>
                            <span class="qty-display" id="quantity">1</span>
                            <button class="qty-btn" onclick="increaseQuantity()">
                                <i data-lucide="plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- أزرار الإجراءات -->
                    <div class="action-buttons">
                        <button class="btn-add-to-cart" onclick="addToCartWithQty()">
                            <i data-lucide="shopping-cart"></i>
                            <span>أضف للسلة</span>
                        </button>
                        <button class="btn-buy-now" onclick="buyNow()">
                            <i data-lucide="zap"></i>
                            <span>اشتري الآن</span>
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- المنتجات المشابهة -->
        <?php if(mysqli_num_rows($similar_result) > 0): ?>
        <div class="similar-products-section">
            <h2 class="section-title">منتجات مشابهة</h2>
            <div class="similar-products-grid">
                <?php 
                $index = 0;
                while($similar = mysqli_fetch_assoc($similar_result)): 
                    $similar_image_path = "../DASHBORD/images/" . $similar['img'];
                    $similar_has_image = !empty($similar['img']) && file_exists($similar_image_path);
                    
                    $similar_final_price = $similar['price'];
                    if($similar['sale'] > 0) {
                        $similar_final_price = $similar['price'] - ($similar['price'] * $similar['sale'] / 100);
                    }
                    
                    $similar_badge = '';
                    if($similar['sale'] > 0) {
                        $similar_badge = '<div class="product-badge sale">خصم ' . $similar['sale'] . '%</div>';
                    }
                    
                    $similar_name = htmlspecialchars($similar['name'], ENT_QUOTES);
                    $similar_image = $similar_has_image ? $similar_image_path : '';
                ?>
                    <div class="product-card" style="animation-delay: <?php echo $index * 0.05; ?>s">
                        <?php echo $similar_badge; ?>
                        <div class="product-image">
                            <?php if($similar_has_image): ?>
                                <img src="<?php echo $similar_image_path; ?>" alt="<?php echo $similar_name; ?>">
                            <?php else: ?>
                                <div class="placeholder-image">
                                    <i data-lucide="box"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h3><?php echo $similar['name']; ?></h3>
                            <p class="product-description"><?php echo $similar['cat']; ?></p>
                            <div class="product-footer">
                                <?php if($similar['sale'] > 0): ?>
                                    <div class="price-wrapper">
                                        <span class="product-price"><?php echo number_format($similar_final_price, 0); ?> ج.م</span>
                                        <span class="old-price"><?php echo number_format($similar['price'], 0); ?> ج.م</span>
                                    </div>
                                <?php else: ?>
                                    <span class="product-price"><?php echo number_format($similar['price'], 0); ?> ج.م</span>
                                <?php endif; ?>
                                
                                <button class="btn-add-cart" 
                                        onclick="addToCart(<?php echo $similar['id']; ?>, '<?php echo $similar_name; ?>', <?php echo $similar_final_price; ?>, '<?php echo $similar_image; ?>')">
                                    <i data-lucide="shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php 
                    $index++;
                endwhile; 
                ?>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</section>

<?php include "style/footer.php"; ?>

<script>
// بيانات المنتج
const productData = {
    id: <?php echo $product['id']; ?>,
    name: '<?php echo addslashes($product['name']); ?>',
    price: <?php echo $final_price; ?>,
    image: '<?php echo $has_image ? $image_path : ''; ?>'
};

let currentQuantity = 1;

// زيادة الكمية
function increaseQuantity() {
    currentQuantity++;
    document.getElementById('quantity').textContent = currentQuantity;
}

// تقليل الكمية
function decreaseQuantity() {
    if(currentQuantity > 1) {
        currentQuantity--;
        document.getElementById('quantity').textContent = currentQuantity;
    }
}

// إضافة للسلة مع الكمية
function addToCartWithQty() {
    for(let i = 0; i < currentQuantity; i++) {
        addToCart(productData.id, productData.name, productData.price, productData.image);
    }
    
    // رسالة مخصصة
    const message = currentQuantity === 1 ? 
        'تم إضافة المنتج للسلة ✓' : 
        `تم إضافة ${currentQuantity} منتجات للسلة ✓`;
    
    showNotification(message, 'success');
}

// اشتري الآن
function buyNow() {
    addToCartWithQty();
    setTimeout(() => {
        window.location.href = 'cart.php';
    }, 800);
}

// تهيئة Lucide Icons
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}
</script>