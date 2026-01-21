<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الملف الشخصي - <?php echo SITE_NAME; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .profile-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        /* رأس الصفحة */
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        .profile-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            position: relative;
        }
        
        .profile-header p {
            font-size: 18px;
            opacity: 0.9;
            position: relative;
        }
        
        /* محتوى الصفحة */
        .profile-content {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }
        
        @media (max-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
        }
        
        /* الجانب الأيسر - معلومات المستخدم */
        .profile-sidebar {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .profile-avatar {
            position: relative;
            margin-bottom: 25px;
        }
        
        .avatar-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f0f0f0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .avatar-change {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(102, 126, 234, 0.9);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }
        
        .avatar-change:hover {
            background: #764ba2;
            transform: translateX(-50%) translateY(-2px);
        }
        
        .user-info {
            margin-bottom: 25px;
        }
        
        .user-name {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .user-email {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 15px;
        }
        
        .user-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            display: block;
        }
        
        .stat-label {
            color: #666;
            font-size: 12px;
        }
        
        .quick-links {
            list-style: none;
        }
        
        .quick-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: #2c3e50;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s;
        }
        
        .quick-link:hover {
            background: #f8f9fa;
            color: #667eea;
            transform: translateX(-5px);
        }
        
        .quick-link.active {
            background: #667eea;
            color: white;
        }
        
        /* الجانب الأيمن - نموذج التعديل */
        .profile-main {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        /* التبويبات */
        .profile-tabs {
            display: flex;
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .tab {
            padding: 15px 25px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            font-weight: 500;
            color: #666;
        }
        
        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        
        .tab:hover {
            color: #764ba2;
        }
        
        /* محتوى التبويبات */
        .tab-content {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* النماذج */
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
            font-size: 15px;
        }
        
        label.required::after {
            content: ' *';
            color: #dc3545;
        }
        
        .form-control {
            width: 100%;
            padding: 14px;
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
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        /* رفع الصورة */
        .image-upload {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8f9fa;
            margin-bottom: 15px;
        }
        
        .image-upload:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }
        
        .image-upload input {
            display: none;
        }
        
        .upload-icon {
            font-size: 48px;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .image-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #eee;
            margin-top: 15px;
        }
        
        /* قوة كلمة المرور */
        .password-strength {
            height: 6px;
            background: #eee;
            border-radius: 3px;
            margin-top: 8px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s;
        }
        
        .strength-weak { background: #dc3545; width: 25%; }
        .strength-medium { background: #ffc107; width: 50%; }
        .strength-strong { background: #28a745; width: 75%; }
        .strength-very-strong { background: #20c997; width: 100%; }
        
        .password-hint {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }
        
        /* الأزرار */
        .btn {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-outline:hover {
            background: #667eea;
            color: white;
        }
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        /* الرسائل */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            animation: slideIn 0.5s;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        /* التحقق من المدخلات */
        .validation-message {
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        
        .validation-success {
            color: #28a745;
            display: block;
        }
        
        .validation-error {
            color: #dc3545;
            display: block;
        }
        
        /* الرسوم المتحركة */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- رأس الصفحة -->
        <div class="profile-header">
            <h1>👤 تعديل الملف الشخصي</h1>
            <p>قم بتحديث معلوماتك الشخصية وإعدادات الحساب</p>
        </div>

        <!-- رسائل التنبيه -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ❌ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- محتوى الصفحة -->
        <div class="profile-content">
            <!-- الجانب الأيسر - معلومات المستخدم -->
            <div class="profile-sidebar">
                <div class="profile-avatar">
                    <img src="<?php echo BASE_URL; ?>uploads/<?php echo $user['profile_image'] ?? 'default.png'; ?>" 
                         alt="صورة الملف الشخصي" 
                         class="avatar-image"
                         id="currentAvatar">
                    <button type="button" class="avatar-change" onclick="document.getElementById('avatar_input').click()">
                        <span>🔄</span> تغيير الصورة
                    </button>
                </div>
                
                <div class="user-info">
                    <h3 class="user-name" id="displayUsername"><?php echo htmlspecialchars($user['username']); ?></h3>
                    <p class="user-email" id="displayEmail"><?php echo htmlspecialchars($user['email']); ?></p>
                    <span style="background: #f8f9fa; padding: 5px 15px; border-radius: 20px; font-size: 12px; color: #666;">
                        📅 عضو منذ: <?php echo date('Y/m/d', strtotime($user['created_at'])); ?>
                    </span>
                </div>
                
                <div class="user-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $userStats['books_read'] ?? '0'; ?></span>
                        <span class="stat-label">📖 الكتب</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $userStats['reviews'] ?? '0'; ?></span>
                        <span class="stat-label">⭐ التقييمات</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $userStats['days_active'] ?? '1'; ?></span>
                        <span class="stat-label">📅 الأيام</span>
                    </div>
                </div>
                
                <ul class="quick-links">
                    <li>
                        <a href="<?php echo BASE_URL; ?>?url=profile/view" class="quick-link">
                            👁️ معاينة الملف
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>?url=dashboard" class="quick-link">
                            🏠 لوحة التحكم
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>?url=books" class="quick-link">
                            📚 المكتبة
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>?url=auth/logout" class="quick-link" 
                           onclick="return confirm('هل أنت متأكد من تسجيل الخروج؟');">
                            🚪 تسجيل الخروج
                        </a>
                    </li>
                </ul>
            </div>

            <!-- الجانب الأيمن - نموذج التعديل -->
            <div class="profile-main">
                <!-- التبويبات -->
                <div class="profile-tabs">
                    <div class="tab active" onclick="showTab('personal')">👤 المعلومات الشخصية</div>
                    <div class="tab" onclick="showTab('security')">🔐 الأمان</div>
                    <div class="tab" onclick="showTab('preferences')">⚙️ التفضيلات</div>
                </div>

                <!-- تبويب المعلومات الشخصية -->
                <div id="personal" class="tab-content active">
                    <form action="<?php echo BASE_URL; ?>?url=profile/update" method="POST" enctype="multipart/form-data">
                        <input type="file" id="avatar_input" name="profile_image" accept="image/*" 
                               style="display: none;" onchange="previewAvatar(event)">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="username" class="required">اسم المستخدم</label>
                                <input type="text" 
                                       id="username" 
                                       name="username" 
                                       class="form-control" 
                                       value="<?php echo htmlspecialchars($user['username']); ?>"
                                       required
                                       oninput="validateUsername()">
                                <div id="usernameFeedback" class="validation-message"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="required">البريد الإلكتروني</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>"
                                       required
                                       oninput="validateEmail()">
                                <div id="emailFeedback" class="validation-message"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>صورة الملف الشخصي</label>
                            <div class="image-upload" onclick="document.getElementById('avatar_input').click()">
                                <div class="upload-icon">📷</div>
                                <p>انقر لرفع صورة جديدة</p>
                                <p style="font-size: 12px; color: #666; margin-top: 5px;">
                                    المسموح: JPG, PNG, GIF - الحد الأقصى: 2MB
                                </p>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-block" id="personalSubmit">
                            💾 حفظ التغييرات
                        </button>
                    </form>
                </div>

                <!-- تبويب الأمان -->
                <div id="security" class="tab-content">
                    <form action="<?php echo BASE_URL; ?>?url=profile/change-password" method="POST">
                        <div class="alert alert-info">
                            🔐 يوصى بتغيير كلمة المرور بشكل دوري لزيادة أمان حسابك
                        </div>
                        
                        <div class="form-group">
                            <label for="current_password" class="required">كلمة المرور الحالية</label>
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password" 
                                   class="form-control" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password" class="required">كلمة المرور الجديدة</label>
                            <input type="password" 
                                   id="new_password" 
                                   name="new_password" 
                                   class="form-control" 
                                   required
                                   oninput="checkPasswordStrength()">
                            <div class="password-strength">
                                <div id="strengthBar" class="strength-bar"></div>
                            </div>
                            <div id="passwordHint" class="password-hint"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password" class="required">تأكيد كلمة المرور</label>
                            <input type="password" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   class="form-control" 
                                   required
                                   oninput="checkPasswordMatch()">
                            <div id="confirmFeedback" class="validation-message"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-block" id="securitySubmit">
                            🔐 تغيير كلمة المرور
                        </button>
                    </form>
                </div>

                <!-- تبويب التفضيلات -->
                <div id="preferences" class="tab-content">
                    <form action="<?php echo BASE_URL; ?>?url=profile/update-preferences" method="POST">
                        <div class="form-group">
                            <label for="language">اللغة المفضلة</label>
                            <select id="language" name="language" class="form-control">
                                <option value="ar" <?php echo ($user['language'] ?? 'ar') == 'ar' ? 'selected' : ''; ?>>العربية</option>
                                <option value="en" <?php echo ($user['language'] ?? '') == 'en' ? 'selected' : ''; ?>>الإنجليزية</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="theme">الثيم</label>
                            <select id="theme" name="theme" class="form-control">
                                <option value="light" <?php echo ($user['theme'] ?? 'light') == 'light' ? 'selected' : ''; ?>>فاتح ☀️</option>
                                <option value="dark" <?php echo ($user['theme'] ?? '') == 'dark' ? 'selected' : ''; ?>>داكن 🌙</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: 10px;">
                                <input type="checkbox" 
                                       name="email_notifications" 
                                       value="1" 
                                       <?php echo ($user['email_notifications'] ?? 1) ? 'checked' : ''; ?>>
                                تلقي الإشعارات عبر البريد الإلكتروني
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: 10px;">
                                <input type="checkbox" 
                                       name="newsletter" 
                                       value="1" 
                                       <?php echo ($user['newsletter'] ?? 1) ? 'checked' : ''; ?>>
                                الاشتراك في النشرة البريدية
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-block">
                            💾 حفظ التفضيلات
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // متغيرات
        let currentTab = 'personal';
        
        // عرض التبويب
        function showTab(tabId) {
            // إخفاء جميع المحتويات
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // إزالة النشاط من جميع التبويبات
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // إظهار المحتوى المحدد
            document.getElementById(tabId).classList.add('active');
            
            // تفعيل التبويب المحدد
            event.target.classList.add('active');
            currentTab = tabId;
        }
        
        // معاينة الصورة الجديدة
        function previewAvatar(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('currentAvatar');
            
            if (file) {
                // التحقق من حجم الملف (2MB كحد أقصى)
                if (file.size > 2 * 1024 * 1024) {
                    alert('حجم الصورة كبير جداً. الحد الأقصى 2MB');
                    event.target.value = '';
                    return;
                }
                
                // التحقق من نوع الملف
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('نوع الملف غير مسموح. المسموح: JPG, PNG, GIF');
                    event.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
        
        // التحقق من اسم المستخدم
        function validateUsername() {
            const username = document.getElementById('username').value;
            const feedback = document.getElementById('usernameFeedback');
            
            if (username.length === 0) {
                feedback.textContent = '';
                feedback.className = 'validation-message';
                return false;
            }
            
            if (username.length < 3) {
                feedback.textContent = 'يجب أن يكون اسم المستخدم 3 أحرف على الأقل';
                feedback.className = 'validation-message validation-error';
                return false;
            }
            
            if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                feedback.textContent = 'يجب أن يحتوي على حروف وأرقام و _ فقط';
                feedback.className = 'validation-message validation-error';
                return false;
            }
            
            if (username.length > 20) {
                feedback.textContent = 'يجب ألا يزيد عن 20 حرفاً';
                feedback.className = 'validation-message validation-error';
                return false;
            }
            
            feedback.textContent = 'اسم مستخدم صالح ✓';
            feedback.className = 'validation-message validation-success';
            return true;
        }
        
        // التحقق من البريد الإلكتروني
        function validateEmail() {
            const email = document.getElementById('email').value;
            const feedback = document.getElementById('emailFeedback');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email.length === 0) {
                feedback.textContent = '';
                feedback.className = 'validation-message';
                return false;
            }
            
            if (!emailRegex.test(email)) {
                feedback.textContent = 'يرجى إدخال بريد إلكتروني صالح';
                feedback.className = 'validation-message validation-error';
                return false;
            }
            
            feedback.textContent = 'بريد إلكتروني صالح ✓';
            feedback.className = 'validation-message validation-success';
            return true;
        }
        
        // التحقق من قوة كلمة المرور
        function checkPasswordStrength() {
            const password = document.getElementById('new_password').value;
            const strengthBar = document.getElementById('strengthBar');
            const hint = document.getElementById('passwordHint');
            
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
                hint.textContent = 'أدخل كلمة المرور';
                hint.style.color = '#666';
            } else if (strength < 50) {
                strengthBar.classList.add('strength-weak');
                hint.textContent = 'ضعيفة';
                hint.style.color = '#dc3545';
            } else if (strength < 75) {
                strengthBar.classList.add('strength-medium');
                hint.textContent = 'متوسطة';
                hint.style.color = '#ffc107';
            } else if (strength < 90) {
                strengthBar.classList.add('strength-strong');
                hint.textContent = 'قوية';
                hint.style.color = '#28a745';
            } else {
                strengthBar.classList.add('strength-very-strong');
                hint.textContent = 'قوية جداً';
                hint.style.color = '#20c997';
            }
            
            // تحديث مطابقة كلمة المرور
            checkPasswordMatch();
        }
        
        // التحقق من مطابقة كلمة المرور
        function checkPasswordMatch() {
            const password = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const feedback = document.getElementById('confirmFeedback');
            
            if (confirmPassword.length === 0) {
                feedback.textContent = '';
                feedback.className = 'validation-message';
                return false;
            }
            
            if (password !== confirmPassword) {
                feedback.textContent = 'كلمات المرور غير متطابقة';
                feedback.className = 'validation-message validation-error';
                return false;
            }
            
            feedback.textContent = 'كلمات المرور متطابقة ✓';
            feedback.className = 'validation-message validation-success';
            return true;
        }
        
        // تحديث العرض عند تغيير المدخلات
        document.getElementById('username').addEventListener('input', function() {
            document.getElementById('displayUsername').textContent = this.value || 'مستخدم';
        });
        
        // التحقق قبل إرسال النموذج
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                if (this.action.includes('profile/update')) {
                    // تبويب المعلومات الشخصية
                    isValid = validateUsername() && validateEmail();
                } else if (this.action.includes('change-password')) {
                    // تبويب الأمان
                    const currentPassword = document.getElementById('current_password').value;
                    const newPassword = document.getElementById('new_password').value;
                    const confirmPassword = document.getElementById('confirm_password').value;
                    
                    if (!currentPassword || !newPassword || !confirmPassword) {
                        alert('يرجى ملء جميع حقول كلمة المرور');
                        isValid = false;
                    } else if (newPassword.length < 8) {
                        alert('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
                        isValid = false;
                    } else if (newPassword !== confirmPassword) {
                        alert('كلمات المرور غير متطابقة');
                        isValid = false;
                    }
                }
                
                if (!isValid) {
                    e.preventDefault();
                } else {
                    // إظهار رسالة التحميل
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '⏳ جاري الحفظ...';
                    submitBtn.disabled = true;
                    
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 2000);
                }
            });
        });
        
        // تهيئة الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            validateUsername();
            validateEmail();
            checkPasswordStrength();
            checkPasswordMatch();
            
            // تحديث الصورة عند التحميل
            const avatarInput = document.getElementById('avatar_input');
            if (avatarInput.files.length > 0) {
                previewAvatar({ target: avatarInput });
            }
        });
    </script>
</body>
</html>