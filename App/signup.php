<?php include "style/navbar.php";  ?>
<?php
if ( isset($_SESSION['login'])) {
    header('Location: index.php');
}else{?>
    <section class="auth-container">
        <div class="container">
            <div class="auth-box">
                <div class="auth-header">
                    <h1>إنشاء حساب جديد</h1>
                    <p>انضم إلينا واستمتع بتجربة تسوق مميزة</p>
                </div>

                

                <form action="functions/auth/newUser.php" method="POST" >
                    <div class="form-group">
                        <label for="name">الاسم الكامل</label>
                        <input type="text" name="name" id="name" placeholder="أدخل اسمك الكامل" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" name="email" id="email" placeholder="example@email.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>

                    
                    <div class="form-group">
                        <label for="age">السن</label>
                        <input type="text" name="age" id="age" placeholder="أدخل سنك" required>
                    </div>


              <div class="form-row">
    <div class="modern-form-group">
        <label for="userGender">النوع</label>
        <div class="modern-input-wrapper">
            <i class="fas fa-venus-mars"></i>
            
            <select class="modern-form-control" 
                    id="userGender" 
                    name="gender" 
            >
                <option value="">اختر...</option>
                <option value="male">ذكر</option>
                <option value="female">انثي</option>
            </select>
        </div>
    </div>
</div>
                    
                    <button type="submit" class="btn-primary form-submit">
                        إنشاء حساب
                    </button>
                </form>
                
                <div class="auth-footer">
                    <p>لديك حساب بالفعل؟ <a href="login.php">سجل الدخول</a></p>
                </div>
            </div>
        </div>
    </section>

   <?php include "style/footer.php"; ?>
<?php } ?>