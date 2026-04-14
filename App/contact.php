<?php include "style/navbar.php"; ?>
    <section class="contact-section">
        <div class="container">
            <div class="section-header">
                <h2>تواصل معنا</h2>
                <p>نحن هنا لمساعدتك. تواصل معنا في أي وقت</p>
            </div>
            
            <div class="contact-container">
                <div class="contact-info">
                    <h2>معلومات التواصل</h2>
                    <p>يسعدنا تلقي رسائلك واستفساراتك. فريقنا جاهز للرد عليك في أسرع وقت</p>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i data-lucide="mail"></i>
                        </div>
                        <div>
                            <h4>البريد الإلكتروني</h4>
                            <p>info@ourstore.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i data-lucide="phone"></i>
                        </div>
                        <div>
                            <h4>الهاتف</h4>
                            <p>+20 123 456 7890</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i data-lucide="map-pin"></i>
                        </div>
                        <div>
                            <h4>العنوان</h4>
                            <p>القاهرة، مصر</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i data-lucide="clock"></i>
                        </div>
                        <div>
                            <h4>ساعات العمل</h4>
                            <p>السبت - الخميس: 9 صباحاً - 6 مساءً</p>
                        </div>
                    </div>
                </div>



                <div class="contact-form">
                    <h2>أرسل رسالة</h2>

                    <form action="functions/messages/send_message.php" method="POST">
           
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text"  value="<?php if(isset($_SESSION['login'])) { echo $_SESSION['login']['name']; }else{ echo ''; } ?>" id="name" name="name" placeholder="أدخل اسمك" >
                        </div>
                    
                        
                   
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" value="<?php if(isset($_SESSION['login'])) { echo $_SESSION['login']['email']; }else{ echo ''; } ?>" name="email" id="email" placeholder="example@email.com" >
                        </div>
                       

                        <div class="form-group">
                            <label for="subject">الموضوع</label>
                            <input type="text" name="about" id="subject" placeholder="موضوع الرسالة" >
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="message">الرسالة</label>
                            <textarea id="message" name="message" placeholder="اكتب رسالتك هنا..." ></textarea>
                        </div>
                        


                        <button type="submit" class="btn-primary form-submit">
                            إرسال الرسالة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include "style/footer.php"; ?>
    