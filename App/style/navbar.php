<?php
session_name("FRONT_SESSION");
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ُEAZY SHOP</title>
    <link rel="stylesheet" href="style.css">
   <!-- <script src="https://unpkg.com/lucide@latest"></script> -->
</head>
<body>
    <nav class="navbar">
        <div class="container nav-container">
            <div class="logo">
                <i data-lucide="shopping-bag"></i>
                <a  style="text-decoration: none; color: var(--primary-dark);"  href="index.php">EAZY SHOP</a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">الرئيسية</a></li>
                <li><a href="products.php">المنتجات</a></li>
                <li><a href="contact.php">تواصل معنا</a></li>
            </ul>
            <div class="nav-actions">
                <a href="cart.php" class="cart-btn">
                    <i data-lucide="shopping-cart"></i>
                    <span class="cart-count">0</span>
                </a>
                <?php if(isset($_SESSION['login'])){ ?>
                    <a href="functions/auth/logout.php" style="background-color: var(--danger); color: white; padding: 0.5rem 1rem; border-radius: var(--radius); text-decoration: none; display: flex; align-items: center; gap: 0.5rem;" ><i data-lucide="log-in"></i>
                                <span>تسجيل الخروج</span> </a>
                <?php }else{ ?>
                    <a href="login.php" class="btn-secondary" style="display: flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="log-in"></i>
                                <span>تسجيل الدخول</span>
                    </a>
                <?php } ?>
              

            </div>

<?php if(isset($_SESSION['login'])){ ?>
    <div class="welcome-box">
    <style>
        .welcome-box {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .welcome-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .welcome-box .user-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .welcome-box .user-icon svg {
            width: 22px;
            height: 22px;
            color: #ffffff;
        }

        .welcome-box .welcome-text {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* RTL Support */
        [dir="rtl"] .welcome-box {
            flex-direction: row-reverse;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-box {
                padding: 0.75rem 1.25rem;
            }
            
            .welcome-box .welcome-text {
                font-size: 1rem;
            }
        }
    </style>

    <div class="user-icon">
        <i data-lucide="user"></i>
    </div>
    <span class="welcome-text">مرحباً بك <?= $_SESSION['login']['name']?> </span>
</div>
<?php }; ?>
        </div>
    </nav>