<?php
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

function getError($field) {
    global $errors;
    return isset($errors[$field]) ? $errors[$field] : '';
}

function getPlaceholder($field, $default) {
    $error = getError($field);
    return $error ? $error : $default;
}

unset($_SESSION['errors']);
?>

<style>
.product-form-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.product-form-wrapper .modern-form-container {
    background: #ffffff;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.product-form-wrapper .modern-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.product-form-wrapper .modern-form-header h2 {
    color: #10b981;
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 8px 0;
}

.product-form-wrapper .modern-form-header p {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}

.product-form-wrapper .modern-form-group {
    margin-bottom: 20px;
}

.product-form-wrapper .modern-form-group label {
    display: block;
    color: #334155;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
}

.product-form-wrapper .modern-input-wrapper {
    position: relative;
}

.product-form-wrapper .modern-input-wrapper i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #10b981;
    font-size: 16px;
    z-index: 1;
    pointer-events: none;
}

.product-form-wrapper .modern-form-control {
    width: 100%;
    padding: 12px 14px 12px 42px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.2s ease;
    background: #f8fafc;
    font-family: inherit;
}

.product-form-wrapper .modern-form-control:focus {
    outline: none;
    border-color: #10b981;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.product-form-wrapper .modern-form-control.is-invalid {
    border-color: #ef4444;
    background-color: #fff5f5;
}

.product-form-wrapper .modern-form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.product-form-wrapper .modern-form-control.is-invalid::placeholder {
    color: #ef4444;
    font-style: italic;
}

.product-form-wrapper .modern-form-control::placeholder {
    color: #94a3b8;
}

.product-form-wrapper select.modern-form-control {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2310b981' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 35px;
}

.product-form-wrapper textarea.modern-form-control {
    resize: vertical;
    min-height: 100px;
    padding: 12px 14px;
}

.product-form-wrapper .form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.product-form-wrapper .form-row .modern-form-group {
    flex: 1;
    margin-bottom: 0;
}

.product-form-wrapper .image-upload-wrapper {
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    background: #f8fafc;
    transition: all 0.2s ease;
    cursor: pointer;
}

.product-form-wrapper .image-upload-wrapper:hover {
    border-color: #10b981;
    background: #f0fdf4;
}

.product-form-wrapper .image-upload-wrapper.drag-over {
    border-color: #10b981;
    background: #d1fae5;
}

.product-form-wrapper .image-upload-icon {
    font-size: 48px;
    color: #10b981;
    margin-bottom: 15px;
}

.product-form-wrapper .image-upload-text h4 {
    color: #1e293b;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px 0;
}

.product-form-wrapper .image-upload-text p {
    color: #64748b;
    font-size: 13px;
    margin: 0;
}

.product-form-wrapper .image-preview {
    margin-top: 15px;
    display: none;
}

.product-form-wrapper .image-preview.show {
    display: block;
}

.product-form-wrapper .preview-container {
    position: relative;
    display: inline-block;
}

.product-form-wrapper .preview-image {
    max-width: 200px;
    max-height: 200px;
    border-radius: 10px;
    border: 2px solid #e2e8f0;
}

.product-form-wrapper .remove-image {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.product-form-wrapper .remove-image:hover {
    background: #dc2626;
}

.product-form-wrapper .modern-button-group {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.product-form-wrapper .modern-btn {
    padding: 12px 28px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}

.product-form-wrapper .modern-btn-primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    flex: 1;
}

.product-form-wrapper .modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.product-form-wrapper .modern-btn-secondary {
    background: #f1f5f9;
    color: #475569;
    padding: 12px 24px;
}

.product-form-wrapper .modern-btn-secondary:hover {
    background: #e2e8f0;
}

.product-form-wrapper .info-text {
    font-size: 12px;
    color: #64748b;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.product-form-wrapper .info-text i {
    color: #10b981;
    font-size: 14px;
}

@media (max-width: 768px) {
    .product-form-wrapper .modern-form-container {
        padding: 25px 20px;
    }

    .product-form-wrapper .form-row {
        flex-direction: column;
        gap: 0;
    }

    .product-form-wrapper .form-row .modern-form-group {
        margin-bottom: 20px;
    }

    .product-form-wrapper .modern-button-group {
        flex-direction: column;
    }
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="product-form-wrapper">
    <div class="modern-form-container">
        <div class="modern-form-header">
            <h2>Add New Product</h2>
            <p>Fill in the product details below</p>
        </div>

        <form action="functions/products/insert.php" method="post" enctype="multipart/form-data">
            
            <!-- Product Name -->
            <div class="modern-form-group">
                <label for="productName">Product Name</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-box"></i>
                    <input type="text" 
                           class="modern-form-control <?php echo getError('name') ? 'is-invalid' : ''; ?>" 
                           id="productName" 
                           name="name" 
                           placeholder="<?php echo getPlaceholder('name', 'Enter product name'); ?>" 
                           value="<?php echo isset($_SESSION['old']['name']) ? $_SESSION['old']['name'] : ''; ?>">
                </div>
            </div>

            <!-- Category -->
            <div class="modern-form-group">
                <label for="productCategory">Category</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-tag"></i>
                    <input type="text" 
                           class="modern-form-control <?php echo getError('cat') ? 'is-invalid' : ''; ?>" 
                           id="productCategory" 
                           name="cat" 
                           placeholder="<?php echo getPlaceholder('cat', 'e.g., Electronics, Clothing, Food'); ?>" 
                           value="<?php echo isset($_SESSION['old']['cat']) ? $_SESSION['old']['cat'] : ''; ?>">
                </div>
                <div class="info-text">
                    <i class="fas fa-info-circle"></i>
                    <span>Enter the product category (e.g., Electronics, Clothing, etc.)</span>
                </div>
            </div>

            <!-- Price and Sale Price -->
            <div class="form-row">
                <div class="modern-form-group">
                    <label for="productPrice">Original Price ($)</label>
                    <div class="modern-input-wrapper">
                        <i class="fas fa-dollar-sign"></i>
                        <input type="number" 
                               class="modern-form-control <?php echo getError('price') ? 'is-invalid' : ''; ?>" 
                               id="productPrice" 
                               name="price" 
                               placeholder="<?php echo getPlaceholder('price', '0.00'); ?>" 
                               step="0.01" 
                               min="0" 
                               value="<?php echo isset($_SESSION['old']['price']) ? $_SESSION['old']['price'] : ''; ?>">
                    </div>
                </div>

                <div class="modern-form-group">
                    <label for="productSale">Sale Price ($)</label>
                    <div class="modern-input-wrapper">
                        <i class="fas fa-tags"></i>
                        <input type="number" 
                               class="modern-form-control <?php echo getError('sale') ? 'is-invalid' : ''; ?>" 
                               id="productSale" 
                               name="sale" 
                               placeholder="<?php echo getPlaceholder('sale', '0.00 (Optional)'); ?>" 
                               step="0.01" 
                               min="0" 
                               value="<?php echo isset($_SESSION['old']['sale']) ? $_SESSION['old']['sale'] : '0'; ?>">
                    </div>
                </div>
            </div>

            <div class="info-text" style="margin-top: -15px; margin-bottom: 20px;">
                <i class="fas fa-info-circle"></i>
                <span>Leave sale price as 0 if there's no discount</span>
            </div>

            <!-- Stock Count -->
            <div class="modern-form-group">
                <label for="productCount">Stock Quantity</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-boxes"></i>
                    <input type="number" 
                           class="modern-form-control <?php echo getError('count') ? 'is-invalid' : ''; ?>" 
                           id="productCount" 
                           name="count" 
                           placeholder="<?php echo getPlaceholder('count', 'Available quantity'); ?>" 
                           min="0" 
                           value="<?php echo isset($_SESSION['old']['count']) ? $_SESSION['old']['count'] : ''; ?>">
                </div>
                <div class="info-text">
                    <i class="fas fa-info-circle"></i>
                    <span>Enter the number of items available in stock</span>
                </div>
            </div>

            <!-- Product Image -->
            <div class="modern-form-group">
                <label>Product Image</label>
                <div class="image-upload-wrapper" id="imageUploadArea">
                    <input type="file" 
                           id="productImage" 
                           name="img" 
                           accept="image/*" 
                           style="display: none;">
                    <div class="image-upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="image-upload-text">
                        <h4>Click to upload or drag and drop</h4>
                        <p>PNG, JPG, JPEG (MAX. 5MB)</p>
                    </div>
                </div>
                <div class="image-preview" id="imagePreview">
                    <div class="preview-container">
                        <img src="" alt="Preview" class="preview-image" id="previewImg">
                        <button type="button" class="remove-image" id="removeImage">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="modern-button-group">
                <button type="submit" class="modern-btn modern-btn-primary">
                    <i class="fas fa-check"></i> Add Product
                </button>
                <button type="button" class="modern-btn modern-btn-secondary" onclick="window.history.back()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Image Upload Handling
const imageUploadArea = document.getElementById('imageUploadArea');
const productImage = document.getElementById('productImage');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');
const removeImage = document.getElementById('removeImage');

// Click to upload
imageUploadArea.addEventListener('click', () => {
    productImage.click();
});

// File selection
productImage.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        displayImage(file);
    }
});

// Drag and drop
imageUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    imageUploadArea.classList.add('drag-over');
});

imageUploadArea.addEventListener('dragleave', () => {
    imageUploadArea.classList.remove('drag-over');
});

imageUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    imageUploadArea.classList.remove('drag-over');
    
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        productImage.files = e.dataTransfer.files;
        displayImage(file);
    }
});

// Display image preview
function displayImage(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        previewImg.src = e.target.result;
        imagePreview.classList.add('show');
        imageUploadArea.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

// Remove image
removeImage.addEventListener('click', () => {
    productImage.value = '';
    previewImg.src = '';
    imagePreview.classList.remove('show');
    imageUploadArea.style.display = 'block';
});

// Auto-calculate discount percentage (optional feature)
const priceInput = document.getElementById('productPrice');
const saleInput = document.getElementById('productSale');

saleInput.addEventListener('input', function() {
    const price = parseFloat(priceInput.value) || 0;
    const sale = parseFloat(saleInput.value) || 0;
    
    if (sale > price && price > 0) {
        alert('Sale price cannot be higher than original price!');
        saleInput.value = '';
    }
});
</script>