<?php include "style/navbar.php"; ?>
<?php
if ( isset($_SESSION['login'])) {
    header('Location: index.php');
}else{?>
    <section class="auth-container">
        <div class="container">
            <div class="auth-box">
                <div class="auth-header">
                    <h1>تسجيل الدخول</h1>
                    <p>مرحباً بك مرة أخرى</p>
                </div>
                <form  action="functions/auth/login_.php" method="post">
                <?php if(isset($_SESSION['errors']['email'])) { ?>
                        <div style="height: 40px; width: 100%; color: red;"><?= $_SESSION['errors']['email'] ?></div>
                        <?php }?>
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" placeholder="example@email.com" >
                    </div>


                        <?php if(isset($_SESSION['errors']['password'])) { ?>
                        <div style="height: 40px; width: 100%; color: red;"><?= $_SESSION['errors']['password'] ?></div>
                        <?php } unset($_SESSION['errors']); ?>
                    
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" >
                    </div>
                    
                    <button type="submit" class="btn-primary form-submit">
                        تسجيل الدخول
                    </button>
                </form>
                
                <div class="auth-footer">
                    <p>ليس لديك حساب؟ <a href="signup.php">سجل الآن</a></p>
                </div>
            </div>
        </div>
    </section>
<?php include "style/footer.php"; ?>
<?php } ?>