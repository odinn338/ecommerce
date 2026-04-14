
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

.user-form-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.user-form-wrapper .modern-form-container {
    background: #ffffff;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.user-form-wrapper .modern-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.user-form-wrapper .modern-form-header h2 {
    color: #6366f1;
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 8px 0;
}

.user-form-wrapper .modern-form-header p {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}

.user-form-wrapper .modern-form-group {
    margin-bottom: 20px;
}

.user-form-wrapper .modern-form-group label {
    display: block;
    color: #334155;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
}

.user-form-wrapper .modern-input-wrapper {
    position: relative;
}

.user-form-wrapper .modern-input-wrapper i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #6366f1;
    font-size: 16px;
    z-index: 1;
    pointer-events: none;
}

.user-form-wrapper .modern-form-control {
    width: 100%;
    padding: 12px 14px 12px 42px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.2s ease;
    background: #f8fafc;
    font-family: inherit;
}

.user-form-wrapper .modern-form-control:focus {
    outline: none;
    border-color: #6366f1;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.user-form-wrapper .modern-form-control.is-invalid {
    border-color: #ef4444;
    background-color: #fff5f5;
}

.user-form-wrapper .modern-form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.user-form-wrapper .modern-form-control.is-invalid::placeholder {
    color: #ef4444;
    font-style: italic;
}

.user-form-wrapper .modern-form-control::placeholder {
    color: #94a3b8;
}

.user-form-wrapper select.modern-form-control {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236366f1' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 35px;
}

.user-form-wrapper .form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.user-form-wrapper .form-row .modern-form-group {
    flex: 1;
    margin-bottom: 0;
}

.user-form-wrapper .modern-button-group {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.user-form-wrapper .modern-btn {
    padding: 12px 28px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}

.user-form-wrapper .modern-btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    flex: 1;
}

.user-form-wrapper .modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
}

.user-form-wrapper .modern-btn-secondary {
    background: #f1f5f9;
    color: #475569;
    padding: 12px 24px;
}

.user-form-wrapper .modern-btn-secondary:hover {
    background: #e2e8f0;
}

@media (max-width: 768px) {
    .user-form-wrapper .modern-form-container {
        padding: 25px 20px;
    }

    .user-form-wrapper .form-row {
        flex-direction: column;
        gap: 0;
    }

    .user-form-wrapper .form-row .modern-form-group {
        margin-bottom: 20px;
    }

    .user-form-wrapper .modern-button-group {
        flex-direction: column;
    }
}
</style>
<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="user-form-wrapper">
    <div class="modern-form-container">
        <div class="modern-form-header">
            <h2>Create Account</h2>
            <p>Fill in your details to register</p>
        </div>

        <form action="functions/users/insert.php" method="post">
            <div class="modern-form-group">
                <label for="userName">Full Name</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" 
                           class="modern-form-control <?php echo getError('name') ? 'is-invalid' : ''; ?>" 
                           id="userName" 
                           name="name" 
                           placeholder="<?php echo getPlaceholder('name', 'Enter your name'); ?>" 
                           value="<?php echo isset($_SESSION['old']['name']) ? $_SESSION['old']['name'] : ''; ?>"
                           >
                </div>
            </div>

            <div class="modern-form-group">
                <label for="userEmail">Email Address</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" 
                           class="modern-form-control <?php echo getError('email') ? 'is-invalid' : ''; ?>" 
                           id="userEmail" 
                           name="email" 
                           placeholder="<?php echo getPlaceholder('email', 'your@email.com'); ?>" 
                           value="<?php echo isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : ''; ?>"
                           >
                </div>
            </div>

            <div class="modern-form-group">
                <label for="userPassword">Password</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" 
                           class="modern-form-control <?php echo getError('password') ? 'is-invalid' : ''; ?>" 
                           id="userPassword" 
                           name="password" 
                           placeholder="<?php echo getPlaceholder('password', 'Create a strong password'); ?>" 
                           >
                </div>
            </div>

            <div class="modern-form-group">
                <label for="userAge">Age</label>
                <div class="modern-input-wrapper">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="number" 
                           class="modern-form-control <?php echo getError('age') ? 'is-invalid' : ''; ?>" 
                           id="userAge" 
                           name="age" 
                           placeholder="<?php echo getPlaceholder('age', 'Enter your age'); ?>" 
                           min="1" 
                           max="120" 
                           value="<?php echo isset($_SESSION['old']['age']) ? $_SESSION['old']['age'] : ''; ?>"
                           >
                </div>
            </div>

            <div class="form-row">
                <div class="modern-form-group">
                    <label for="userGender">Gender</label>
                    <div class="modern-input-wrapper">
                        <i class="fas fa-venus-mars"></i>
                        <select class="modern-form-control" 
                                id="userGender" 
                                name="gender" 
                                >
                            <option value="">Select...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="modern-form-group">
                    <label for="userRole">Role</label>
                    <div class="modern-input-wrapper">
                        <i class="fas fa-user-shield"></i>
                        <select class="modern-form-control" 
                                id="userRole" 
                                name="role" 
                                >
                            <option value="">Select...</option>
                            <option value="owner">Owner</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modern-button-group">
                <button type="submit" class="modern-btn modern-btn-primary">
                    Submit
                </button>
                <button type="button" class="modern-btn modern-btn-secondary" onclick="window.history.back()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>