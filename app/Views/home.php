<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية - <?php echo SITE_NAME; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* الهيدر */
        .header {
            text-align: center;
            padding: 60px 0 40px;
        }
        
        .logo {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .tagline {
            font-size: 20px;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        /* البطاقات */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }
        
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, background 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .card-icon {
            font-size: 50px;
            margin-bottom: 20px;
        }
        
        .card-title {
            font-size: 24px;
            margin-bottom: 15px;
            color: white;
        }
        
        .card-description {
            margin-bottom: 20px;
            opacity: 0.8;
            line-height: 1.6;
        }
        
        /* الأزرار */
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: white;
            color: #764ba2;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            margin: 10px;
        }
        
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-outline:hover {
            background: white;
            color: #764ba2;
        }
        
        /* قسم المميزات */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 60px 0;
        }
        
        .feature {
            text-align: center;
            padding: 20px;
        }
        
        .feature-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #ffd700;
        }
        
        .feature-title {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        /* الفوتر */
        .footer {
            text-align: center;
            padding: 40px 0;
            margin-top: 60px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }
        
        .footer-links a {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .footer-links a:hover {
            opacity: 1;
        }
        
        /* الرسائل */
        .message {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px 25px;
            border-radius: 10px;
            margin: 20px 0;
            backdrop-filter: blur(5px);
            animation: fadeIn 0.5s;
        }
        
        .message-success {
            border-right: 4px solid #4CAF50;
        }
        
        .message-error {
            border-right: 4px solid #f44336;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* تحسينات للجوال */
        @media (max-width: 768px) {
            .header {
                padding: 30px 0;
            }
            
            .logo {
                font-size: 36px;
            }
            
            .cards {
                grid-template-columns: 1fr;
            }
            
            .btn {
                display: block;
                width: 100%;
                margin: 10px 0;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- الهيدر -->
        <header class="header">
            <h1 class="logo">📚 <?php echo SITE_NAME; ?></h1>
            <p class="tagline">منصة رقمية متكاملة لإدارة وعرض الكتب العربية</p>
            
            <!-- الرسائل -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="message message-success">
                    ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="message message-error">
                    ❌ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <!-- الأزرار الرئيسية -->
            <div style="margin-top: 30px;">
                <a href="<?php echo BASE_URL; ?>?url=auth/register" class="btn">🚀 ابدأ الآن - سجل مجاناً</a>
                <a href="<?php echo BASE_URL; ?>?url=books" class="btn btn-outline">📖 تصفح الكتب</a>
            </div>
        </header>

        <!-- البطاقات -->
        <div class="cards">
            <div class="card">
                <div class="card-icon">📚</div>
                <h3 class="card-title">آلاف الكتب العربية</h3>
                <p class="card-description">
                    استكشف مكتبتنا الواسعة التي تضم آلاف الكتب العربية في مختلف المجالات
                    من الأدب والعلم إلى التاريخ والفلسفة.
                </p>
                <a href="<?php echo BASE_URL; ?>?url=books" class="btn btn-outline">استعرض الكتب</a>
            </div>
            
            <div class="card">
                <div class="card-icon">👥</div>
                <h3 class="card-title">مجتمع القراء</h3>
                <p class="card-description">
                    انضم إلى مجتمع من القراء والمهتمين بالكتب، شارك آراءك
                    وتناقش مع الآخرين حول أحدث الإصدارات.
                </p>
                <a href="<?php echo BASE_URL; ?>?url=auth/register" class="btn btn-outline">انضم إلينا</a>
            </div>
            
            <div class="card">
                <div class="card-icon">⚡</div>
                <h3 class="card-title">تسجيل سريع وسهل</h3>
                <p class="card-description">
                    سجل حسابك في أقل من دقيقة وابدأ رحلتك في عالم القراءة
                    مع واجهة بسيطة وسهلة الاستخدام.
                </p>
                <a href="<?php echo BASE_URL; ?>?url=auth/register" class="btn btn-outline">سجل الآن</a>
            </div>
        </div>

        <!-- المميزات -->
        <div class="features">
            <div class="feature">
                <div class="feature-icon">🔒</div>
                <h3 class="feature-title">آمن ومحمي</h3>
                <p>بياناتك محمية بأحدث تقنيات الأمان</p>
            </div>
            
            <div class="feature">
                <div class="feature-icon">🚀</div>
                <h3 class="feature-title">سريع وسلس</h3>
                <p>تصفح سريع وتجربة مستخدم ممتازة</p>
            </div>
            
            <div class="feature">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">متجاوب مع جميع الأجهزة</h3>
                <p>استمتع بالتجربة على الهاتف أو الكمبيوتر</p>
            </div>
            
            <div class="feature">
                <div class="feature-icon">🆓</div>
                <h3 class="feature-title">مجاني بالكامل</h3>
                <p>خدماتنا مجانية بدون أي رسوم خفية</p>
            </div>
        </div>

        <!-- دعوة للعمل -->
        <div style="text-align: center; margin: 60px 0;">
            <h2 style="font-size: 28px; margin-bottom: 20px;">🚀 مستعد لبدء رحلتك مع الكتب؟</h2>
            <p style="font-size: 18px; margin-bottom: 30px; opacity: 0.9;">
                سجل الآن وانضم إلى آلاف القراء في عالم المعرفة
            </p>
            <a href="<?php echo BASE_URL; ?>?url=auth/register" class="btn" style="font-size: 18px; padding: 15px 40px;">
                📝 سجل حساب جديد
            </a>
            <p style="margin-top: 20px; opacity: 0.8;">
                لديك حساب بالفعل؟ <a href="<?php echo BASE_URL; ?>?url=auth/login" style="color: #ffd700; text-decoration: none;">سجل الدخول هنا</a>
            </p>
        </div>
    </div>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="container">
            <p style="font-size: 20px; margin-bottom: 15px;">📚 <?php echo SITE_NAME; ?></p>
            <p style="opacity: 0.8; margin-bottom: 20px;">
                منصة عربية متكاملة لعشاق القراءة والمعرفة
            </p>
            
            <div class="footer-links">
                <a href="<?php echo BASE_URL; ?>?url=about">من نحن</a>
                <a href="<?php echo BASE_URL; ?>?url=contact">اتصل بنا</a>
                <a href="<?php echo BASE_URL; ?>?url=privacy">سياسة الخصوصية</a>
                <a href="<?php echo BASE_URL; ?>?url=terms">شروط الاستخدام</a>
            </div>
            
            <p style="margin-top: 20px; font-size: 14px; opacity: 0.7;">
                © <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - جميع الحقوق محفوظة
            </p>
        </div>
    </footer>
</body>
</html>