<?php 
include "style/navbar.php";
require "functions/connection.php";

$search_query = isset($_GET['q']) ? mysqli_real_escape_string($connection, $_GET['q']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($connection, $_GET['category']) : 'all';
?>

<style>
.search-results-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0;
    text-align: center;
}

.search-results-header h1 {
    margin: 0 0 10px 0;
    font-size: 2.5rem;
}

.search-term {
    font-size: 1.5rem;
    opacity: 0.9;
}

.results-count {
    margin-top: 15px;
    font-size: 1.1rem;
    opacity: 0.8;
}

.search-results-section {
    padding: 3rem 0;
    min-height: 60vh;
}

.no-results-container {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    max-width: 600px;
    margin: 0 auto;
}

.no-results-container i {
    width: 100px;
    height: 100px;
    color: #cbd5e1;
    margin-bottom: 20px;
}

.no-results-container h2 {
    color: #1e293b;
    margin-bottom: 10px;
}

.no-results-container p {
    color: #64748b;
    margin-bottom: 30px;
}

.back-btn {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.filter-info {
    background: white;
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.filter-info span {
    color: #667eea;
    font-weight: 600;
}

@media (max-width: 768px) {
    .search-results-header h1 {
        font-size: 2rem;
    }
    
    .search-term {
        font-size: 1.2rem;
    }
    
    .filter-info {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
}
</style>

<div class="search-results-header">
    <div class="container">
        <h1>نتائج البحث</h1>
        <?php if($search_query): ?>
            <div class="search-term">"<?php echo htmlspecialchars($search_query); ?>"</div>
        <?php endif; ?>
    </div>
</div>

<section class="search-results-section">
    <div class="container">
        <?php
        // بناء الاستعلام
        $query = "SELECT * FROM products WHERE 1=1";
        
        if(!empty($search_query)) {
            $query .= " AND (name LIKE '%$search_query%' OR cat LIKE '%$search_query%')";
        }
        
        if($category != 'all') {
            $query .= " AND cat = '$category'";
        }
        
        $query .= " ORDER BY id DESC";
        
        $result = mysqli_query($connection, $query);
        $total_results = mysqli_num_rows($result);
        ?>
        
        <?php if($total_results > 0): ?>
            <div class="filter-info">
                <div class="results-count">
                    تم العثور على <span><?php echo $total_results; ?></span> منتج
                </div>
                <?php if($category != 'all'): ?>
                    <div>
                        الفئة: <span><?php echo htmlspecialchars($category); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="products-grid">
                <?php
                $index = 0;
                while($product = mysqli_fetch_assoc($result)) {
                    $image_path = "../DASHBORD/images/" . $product['img'];
                    $has_image = !empty($product['img']) && file_exists($image_path);
                    
                    // حساب السعر بعد الخصم
                    $final_price = $product['price'];
                    if($product['sale'] > 0) {
                        $final_price = $product['price'] - ($product['price'] * $product['sale'] / 100);
                    }
                    
                    $badge_html = '';
                    if($product['sale'] > 0) {
                        $badge_html = '<div class="product-badge sale">خصم ' . $product['sale'] . '%</div>';
                    }
                    
                    $product_name = htmlspecialchars($product['name'], ENT_QUOTES);
                    $product_image = $has_image ? $image_path : '';
                ?>
                    <div class="product-card" data-product-id="<?php echo $product['id']; ?>" style="animation-delay: <?php echo $index * 0.05; ?>s">
                        <?php echo $badge_html; ?>
                        <div class="product-image">
                            <?php if($has_image) { ?>
                                <img src="<?php echo $image_path; ?>" alt="<?php echo $product_name; ?>">
                            <?php } else { ?>
                                <div class="placeholder-image">
                                    <i data-lucide="box"></i>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="product-info">
                            <h3><?php echo $product['name']; ?></h3>
                            <p class="product-description"><?php echo $product['cat']; ?></p>
                            <div class="product-footer">
                                <?php if($product['sale'] > 0) { ?>
                                    <div class="price-wrapper">
                                        <span class="product-price"><?php echo number_format($final_price, 0); ?> ج.م</span>
                                        <span class="old-price"><?php echo number_format($product['price'], 0); ?> ج.م</span>
                                    </div>
                                <?php } else { ?>
                                    <span class="product-price"><?php echo number_format($product['price'], 0); ?> ج.م</span>
                                <?php } ?>
                                
                                <button class="btn-add-cart" 
                                        onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product_name; ?>', <?php echo $final_price; ?>, '<?php echo $product_image; ?>')">
                                    <i data-lucide="shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                    $index++;
                }
                ?>
            </div>
            
        <?php else: ?>
            <div class="no-results-container">
                <i data-lucide="search-x"></i>
                <h2>لم يتم العثور على نتائج</h2>
                <p>عذراً، لم نتمكن من العثور على منتجات تطابق بحثك</p>
                <a href="products.php" class="back-btn">
                    <i data-lucide="arrow-right"></i>
                    العودة للمنتجات
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include "style/footer.php"; ?>

<script>
// تهيئة Lucide Icons
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}
</script>