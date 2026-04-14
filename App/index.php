<?php
include "style/navbar.php";
?>

<!-- إضافة شريط البحث -->
<?php include "includes/search_section.php"; ?>

    <section class="hero">
        <div class="container hero-container">
            <div class="hero-content">
                <h1 class="hero-title">اكتشف أفضل المنتجات</h1>
                <p class="hero-subtitle">تسوق بثقة واحصل على أفضل العروض والمنتجات عالية الجودة</p>
                <div class="hero-buttons">
                    <a href="products.php" class="btn-primary">تصفح المنتجات</a>
                    <a href="#featured" class="btn-outline">المنتجات المميزة</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-card card-1">
                    <i data-lucide="truck"></i>
                    <p>شحن مجاني</p>
                </div>
                <div class="floating-card card-2">
                    <i data-lucide="shield-check"></i>
                    <p>دفع آمن</p>
                </div>
                <div class="floating-card card-3">
                    <i data-lucide="headphones"></i>
                    <p>دعم 24/7</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="zap"></i>
                    </div>
                    <h3>توصيل سريع</h3>
                    <p>نوصل طلباتك في أسرع وقت ممكن</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="award"></i>
                    </div>
                    <h3>جودة مضمونة</h3>
                    <p>منتجات أصلية 100% وبأفضل جودة</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="refresh-cw"></i>
                    </div>
                    <h3>إرجاع مجاني</h3>
                    <p>إمكانية الإرجاع خلال 14 يوم</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="credit-card"></i>
                    </div>
                    <h3>دفع آمن</h3>
                    <p>طرق دفع متعددة وآمنة 100%</p>
                </div>
            </div>
        </div>
    </section>

    <section id="featured" class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2>المنتجات المميزة</h2>
                <p>اختيارنا المميز من أفضل المنتجات</p>
            </div>
            
            <div class="products-grid">
                <?php include 'includes/special_product.php'; ?>
            </div>
            
            <div class="text-center">
                <a href="products.php" class="btn-primary">عرض جميع المنتجات</a>
            </div>
        </div>
    </section>

    <section id="featured" class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2>المنتجات الرياضية</h2>
            </div>
            
            <div class="products-grid">
                <?php include 'includes/sport_products.php'; ?>
            </div>
            
            <div class="text-center">
                <a href="products.php" class="btn-primary">عرض جميع المنتجات</a>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>احصل على خصم 15% على أول طلب</h2>
                <p>سجل الآن واستمتع بعروض حصرية</p>
                <a href="signup.php" class="btn-primary">سجل الآن</a>
            </div>
        </div>
    </section>

<?php
include 'style/footer.php';
?>