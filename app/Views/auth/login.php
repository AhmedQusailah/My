<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - <?php echo SITE_NAME; ?></title>
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
        
        .login-container {
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.5s ease;
        }
        
        .login-card {
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
            margin-bottom: 25px;
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
        
        .forgot-password {
            text-align: center;
            margin: 20px 0;
        }
        
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #95a5a6;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #ecf0f1;
        }
        
        .divider span {
            padding: 0 15px;
            font-size: 14px;
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #7f8c8d;
            font-size: 15px;
        }
        
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
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
        
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .checkbox-group input {
            margin-left: 10px;
        }
        
        .checkbox-group label {
            margin-bottom: 0;
            color: #666;
        }
        
        .social-login {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .social-btn:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }
        
        .social-btn.google { color: #DB4437; }
        .social-btn.facebook { color: #4267B2; }
        .social-btn.twitter { color: #1DA1F2; }
        
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
            .login-card {
                padding: 30px 20px;
            }
            
            .logo h1 {
                font-size: 24px;
            }
            
            .social-login {
                flex-direction: column;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- الشعار -->
            <div class="logo">
                <div class="logo-icon">📚</div>
                <h1><?php echo SITE_NAME; ?></h1>
                <p>منصة الكتب العربية الرقمية</p>
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
            
            <!-- نموذج تسجيل الدخول -->
            <form action="<?php echo BASE_URL; ?>?url=auth/doLogin" method="POST">
                <div class="form-group">
                    <label for="username">اسم المستخدم أو البريد الإلكتروني</label>
                    <div class="input-with-icon">
                        <span class="input-icon">👤</span>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               class="form-control" 
                               placeholder="أدخل اسم المستخدم أو البريد الإلكتروني"
                               value="<?php echo $_POST['username'] ?? ''; ?>"
                               required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="أدخل كلمة المرور"
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            👁️
                        </button>
                    </div>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">تذكرني على هذا الجهاز</label>
                </div>
                
                <button type="submit" class="btn">
                    🔑 تسجيل الدخول
                </button>
            </form>
            
            <!-- نسيت كلمة المرور -->
            <div class="forgot-password">
                <a href="<?php echo BASE_URL; ?>?url=auth/forgot-password">هل نسيت كلمة المرور؟</a>
            </div>
            
            <!-- تسجيل الدخول عبر وسائل التواصل -->
            <!-- <div class="divider">
                <span>أو</span>
            </div>
            
            <div class="social-login">
                <button type="button" class="social-btn google">
                    <span>G</span> Google
                </button>
                <button type="button" class="social-btn facebook">
                    <span>f</span> Facebook
                </button>
            </div> -->
            
            <!-- رابط التسجيل -->
            <div class="register-link">
                ليس لديك حساب؟ 
                <a href="<?php echo BASE_URL; ?>?url=auth/register">أنشئ حساب جديد</a>
            </div>
        </div>
    </div>

    <script>
        // إظهار/إخفاء كلمة المرور
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.textContent = '👁️‍🗨️';
            } else {
                passwordInput.type = 'password';
                toggleButton.textContent = '👁️';
            }
        }
        
        // التأكد من ملء النموذج
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!username || !password) {
                e.preventDefault();
                alert('يرجى ملء جميع الحقول');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('كلمة المرور يجب أن تكون 6 أحرف على الأقل');
                return false;
            }
        });
        
        // إضافة تأثير عند التركيز على الحقول
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>