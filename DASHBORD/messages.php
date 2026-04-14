<?php include "style/navbar.php"; 
    include "style/sidebar.php";
?>
<?php if(isset($_SESSION['success'])){  ?>
    <div class="alert alert-success d-flex justify-content-center align-items-center"><?= $_SESSION['success'] ?></div>
<?php } unset($_SESSION['success']) ?>

<?php
require "functions/connection.php";
?>

<style>
.messages-table-wrapper {
    max-width: 100%;
    margin: 0 auto;
}

.messages-table-wrapper .table-container {
    background: #ffffff;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.messages-table-wrapper .table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.messages-table-wrapper .table-header h2 {
    color: #1e293b;
    font-size: 24px;
    font-weight: 700;
    margin: 0;
}

.messages-table-wrapper .table-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.messages-table-wrapper .search-box {
    position: relative;
}

.messages-table-wrapper .search-box input {
    padding: 10px 40px 10px 15px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    width: 250px;
    transition: all 0.2s ease;
}

.messages-table-wrapper .search-box input:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.messages-table-wrapper .search-box i {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.messages-table-wrapper .filter-buttons {
    display: flex;
    gap: 8px;
}

.messages-table-wrapper .filter-btn {
    padding: 8px 16px;
    border: 2px solid #e2e8f0;
    background: white;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    color: #64748b;
}

.messages-table-wrapper .filter-btn:hover {
    border-color: #6366f1;
    color: #6366f1;
}

.messages-table-wrapper .filter-btn.active {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-color: #6366f1;
    color: white;
}

.messages-table-wrapper .table-responsive {
    overflow-x: auto;
}

.messages-table-wrapper .modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.messages-table-wrapper .modern-table thead {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
}

.messages-table-wrapper .modern-table thead th {
    padding: 15px;
    text-align: right;
    color: white;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.messages-table-wrapper .modern-table thead th:first-child {
    border-radius: 10px 0 0 0;
}

.messages-table-wrapper .modern-table thead th:last-child {
    border-radius: 0 10px 0 0;
    text-align: center;
}

.messages-table-wrapper .modern-table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.messages-table-wrapper .modern-table tbody tr:hover {
    background: #f0f4ff;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.messages-table-wrapper .modern-table tbody tr.unread {
    background: #fef3c7;
}

.messages-table-wrapper .modern-table tbody tr.unread:hover {
    background: #fef08a;
}

.messages-table-wrapper .modern-table tbody tr:last-child {
    border-bottom: none;
}

.messages-table-wrapper .modern-table tbody td {
    padding: 15px;
    color: #475569;
    font-size: 14px;
    text-align: right;
}

.messages-table-wrapper .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.messages-table-wrapper .user-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    font-weight: 700;
    flex-shrink: 0;
}

.messages-table-wrapper .user-details .user-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 2px;
}

.messages-table-wrapper .user-details .user-email {
    font-size: 12px;
    color: #94a3b8;
}

.messages-table-wrapper .message-preview {
    max-width: 400px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #64748b;
}

.messages-table-wrapper .message-preview.unread {
    font-weight: 600;
    color: #1e293b;
}

.messages-table-wrapper .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.messages-table-wrapper .status-read {
    background: #d1fae5;
    color: #065f46;
}

.messages-table-wrapper .status-unread {
    background: #fef3c7;
    color: #92400e;
}

.messages-table-wrapper .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.messages-table-wrapper .btn-action {
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

.messages-table-wrapper .btn-view {
    background: #e0f2fe;
    color: #0369a1;
}

.messages-table-wrapper .btn-view:hover {
    background: #0ea5e9;
    color: white;
    transform: translateY(-2px);
}

.messages-table-wrapper .btn-reply {
    background: #dbeafe;
    color: #1e40af;
}

.messages-table-wrapper .btn-reply:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
}

.messages-table-wrapper .btn-delete {
    background: #fee2e2;
    color: #991b1b;
}

.messages-table-wrapper .btn-delete:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px);
}

.messages-table-wrapper .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}

.messages-table-wrapper .empty-state i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.3;
}

.messages-table-wrapper .empty-state h3 {
    font-size: 20px;
    color: #64748b;
    margin-bottom: 8px;
}

.messages-table-wrapper .empty-state p {
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
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-radius: 25px;
    width: 90%;
    max-width: 600px;
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

.message-icon-modal {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 35px;
    border: 3px solid rgba(255, 255, 255, 0.3);
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
    max-height: 500px;
    overflow-y: auto;
}

.info-item {
    display: flex;
    align-items: flex-start;
    padding: 18px;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 15px;
    transition: all 0.3s ease;
    border: 1px solid rgba(99, 102, 241, 0.1);
}

.info-item:hover {
    transform: translateX(-5px);
    box-shadow: 0 5px 15px rgba(99, 102, 241, 0.2);
}

.info-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
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
    color: #6366f1;
    font-weight: 600;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-content p {
    margin: 0;
    font-size: 15px;
    color: #333;
    font-weight: 500;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .messages-table-wrapper .table-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .messages-table-wrapper .search-box input {
        width: 100%;
    }

    .messages-table-wrapper .table-actions {
        width: 100%;
        flex-direction: column;
    }

    .messages-table-wrapper .modern-table {
        font-size: 12px;
    }

    .messages-table-wrapper .modern-table thead th,
    .messages-table-wrapper .modern-table tbody td {
        padding: 10px 8px;
    }

    .messages-table-wrapper .message-preview {
        max-width: 150px;
    }
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="messages-table-wrapper">
    <div class="table-container">
        <div class="table-header">
            <h2>إدارة الرسائل</h2>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="ابحث في الرسائل..." onkeyup="searchTable()">
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active" onclick="filterMessages('all')">الكل</button>
                    <button class="filter-btn" onclick="filterMessages('unread')">غير مقروءة</button>
                    <button class="filter-btn" onclick="filterMessages('read')">مقروءة</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="modern-table" id="messagesTable">
                <thead>
                    <tr>
                        <th>المرسل</th>
                        <th>البريد الإلكتروني</th>
                        <th>الرسالة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM messages ORDER BY id DESC";
                    $result = mysqli_query($connection, $query);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($message = mysqli_fetch_assoc($result)) {
                            // تحديد حالة القراءة (افترض وجود عمود 'view' في قاعدة البيانات)
                            $is_read = isset($message['view']) && $message['view'] == 1;
                            $row_class = $is_read ? '' : 'unread';
                            $message_class = $is_read ? '' : 'unread';
                            $status_class = $is_read ? 'status-read' : 'status-unread';
                            $status_text = $is_read ? 'مقروءة' : 'غير مقروءة';
                            $status_icon = $is_read ? 'fa-check-double' : 'fa-envelope';
                            
                            // اختصار الرسالة
                            $preview = mb_substr($message['message'], 0, 80) . (mb_strlen($message['message']) > 80 ? '...' : '');
                            
                            // أول حرف من الاسم للأفاتار
                            $initial = mb_substr($message['name'], 0, 1);
                    ?>
                    <tr class="<?php echo $row_class; ?>" 
                        data-id="<?php echo $message['id']; ?>"
                        data-status="<?php echo $is_read ? 'read' : 'unread'; ?>"
                        data-name="<?php echo htmlspecialchars($message['name']); ?>"
                        data-email="<?php echo htmlspecialchars($message['email']); ?>"
                        data-message="<?php echo htmlspecialchars($message['message']); ?>"
                        data-about="<?php echo htmlspecialchars($message['about']); ?>">
                        <td>
                            <div class="user-info">
                                <div class="user-avatar"><?php echo $initial; ?></div>
                                <div class="user-details">
                                    <div class="user-name"><?php echo $message['name']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-email"><?php echo $message['email']; ?></div>
                        </td>
                        <td>
                            <div class="message-preview <?php echo $message_class; ?>">
                                <?php echo $preview; ?>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge <?php echo $status_class; ?>">
                                <i class="fas <?php echo $status_icon; ?>"></i>
                                <?php echo $status_text; ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="عرض" onclick="viewMessage(<?php echo $message['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-action btn-reply" title="رد" onclick="replyMessage('<?php echo htmlspecialchars($message['email']); ?>')">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn-action btn-delete" title="حذف" onclick="deleteMessage(<?php echo $message['id']; ?>)">
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
                                <i class="fas fa-envelope-open"></i>
                                <h3>لا توجد رسائل</h3>
                                <p>لم يتم استلام أي رسائل بعد</p>
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
<div id="messageModal" class="modal-overlay">
    <div class="modal-card">
        <button class="close-btn" onclick="closeMessageModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="modal-header-custom">
            <div class="message-icon-modal">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h2>تفاصيل الرسالة</h2>
        </div>
        
        <div class="modal-body-custom">
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="info-content">
                    <label>اسم المرسل</label>
                    <p id="messageName"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-content">
                    <label>البريد الإلكتروني</label>
                    <p id="messageEmail"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="info-content">
                    <label>الموضوع</label>
                    <p id="messageAbout"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-comment-alt"></i>
                </div>
                <div class="info-content">
                    <label>الرسالة</label>
                    <p id="messageContent" style="white-space: pre-wrap;"></p>
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
    const table = document.getElementById('messagesTable');
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

// Filter Messages
function filterMessages(status) {
    const table = document.getElementById('messagesTable');
    const rows = table.getElementsByTagName('tr');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const rowStatus = row.getAttribute('data-status');
        
        if (status === 'all' || rowStatus === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

// View Message
function viewMessage(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    
    if (!row) {
        alert('الرسالة غير موجودة!');
        return;
    }
    
    const name = row.getAttribute('data-name');
    const email = row.getAttribute('data-email');
    const message = row.getAttribute('data-message');
    const about = row.getAttribute('data-about');
    
    document.getElementById('messageName').textContent = name;
    document.getElementById('messageEmail').textContent = email;
    document.getElementById('messageAbout').textContent = about || 'غير محدد';
    document.getElementById('messageContent').textContent = message;
    
    document.getElementById('messageModal').classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // تحديث حالة الرسالة لمقروءة
    markAsRead(id, row);
}

function closeMessageModal() {
    document.getElementById('messageModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// إغلاق المودل عند الضغط على الخلفية
document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMessageModal();
    }
});

// إغلاق المودل بزر ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMessageModal();
    }
});

// Reply to Message
function replyMessage(email) {
    window.location.href = 'mailto:' + email;
}

// Delete Message
function deleteMessage(id) {
    if(confirm('هل أنت متأكد من حذف هذه الرسالة؟')) {
        window.location.href = 'functions/messages/delete.php?id=' + id;
    }
}

// Mark as Read (يمكنك إرسال طلب AJAX لتحديث قاعدة البيانات)
function markAsRead(id, row) {
    // إرسال طلب AJAX لتحديث حالة القراءة في قاعدة البيانات
    fetch('functions/messages/mark_read.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                row.classList.remove('unread');
                row.setAttribute('data-status', 'read');
                
                const statusBadge = row.querySelector('.status-badge');
                statusBadge.className = 'status-badge status-read';
                statusBadge.innerHTML = '<i class="fas fa-check-double"></i> مقروءة';
                
                const messagePreview = row.querySelector('.message-preview');
                messagePreview.classList.remove('unread');
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>