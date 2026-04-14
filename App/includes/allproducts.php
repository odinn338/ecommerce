<?php
require "functions/connection.php";

$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) > 0) {
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
        
        // تجهيز البيانات للـ JavaScript
        $product_name = htmlspecialchars($product['name'], ENT_QUOTES);
        $product_image = $has_image ? $image_path : '';
?>
        <a href="product_details.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: inherit;">
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
                                onclick="event.preventDefault(); event.stopPropagation(); addToCart(<?php echo $product['id']; ?>, '<?php echo $product_name; ?>', <?php echo $final_price; ?>, '<?php echo $product_image; ?>')">
                            <i data-lucide="shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </a>
<?php
        $index++;
    }
} else {
    echo '<div class="empty-state">لا توجد منتجات حالياً</div>';
}
?>