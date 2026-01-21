<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - <?php echo SITE_NAME; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .register-container {
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.5s ease;
        }
        
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            font-size: 50px;
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .logo h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .logo p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 18px;
        }
        
        .input-with-icon .form-control {
            padding-left: 50px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-secondary {
            background: #6c757d;
            margin-top: 15px;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 7px 20px rgba(108, 117, 125, 0.4);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #7f8c8d;
            font-size: 15px;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            animation: fadeIn 0.5s;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .password-strength {
            margin-top: 8px;
            height: 5px;
            border-radius: 3px;
            background: #eee;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s;
        }
        
        .strength-weak { background: #dc3545; width: 33%; }
        .strength-medium { background: #ffc107; width: 66%; }
        .strength-strong { background: #28a745; width: 100%; }
        
        .password-hint {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .terms {
            display: flex;
            align-items: flex-start;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .terms input {
            margin-left: 10px;
            margin-top: 3px;
        }
        
        .terms label {
            margin-bottom: 0;
            font-size: 13px;
            color: #666;
        }
        
        .terms a {
            color: #667eea;
            text-decoration: none;
        }
        
        .terms a:hover {
            text-decoration: underline;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* تحسينات للجوال */
        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
            }
            
            .logo h1 {
                font-size: 24px;
            }
        }
        
        /* تأثيرات إضافية */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 18px;
        }
        
        .password-toggle:hover {
            color: #667eea;
        }
        
        .progress-text {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 3px;
        }
        
        /* رسالة التحميل */
        .loading {
            display: none;
            text-align: center;
            margin: 10px 0;
        }
        
        .loading span {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- الشعار -->
            <div class="logo">
                <div class="logo-icon">📚</div>
                <h1>انضم إلينا اليوم</h1>
                <p>أنشئ حسابك وابدأ رحلتك مع الكتب</p>
            </div>
            
            <!-- رسائل التنبيه -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    ❌ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <!-- نموذج التسجيل -->
            <form action="<?php echo BASE_URL; ?>?url=auth/doRegister" method="POST" id="registerForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">اسم المستخدم</label>
                        <div class="input-with-icon">
                            <span class="input-icon">👤</span>
                            <input type="text" 
                                   id="username" 
                                   name="username" 
                                   class="form-control" 
                                   placeholder="اختر اسم مستخدم"
                                   value="<?php echo $_POST['username'] ?? ''; ?>"
                                   required
                                   oninput="checkUsername()">
                        </div>
                        <div id="username-feedback" class="password-hint"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <div class="input-with-icon">
                            <span class="input-icon">📧</span>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="أدخل بريدك الإلكتروني"
                                   value="<?php echo $_POST['email'] ?? ''; ?>"
                                   required
                                   oninput="checkEmail()">
                        </div>
                        <div id="email-feedback" class="password-hint"></div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🔒</span>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="أنشئ كلمة مرور قوية"
                                   required
                                   oninput="checkPasswordStrength()">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                👁️
                            </button>
                        </div>
                        <div class="password-strength">
                            <div id="strength-bar" class="strength-bar"></div>
                        </div>
                        <div id="password-hint" class="password-hint">
                            يجب أن تكون 8 أحرف على الأقل وتحتوي على حروف وأرقام
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">تأكيد كلمة المرور</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🔒</span>
                            <input type="password" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   class="form-control" 
                                   placeholder="أعد إدخال كلمة المرور"
                                   required
                                   oninput="checkPasswordMatch()">
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                                👁️
                            </button>
                        </div>
                        <div id="confirm-feedback" class="password-hint"></div>
                    </div>
                </div>
                
                <!-- الشروط والأحكام -->
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        أوافق على 
                        <a href="<?php echo BASE_URL; ?>?url=terms" target="_blank">الشروط والأحكام</a> 
                        و 
                        <a href="<?php echo BASE_URL; ?>?url=privacy" target="_blank">سياسة الخصوصية</a>
                    </label>
                </div>
                
                <!-- رسالة التحميل -->
                <div id="loading" class="loading">
                    <span></span> جاري إنشاء الحساب...
                </div>
                
                <button type="submit" class="btn" id="submitBtn">
                    ✅ إنشاء حساب جديد
                </button>
            </form>
            
            <!-- رابط تسجيل الدخول -->
            <div class="login-link">
                لديك حساب بالفعل؟ 
                <a href="<?php echo BASE_URL; ?>?url=auth/login">سجل الدخول هنا</a>
            </div>
            
            <a href="<?php echo BASE_URL; ?>?url=home" class="btn btn-secondary">
                🏠 العودة للرئيسية
            </a>
        </div>
    </div>

    <script>
        // إظهار/إخفاء كلمة المرور
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = passwordInput.nextElementSibling;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.textContent = '👁️‍🗨️';
            } else {
                passwordInput.type = 'password';
                toggleButton.textContent = '👁️';
            }
        }
        
        // التحقق من قوة كلمة المرور
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strength-bar');
            const hint = document.getElementById('password-hint');
            
            let strength = 0;
            
            // طول كلمة المرور
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 10;
            
            // يحتوي على أرقام
            if (/\d/.test(password)) strength += 25;
            
            // يحتوي على حروف كبيرة وصغيرة
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
            
            // يحتوي على رموز خاصة
            if (/[^A-Za-z0-9]/.test(password)) strength += 15;
            
            // تحديث شريط القوة
            strengthBar.className = 'strength-bar';
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
                hint.textContent = 'يجب أن تكون 8 أحرف على الأقل وتحتوي على حروف وأرقام';
            } else if (strength < 50) {
                strengthBar.classList.add('strength-weak');
                hint.textContent = 'كلمة مرور ضعيفة';
                hint.style.color = '#dc3545';
            } else if (strength < 75) {
                strengthBar.classList.add('strength-medium');
                hint.textContent = 'كلمة مرور متوسطة';
                hint.style.color = '#ffc107';
            } else {
                strengthBar.classList.add('strength-strong');
                hint.textContent = 'كلمة مرور قوية';
                hint.style.color = '#28a745';
            }
            
            // تحديث مطابقة كلمة المرور
            checkPasswordMatch();
        }
        
        // التحقق من مطابقة كلمة المرور
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const feedback = document.getElementById('confirm-feedback');
            
            if (confirmPassword.length === 0) {
                feedback.textContent = '';
                feedback.style.color = '';
            } else if (password !== confirmPassword) {
                feedback.textContent = 'كلمات المرور غير متطابقة';
                feedback.style.color = '#dc3545';
            } else {
                feedback.textContent = 'كلمات المرور متطابقة ✓';
                feedback.style.color = '#28a745';
            }
        }
        
        // التحقق من اسم المستخدم
        function checkUsername() {
            const username = document.getElementById('username').value;
            const feedback = document.getElementById('username-feedback');
            
            if (username.length === 0) {
                feedback.textContent = '';
                feedback.style.color = '';
            } else if (username.length < 3) {
                feedback.textContent = 'يجب أن يكون 3 أحرف على الأقل';
                feedback.style.color = '#dc3545';
            } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                feedback.textContent = 'يجب أن يحتوي على حروف وأرقام و _ فقط';
                feedback.style.color = '#dc3545';
            } else if (username.length > 20) {
                feedback.textContent = 'يجب ألا يزيد عن 20 حرفاً';
                feedback.style.color = '#dc3545';
            } else {
                feedback.textContent = 'اسم مستخدم صالح ✓';
                feedback.style.color = '#28a745';
            }
        }
        
        // التحقق من البريد الإلكتروني
        function checkEmail() {
            const email = document.getElementById('email').value;
            const feedback = document.getElementById('email-feedback');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email.length === 0) {
                feedback.textContent = '';
                feedback.style.color = '';
            } else if (!emailRegex.test(email)) {
                feedback.textContent = 'يرجى إدخال بريد إلكتروني صالح';
                feedback.style.color = '#dc3545';
            } else {
                feedback.textContent = 'بريد إلكتروني صالح ✓';
                feedback.style.color = '#28a745';
            }
        }
        
        // التحقق من النموذج قبل الإرسال
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const terms = document.getElementById('terms').checked;
            
            // إظهار التحميل
            document.getElementById('loading').style.display = 'block';
            document.getElementById('submitBtn').style.display = 'none';
            
            // التحقق من الشروط
            if (!terms) {
                e.preventDefault();
                alert('يجب الموافقة على الشروط والأحكام');
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'block';
                return false;
            }
            
            // التحقق من الحقول
            if (!username || !email || !password || !confirmPassword) {
                e.preventDefault();
                alert('يرجى ملء جميع الحقول');
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'block';
                return false;
            }
            
            // التحقق من مطابقة كلمة المرور
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('كلمات المرور غير متطابقة');
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'block';
                return false;
            }
            
            // التحقق من قوة كلمة المرور
            if (password.length < 8) {
                e.preventDefault();
                alert('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'block';
                return false;
            }
            
            // السماح بالإرسال
            return true;
        });
        
        // تفعيل التحقق عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            checkUsername();
            checkEmail();
            checkPasswordStrength();
            checkPasswordMatch();
        });
    </script>
</body>
</html>