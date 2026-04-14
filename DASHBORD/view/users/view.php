
<?php if(isset($_SESSION['success'])){  ?>

    <div class="alert alert-success d-flex justify-content-center align-items-center"><?= $_SESSION['success'] ?></div>

  <?php } unset($_SESSION['success']) ?>
<?php
require "functions/connection.php";
?>



<style>

.users-table-wrapper {
    max-width: 100%;
    margin: 0 auto;
}

.users-table-wrapper .table-container {
    background: #ffffff;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.users-table-wrapper .table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.users-table-wrapper .table-header h2 {
    color: #1e293b;
    font-size: 24px;
    font-weight: 700;
    margin: 0;
}

.users-table-wrapper .table-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.users-table-wrapper .search-box {
    position: relative;
}

.users-table-wrapper .search-box input {
    padding: 10px 15px 10px 40px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    width: 250px;
    transition: all 0.2s ease;
}

.users-table-wrapper .search-box input:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.users-table-wrapper .search-box i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.users-table-wrapper .btn-add {
    padding: 10px 20px;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
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

.users-table-wrapper .btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
}

.users-table-wrapper .table-responsive {
    overflow-x: auto;
}

.users-table-wrapper .modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.users-table-wrapper .modern-table thead {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
}

.users-table-wrapper .modern-table thead th {
    padding: 15px;
    text-align: left;
    color: white;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.users-table-wrapper .modern-table thead th:first-child {
    border-radius: 10px 0 0 0;
}

.users-table-wrapper .modern-table thead th:last-child {
    border-radius: 0 10px 0 0;
    text-align: center;
}

.users-table-wrapper .modern-table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.users-table-wrapper .modern-table tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.users-table-wrapper .modern-table tbody tr:last-child {
    border-bottom: none;
}

.users-table-wrapper .modern-table tbody td {
    padding: 15px;
    color: #475569;
    font-size: 14px;
}

.users-table-wrapper .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.users-table-wrapper .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 16px;
}

.users-table-wrapper .user-details .user-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 2px;
}

.users-table-wrapper .user-details .user-email {
    font-size: 12px;
    color: #94a3b8;
}

.users-table-wrapper .badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.users-table-wrapper .badge-owner {
    background: #fef3c7;
    color: #92400e;
}

.users-table-wrapper .badge-admin {
    background: #ddd6fe;
    color: #5b21b6;
}

.users-table-wrapper .badge-user {
    background: #dbeafe;
    color: #1e40af;
}

.users-table-wrapper .badge-male {
    background: #e0f2fe;
    color: #075985;
}

.users-table-wrapper .badge-female {
    background: #fce7f3;
    color: #9f1239;
}

.users-table-wrapper .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.users-table-wrapper .btn-action {
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

.users-table-wrapper .btn-view {
    background: #e0f2fe;
    color: #0369a1;
}

.users-table-wrapper .btn-view:hover {
    background: #0ea5e9;
    color: white;
    transform: translateY(-2px);
}

.users-table-wrapper .btn-edit {
    background: #dbeafe;
    color: #1e40af;
}

.users-table-wrapper .btn-edit:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
}

.users-table-wrapper .btn-delete {
    background: #fee2e2;
    color: #991b1b;
}

.users-table-wrapper .btn-delete:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px);
}

.users-table-wrapper .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}

.users-table-wrapper .empty-state i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.3;
}

.users-table-wrapper .empty-state h3 {
    font-size: 20px;
    color: #64748b;
    margin-bottom: 8px;
}

.users-table-wrapper .empty-state p {
    font-size: 14px;
}

@media (max-width: 768px) {
    .users-table-wrapper .table-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .users-table-wrapper .search-box input {
        width: 100%;
    }

    .users-table-wrapper .table-actions {
        width: 100%;
        flex-direction: column;
    }

    .users-table-wrapper .modern-table {
        font-size: 12px;
    }

    .users-table-wrapper .modern-table thead th,
    .users-table-wrapper .modern-table tbody td {
        padding: 10px 8px;
    }

    .users-table-wrapper .user-avatar {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="users-table-wrapper">
    <div class="table-container">
        <div class="table-header">
            <h2>Users Management</h2>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search users..." onkeyup="searchTable()">
                </div>
                <button class="btn-add" onclick="window.location.href='?user=add'">
                    <i class="fas fa-plus"></i>
                    اضف مستخدم جديد
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="modern-table" id="usersTable">
                <thead>
                    <tr>
                        <th>اسم المستخدم</th>
                        <th>العمر</th>
                        <th>النوع</th>
                        <th>الدور</th>
                           <?php 
                        //    if( $_SESSION['login']['role'] == 'owner' || $_SESSION['login']['role'] == 'admin'){ 
                            ?>
                            <th>خيارات </th>
                           <?php 
                        //    }
                            ?>

                    </tr>
                </thead>
                <tbody>
                    <?php
                  
                    $query = "SELECT * FROM users ORDER BY id DESC";
                    $result = mysqli_query($connection, $query);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($user = mysqli_fetch_assoc($result)) {
                            $initials = strtoupper(substr($user['name'], 0, 1));
                    ?>
                    <tr data-id="<?php echo $user['id']; ?>">
                        <td>
                            <div class="user-info">
                                <div class="user-avatar"><?php echo $initials; ?></div>
                                <div class="user-details">
                                    <div class="user-name"><?php echo $user['name']; ?></div>
                                    <div class="user-email"><?php echo $user['email']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $user['age']; ?> years</td>
                        <td>
                            <span class="badge badge-<?php echo $user['gender']; ?>">
                                <?php echo ucfirst($user['gender']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-<?php echo $user['role']; ?>">
                                <?php echo ucfirst($user['role']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                             
                             
                                <button class="btn-action btn-view" title="View" onclick="viewUser(<?= $user['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>












                                
                                <?php
                                // التحقق من الصلاحيات للتعديل
                                if ($_SESSION['login']['role'] == 'owner' || 
                                    ($_SESSION['login']['role'] == 'admin' && 
                                     ($user['role'] == 'user' || $_SESSION['login']['id'] == $user['id']))
                                ) {
                                ?>
                                <button class="btn-action btn-edit" title="Edit" onclick="editUser(<?php echo $user['id']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php
                                }
                                // التحقق من صلاحيات الحذف
                                if ($_SESSION['login']['role'] == 'owner' ||
                                    ($_SESSION['login']['role'] == 'admin' && $user['role'] == 'user')) {
                                ?>
                                <button class="btn-action btn-delete" title="Delete" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else if(mysqli_num_rows($result) == 0) {
                    ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h3>No Users Found</h3>
                                <p>Start by adding your first user</p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="userModal" class="modal-overlay">
    <div class="modal-card">
        <button class="close-btn" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="modal-header-custom">
            <div class="user-avatar-modal" id="userAvatarModal">A</div>
            <h2 id="h22">User data</h2>
        </div>
        
        <div class="modal-body-custom">
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="info-content">
                    <label>Name</label>
                    <p id="userName"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-content">
                    <label>Email</label>
                    <p id="userEmail"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="info-content">
                    <label>Age</label>
                    <p id="userAge"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-user-tag"></i>
                </div>
                <div class="info-content">
                    <label>Role</label>
                    <p id="userRole"></p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-venus-mars"></i>
                </div>
                <div class="info-content">
                    <label>Gender</label>
                    <p id="userGender"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

.user-avatar-modal {
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
    font-weight: 600;
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
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.info-item:hover {
    transform: translateX(-5px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
}

.info-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    color: #667eea;
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
</style>

<script>
// Search Function
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('usersTable');
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

// View User
// تعديل function viewUser الموجودة
function viewUser(id) {
    // جيب الصف اللي فيه البيانات
    const row = document.querySelector(`tr[data-id="${id}"]`);
    
    // استخرج البيانات من الصف
    const name = row.querySelector('.user-name').textContent;
    const email = row.querySelector('.user-email').textContent;
    const age = row.querySelector('td:nth-child(2)').textContent.replace(' years', '');
    const gender = row.querySelector('.badge-male, .badge-female').textContent.trim();
    const role = row.querySelector('.badge-owner, .badge-admin, .badge-user').textContent.trim();
    const initials = row.querySelector('.user-avatar').textContent;
    
    // حط البيانات في المودل
    document.getElementById('userName').textContent = name;
    document.getElementById('userEmail').textContent = email;
    document.getElementById('userAge').textContent = age ;
    document.getElementById('userRole').textContent = role;
    document.getElementById('userGender').textContent = gender;
    document.getElementById('userAvatarModal').textContent = initials;
    document.getElementById('h22').textContent = name + "'s Data";
    
    // افتح المودل
    document.getElementById('userModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('userModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// إغلاق المودل لو ضغط على الخلفية
document.getElementById('userModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// إغلاق المودل بزر ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Edit User
function editUser(id) {
    const userRole = '<?php echo $_SESSION['login']['role']; ?>';
    const currentUserId = <?php echo $_SESSION['login']['id']; ?>;
    const targetUserRole = document.querySelector(`tr[data-id="${id}"] .badge`).textContent.toLowerCase().trim();
    
    // التحقق من الصلاحيات
    if (userRole === 'owner' || 
        (userRole === 'admin' && (targetUserRole === 'user' || currentUserId === id))) {
        window.location.href = '?user=edit&id=' + id;
    } else {
        alert('You do not have permission to edit this user.');
    }
}

// Delete User
function deleteUser(id) {
    const userRole = '<?php echo $_SESSION['login']['role']; ?>';
    const targetUserRole = document.querySelector(`tr[data-id="${id}"] .badge`).textContent.toLowerCase().trim();
    
    // التحقق من صلاحيات الحذف
    if (userRole === 'owner' || 
        (userRole === 'admin' && targetUserRole === 'user')) {
        if(confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'functions/users/delete.php?id=' + id;
        }
    } else {
        alert('You do not have permission to delete this user.');
    }
}
</script>