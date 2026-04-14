<?php include "style/navbar.php"; ?>

<!-- إضافة شريط البحث -->
<?php include "includes/search_section.php"; ?>

    <section class="featured-products" style="padding-top: 2rem;">
        <div class="container">
            <div class="section-header">
                <h2>جميع المنتجات</h2>
                <p>اكتشف مجموعتنا الكاملة من المنتجات المميزة</p>
            </div>
            <div class="products-grid" id="products-container">
              <?php  include 'includes/allproducts.php'; ?>
            </div>
        </div>
    </section>

    <?php include "style/footer.php"; ?>