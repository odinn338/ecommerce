<?php if(isset($_SESSION['success'])){  ?>
    <div class="alert alert-success d-flex justify-content-center align-items-center"><?= $_SESSION['success'] ?></div>
<?php } unset($_SESSION['success']) ?>

<?php
require "functions/connection.php";
?>

<style>
.products-table-wrapper {
    max-width: 100%;
    margin: 0 auto;
}

.products-table-wrapper .table-container {
    background: #ffffff;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.products-table-wrapper .table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.products-table-wrapper .table-header h2 {
    color: #1e293b;
    font-size: 24px;
    font-weight: 700;
    margin: 0;
}

.products-table-wrapper .table-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.products-table-wrapper .search-box {
    position: relative;
}

.products-table-wrapper .search-box input {
    padding: 10px 15px 10px 40px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    width: 250px;
    transition: all 0.2s ease;
}

.products-table-wrapper .search-box input:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.products-table-wrapper .search-box i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.products-table-wrapper .btn-add {
    padding: 10px 20px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.products-table-wrapper .btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.products-table-wrapper .table-responsive {
    overflow-x: auto;
}

.products-table-wrapper .modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.products-table-wrapper .modern-table thead {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.products-table-wrapper .modern-table thead th {
    padding: 15px;
    text-align: left;
    color: white;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.products-table-wrapper .modern-table thead th:first-child {
    border-radius: 10px 0 0 0;
}

.products-table-wrapper .modern-table thead th:last-child {
    border-radius: 0 10px 0 0;
    text-align: center;
}

.products-table-wrapper .modern-table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.products-table-wrapper .modern-table tbody tr:hover {
    background: #f0fdf4;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.products-table-wrapper .modern-table tbody tr:last-child {
    border-bottom: none;
}

.products-table-wrapper .modern-table tbody td {
    padding: 15px;
    color: #475569;
    font-size: 14px;
}

.products-table-wrapper .product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.products-table-wrapper .product-image {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}

.products-table-wrapper .product-image-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.products-table-wrapper .product-details .product-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 2px;
}

.products-table-wrapper .product-details .product-category {
    font-size: 12px;
    color: #94a3b8;
}

.products-table-wrapper .price-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.products-table-wrapper .original-price {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
}

.products-table-wrapper .sale-price {
    font-size: 14px;
    color: #dc2626;
    font-weight: 600;
}

.products-table-wrapper .old-price {
    font-size: 12px;
    color: #94a3b8;
    text-decoration: line-through;
}

.products-table-wrapper .badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.products-table-wrapper .badge-sale {
    background: #fee2e2;
    color: #991b1b;
}

.products-table-wrapper .badge-no-sale {
    background: #f3f4f6;
    color: #6b7280;
}

.products-table-wrapper .stock-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.products-table-wrapper .stock-in {
    background: #d1fae5;
    color: #065f46;
}

.products-table-wrapper .stock-low {
    background: #fef3c7;
    color: #92400e;
}

.products-table-wrapper .stock-out {
    background: #fee2e2;
    color: #991b1b;
}

.products-table-wrapper .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.products-table-wrapper .btn-action {
    width: 35px;
    height: 35px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.products-table-wrapper .btn-view {
    background: #e0f2fe;
    color: #0369a1;
}

.products-table-wrapper .btn-view:hover {
    background: #0ea5e9;
    color: white;
    transform: translateY(-2px);
}

.products-table-wrapper .btn-edit {
    background: #dbeafe;
    color: #1e40af;
}

.products-table-wrapper .btn-edit:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
}

.products-table-wrapper .btn-delete {
    background: #fee2e2;
    color: #991b1b;
}

.products-table-wrapper .btn-delete:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px);
}

.products-table-wrapper .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}

.products-table-wrapper .empty-state i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.3;
}

.products-table-wrapper .empty-state h3 {
    font-size: 20px;
    color: #64748b;
    margin-bottom: 8px;
}

.products-table-wrapper .empty-state p {
    font-size: 14px;
}

/* Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
    z-index: 99999;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
}

.modal-overlay.active {
    display: flex;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-card {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 25px;
    width: 90%;
    max-width: 500px;
    padding: 0;
    position: relative;
    animation: slideUp 0.4s ease;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    overflow: hidden;
}

.close-btn {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.modal-header-custom {
    text-align: center;
    padding: 40px 20px 30px;
    color: white;
}

.product-image-modal {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 45px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.product-image-modal img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-image-modal i {
    color: white;
}

.modal-header-custom h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 600;
}

.modal-body-custom {
    background: white;
    border-radius: 25px 25px 0 0;
    padding: 30px 25px;
    margin-top: -10px;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 18px;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 15px;
    transition: all 0.3s ease;
    border: 1px solid rgba(16, 185, 129, 0.1);
}

.info-item:hover {
    transform: translateX(-5px);
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
}

.info-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin-left: 15px;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
    text-align: right;
}

.info-content label {
    display: block;
    font-size: 12px;
    color: #10b981;
    font-weight: 600;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-content p {
    margin: 0;
    font-size: 16px;
    color: #333;
    font-weight: 500;
}

@media (max-width: 768px) {
    .products-table-wrapper .table-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .products-table-wrapper .search-box input {
        width: 100%;
    }

    .products-table-wrapper .table-actions {
        width: 100%;
        flex-direction: column;
    }

    .products-table-wrapper .modern-table {
        font-size: 12px;
    }

    .products-table-wrapper .modern-table thead th,
    .products-table-wrapper .modern-table tbody td {
        padding: 10px 8px;
    }

    .products-table-wrapper .product-image,
    .products-table-wrapper .product-image-placeholder {
        width: 45px;
        height: 45px;
    }
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="products-table-wrapper">
    <div class="table-container">
        <div class="table-header">
            <h2>Products Management</h2>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search products..." onkeyup="searchTable()">
                </div>
                <button class="btn-add" onclick="window.location.href='?product=add'">
                    <i class="fas fa-plus"></i>
                    اضف منتج جديد
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="modern-table" id="productsTable">
                <thead>
                    <tr>
                        <th>اسم المنتج</th>
                        <th>السعر</th>
                        <th>الخصم</th>
                        <th>المخزون</th>
                        <th>خيارات </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $query = "SELECT * FROM products ORDER BY id DESC";
                    $result = mysqli_query($connection, $query);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($product = mysqli_fetch_assoc($result)) {
                            
                            $stock_status = '';
                            $stock_class = '';
                            if($product['count'] == 0) {
                                $stock_status = 'Out of Stock';
                                $stock_class = 'stock-out';
                            } else if($product['count'] <= 10) {
                                $stock_status = 'Low Stock';
                                $stock_class = 'stock-low';
                            } else {
                                $stock_status = 'In Stock';
                                $stock_class = 'stock-in';
                            }
                            
                            // تحضير بيانات الصورة
                            $image_path = "images/" . $product['img'];
                            $has_image = !empty($product['img']) && file_exists($image_path);
                            $image_url = $has_image ? $image_path : '';
                    ?>
                    <tr data-id="<?php echo $product['id']; ?>" 
                        data-image="<?php echo htmlspecialchars($image_url); ?>"
                        data-cat="<?php echo htmlspecialchars($product['cat']); ?>"
                        data-price="<?php echo number_format($product['price'], 2); ?>"
                        data-sale="<?php echo $product['sale']; ?>"
                        data-count="<?php echo $product['count']; ?>"
                        data-name="<?php echo htmlspecialchars($product['name']); ?>">
                        <td>
                            <div class="product-info">
                                <?php if($has_image) { ?>
                                    <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                                <?php } else { ?>
                                    <div class="product-image-placeholder">
                                        <i class="fas fa-box"></i>
                                    </div>
                                <?php } ?>
                                <div class="product-details">
                                    <div class="product-name"><?php echo $product['name']; ?></div>
                                    <div class="product-category">
                                        <i class="fas fa-tag"></i> <?php echo $product['cat']; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="price-info">
                                <?php if($product['sale'] > 0) { 
                                    $final_price = $product['price'] - ($product['price'] * $product['sale'] / 100);
                                ?>
                                    <span class="sale-price">$<?php echo number_format($final_price, 2); ?></span>
                                    <span class="old-price">$<?php echo number_format($product['price'], 2); ?></span>
                                <?php } else { ?>
                                    <span class="original-price">$<?php echo number_format($product['price'], 2); ?></span>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <?php if($product['sale'] > 0) { ?>
                                <span class="badge badge-sale">
                                    <i class="fas fa-tag"></i> <?php echo $product['sale']; ?>% OFF
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-no-sale">No Sale</span>
                            <?php } ?>
                        </td>
                        <td>
                            <span class="stock-badge <?php echo $stock_class; ?>">
                                <i class="fas fa-boxes"></i>
                                <?php echo $product['count']; ?> - <?php echo $stock_status; ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="View" onclick="viewProduct(<?php echo $product['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Edit" onclick="editProduct(<?php echo $product['id']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Delete" onclick="deleteProduct(<?php echo $product['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <h3>No Products Found</h3>
                                <p>Start by adding your first product</p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- المودل -->
<div id="productModal" class="modal-overlay">
    <div class="modal-card">
        <button class="close-btn" onclick="closeProductModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="modal-header-custom">
            <div class="product-image-modal" id="productImageModal">
                <i class="fas fa-box"></i>
            </div>
            <h2>Product Details</h2>
        </div>
        
        <div class="modal-body-custom">
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="info-content">
                    <label>Product Name</label>
                    <p id="productName"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="info-content">
                    <label>Price</label>
                    <p id="productPrice"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="info-content">
                    <label>Sale</label>
                    <p id="productDiscount"></p>
                </div>
            </div>

            <div class="info-item" id="finalPriceSection" style="display: none;">
                <div class="info-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="info-content">
                    <label>Price After Sale</label>
                    <p id="productFinalPrice"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="info-content">
                    <label>Stock</label>
                    <p id="productQuantity"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="info-content">
                    <label>Category</label>
                    <p id="productCategory"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Search Function
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('productsTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const text = row.textContent || row.innerText;
        
        if (text.toLowerCase().indexOf(filter) > -1) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

// View Product Function
function viewProduct(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    
    if (!row) {
        alert('Product not found!');
        return;
    }
    
    // استخرج البيانات من الـ data attributes
    const name = row.getAttribute('data-name');
    const price = row.getAttribute('data-price');
    const sale = parseInt(row.getAttribute('data-sale'));
    const count = row.getAttribute('data-count');
    const category = row.getAttribute('data-cat');
    const image = row.getAttribute('data-image');
    
    // حط البيانات في المودل
    document.getElementById('productName').textContent = name;
    document.getElementById('productPrice').textContent = '$' + price;
    
    // اعرض الخصم
    if (sale > 0) {
        document.getElementById('productDiscount').textContent = sale + '% خصم';
        
        // احسب السعر بعد الخصم
        const originalPrice = parseFloat(price.replace(/,/g, ''));
        const finalPrice = originalPrice - (originalPrice * sale / 100);
        document.getElementById('productFinalPrice').textContent = '$' + finalPrice.toFixed(2);
        document.getElementById('finalPriceSection').style.display = 'flex';
    } else {
        document.getElementById('productDiscount').textContent = 'لا يوجد خصم';
        document.getElementById('finalPriceSection').style.display = 'none';
    }
    
    document.getElementById('productQuantity').textContent = count + ' قطعة';
    document.getElementById('productCategory').textContent = category;
    
    // حط الصورة
    const imageContainer = document.getElementById('productImageModal');
    if (image) {
        imageContainer.innerHTML = `<img src="${image}" alt="${name}">`;
    } else {
        imageContainer.innerHTML = '<i class="fas fa-box"></i>';
    }
    
    // افتح المودل
    document.getElementById('productModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeProductModal() {
    document.getElementById('productModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// إغلاق المودل لو ضغط على الخلفية
document.getElementById('productModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProductModal();
    }
});

// إغلاق المودل بزر ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProductModal();
    }
});

// Edit Product
function editProduct(id) {
    window.location.href = '?product=edit&id=' + id;
}

// Delete Product
function deleteProduct(id) {
    if(confirm('Are you sure you want to delete this product?')) {
        window.location.href = 'functions/products/delete.php?id=' + id;
    }
}
</script>