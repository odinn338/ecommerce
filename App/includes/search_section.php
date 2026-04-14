<style>
.search-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem 0;
    margin-bottom: 2rem;
}

.search-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.search-wrapper {
    position: relative;
    background: white;
    border-radius: 20px;
    padding: 8px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
}

.search-wrapper:focus-within {
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
    transform: translateY(-2px);
}

.search-icon {
    padding: 0 15px;
    color: #667eea;
}

.search-icon i {
    width: 24px;
    height: 24px;
}

#search-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 18px;
    padding: 15px 10px;
    background: transparent;
    font-family: 'Cairo', sans-serif;
}

#search-input::placeholder {
    color: #94a3b8;
}

.search-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 35px;
    border-radius: 15px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Cairo', sans-serif;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.clear-search {
    background: #fee2e2;
    color: #991b1b;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.clear-search.active {
    display: flex;
}

.clear-search:hover {
    background: #fecaca;
}

.search-suggestions {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    right: 0;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    max-height: 400px;
    overflow-y: auto;
    display: none;
    z-index: 1000;
}

.search-suggestions.active {
    display: block;
}

.suggestion-item {
    padding: 15px 20px;
    cursor: pointer;
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 15px;
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-item:hover {
    background: #f8fafc;
}

.suggestion-image {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    object-fit: cover;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
}

.suggestion-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.suggestion-info {
    flex: 1;
}

.suggestion-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 5px;
}

.suggestion-price {
    color: #667eea;
    font-weight: 700;
}

.no-results {
    padding: 30px;
    text-align: center;
    color: #64748b;
}

.no-results i {
    width: 60px;
    height: 60px;
    color: #cbd5e1;
    margin-bottom: 10px;
}

.search-filters {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Cairo', sans-serif;
    font-weight: 600;
}

.filter-btn:hover,
.filter-btn.active {
    background: white;
    color: #667eea;
}

@media (max-width: 768px) {
    .search-section {
        padding: 2rem 0;
    }
    
    .search-wrapper {
        flex-direction: column;
        gap: 10px;
    }
    
    .search-btn {
        width: 100%;
        justify-content: center;
    }
    
    #search-input {
        text-align: center;
    }
}
</style>

<section class="search-section">
    <div class="search-container">
        <div class="search-wrapper">
            <div class="search-icon">
                <i data-lucide="search"></i>
            </div>
            <input 
                type="text" 
                id="search-input" 
                placeholder="ابحث عن المنتجات..." 
                autocomplete="off"
            >
            <button class="clear-search" id="clear-search">
                <i data-lucide="x"></i>
            </button>
            <button class="search-btn" onclick="performSearch()">
                <i data-lucide="search"></i>
                <span>بحث</span>
            </button>
            
            <div class="search-suggestions" id="search-suggestions"></div>
        </div>
        
        <div class="search-filters">
            <button class="filter-btn active" onclick="filterByCategory('all')">الكل</button>
            <!-- <button class="filter-btn" onclick="filterByCategory('Electronics')">إلكترونيات</button>
            <button class="filter-btn" onclick="filterByCategory('Sports & Fitness')">رياضة</button>
            <button class="filter-btn" onclick="filterByCategory('Fashion')">أزياء</button>
            <button class="filter-btn" onclick="filterByCategory('Home')">منزل</button> -->
        </div>
    </div>
</section>

<script>
let searchTimeout;
let currentCategory = 'all';

// البحث الفوري أثناء الكتابة
document.getElementById('search-input').addEventListener('input', function(e) {
    const searchTerm = e.target.value.trim();
    const clearBtn = document.getElementById('clear-search');
    
    // إظهار/إخفاء زر المسح
    if(searchTerm.length > 0) {
        clearBtn.classList.add('active');
    } else {
        clearBtn.classList.remove('active');
        document.getElementById('search-suggestions').classList.remove('active');
        return;
    }
    
    // تأخير البحث لتحسين الأداء
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        if(searchTerm.length >= 2) {
            liveSearch(searchTerm);
        }
    }, 300);
});

// مسح البحث
document.getElementById('clear-search').addEventListener('click', function() {
    document.getElementById('search-input').value = '';
    this.classList.remove('active');
    document.getElementById('search-suggestions').classList.remove('active');
});

// البحث الفوري
function liveSearch(searchTerm) {
    fetch('functions/search_live.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'search=' + encodeURIComponent(searchTerm) + '&category=' + currentCategory
    })
    .then(response => response.json())
    .then(data => {
        displaySuggestions(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// عرض الاقتراحات
function displaySuggestions(products) {
    const suggestionsDiv = document.getElementById('search-suggestions');
    
    if(products.length === 0) {
        suggestionsDiv.innerHTML = `
            <div class="no-results">
                <i data-lucide="search-x"></i>
                <p>لم يتم العثور على نتائج</p>
            </div>
        `;
        suggestionsDiv.classList.add('active');
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        return;
    }
    
    let html = '';
    products.forEach(product => {
        const imagePath = product.img ? '../DASHBORD/images/' + product.img : '';
        const imageHtml = product.img ? 
            `<img src="${imagePath}" alt="${product.name}">` : 
            `<i data-lucide="box" style="color: #667eea;"></i>`;
        
        const finalPrice = product.sale > 0 ? 
            product.price - (product.price * product.sale / 100) : 
            product.price;
        
        html += `
            <div class="suggestion-item" onclick="selectProduct(${product.id})">
                <div class="suggestion-image">
                    ${imageHtml}
                </div>
                <div class="suggestion-info">
                    <div class="suggestion-name">${product.name}</div>
                    <div class="suggestion-price">${Math.round(finalPrice).toLocaleString()} ج.م</div>
                </div>
            </div>
        `;
    });
    
    suggestionsDiv.innerHTML = html;
    suggestionsDiv.classList.add('active');
    
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

// اختيار منتج من الاقتراحات
function selectProduct(productId) {
    window.location.href = 'product_details.php?id=' + productId;
}

// البحث الكامل
function performSearch() {
    const searchTerm = document.getElementById('search-input').value.trim();
    if(searchTerm.length > 0) {
        window.location.href = 'search_results.php?q=' + encodeURIComponent(searchTerm) + '&category=' + currentCategory;
    }
}

// فلترة حسب الفئة
function filterByCategory(category) {
    currentCategory = category;
    
    // تحديث الأزرار
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // إعادة البحث إذا كان هناك نص
    const searchTerm = document.getElementById('search-input').value.trim();
    if(searchTerm.length >= 2) {
        liveSearch(searchTerm);
    }
}

// البحث عند الضغط على Enter
document.getElementById('search-input').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        performSearch();
    }
});

// إغلاق الاقتراحات عند النقر خارجها
document.addEventListener('click', function(e) {
    const searchWrapper = document.querySelector('.search-wrapper');
    const suggestions = document.getElementById('search-suggestions');
    
    if(!searchWrapper.contains(e.target)) {
        suggestions.classList.remove('active');
    }
});

// تهيئة Lucide Icons
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}
</script>