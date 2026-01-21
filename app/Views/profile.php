<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي - <?php echo SITE_NAME; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* رأس الصفحة */
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
        }
        
        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        /* بطاقة الملف الشخصي */
        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f0f0f0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .profile-info {
            flex: 1;
        }
        
        .profile-name {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .profile-email {
            color: #7f8c8d;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .member-since {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            color: #666;
            font-size: 14px;
        }
        
        /* قسم التبويبات */
        .tabs {
            display: flex;
            border-bottom: 2px solid #eee;
            margin-bottom: 30px;
        }
        
        .tab {
            padding: 15px 30px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            font-weight: 500;
            color: #666;
        }
        
        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background-color: rgba(102, 126, 234, 0.05);
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
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .form-text {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
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
        
        /* الأزرار */
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s;
            text-align: center;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        /* القوائم */
        .stats-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .stat-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        
        /* جدول النشاط */
        .activity-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .activity-table th,
        .activity-table td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }
        
        .activity-table th {
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 500;
        }
        
        .activity-table tr:hover {
            background: #f8f9fa;
        }
        
        /* رسائل التنبيه */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
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
        
        /* الصور المصغرة */
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #eee;
            margin-top: 10px;
        }
        
        /* تعديلات للجوال */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .tabs {
                flex-direction: column;
            }
            
            .tab {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- رأس الصفحة -->
        <div class="header">
            <h1>👤 الملف الشخصي</h1>
            <p>إدارة معلومات حسابك الشخصية</p>
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

        <!-- بطاقة الملف الشخصي -->
        <div class="profile-card">
            <div class="profile-header">
                <img src="<?php echo BASE_URL; ?>uploads/<?php echo $user['profile_image'] ?? 'default.png'; ?>" 
                     alt="صورة الملف الشخصي" class="profile-image">
                <div class="profile-info">
                    <h2 class="profile-name"><?php echo htmlspecialchars($user['username'] ?? 'مستخدم'); ?></h2>
                    <p class="profile-email">📧 <?php echo htmlspecialchars($user['email'] ?? 'لا يوجد بريد'); ?></p>
                    <span class="member-since">
                        📅 عضو منذ: <?php echo date('Y/m/d', strtotime($user['created_at'] ?? date('Y-m-d'))); ?>
                    </span>
                </div>
            </div>

            <!-- التبويبات -->
            <div class="tabs">
                <div class="tab active" onclick="showTab('edit')">✏️ تعديل الملف</div>
                <div class="tab" onclick="showTab('security')">🔐 الأمان</div>
                <div class="tab" onclick="showTab('activity')">📊 النشاط</div>
                <div class="tab" onclick="showTab('books')">📚 كتبي</div>
            </div>

            <!-- محتوى تبويب تعديل الملف -->
            <div id="edit" class="tab-content active">
                <form action="<?php echo BASE_URL; ?>?url=profile/update" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">اسم المستخدم</label>
                            <input type="text" id="username" name="username" 
                                   value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" 
                                   class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" 
                                   class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profile_image">صورة الملف الشخصي</label>
                        <input type="file" id="profile_image" name="profile_image" 
                               accept="image/*" class="form-control">
                        <p class="form-text">يسمح بصور JPG, PNG, GIF بحد أقصى 2MB</p>
                        
                        <?php if (!empty($user['profile_image']) && $user['profile_image'] != 'default.png'): ?>
                            <img src="<?php echo BASE_URL; ?>uploads/<?php echo $user['profile_image']; ?>" 
                                 alt="الصورة الحالية" class="image-preview">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-block">💾 حفظ التعديلات</button>
                </form>
            </div>

            <!-- محتوى تبويب الأمان -->
            <div id="security" class="tab-content">
                <form action="<?php echo BASE_URL; ?>?url=profile/change-password" method="POST">
                    <div class="form-group">
                        <label for="current_password">كلمة المرور الحالية</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="form-control" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="new_password">كلمة المرور الجديدة</label>
                            <input type="password" id="new_password" name="new_password" 
                                   class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   class="form-control" required>
                        </div>
                    </div>
                    
                    <p class="form-text">يجب أن تكون كلمة المرور 8 أحرف على الأقل وتحتوي على أرقام وحروف</p>
                    
                    <button type="submit" class="btn btn-block">🔐 تغيير كلمة المرور</button>
                </form>
            </div>

            <!-- محتوى تبويب النشاط -->
            <div id="activity" class="tab-content">
                <div class="stats-list">
                    <div class="stat-item">
                        <div class="stat-value"><?php echo $userStats['books_read'] ?? '0'; ?></div>
                        <div class="stat-label">📖 الكتب المقروءة</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-value"><?php echo $userStats['reviews'] ?? '0'; ?></div>
                        <div class="stat-label">⭐ التقييمات</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-value"><?php echo $userStats['days_active'] ?? '1'; ?></div>
                        <div class="stat-label">📅 أيام النشاط</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-value">#<?php echo $userStats['rank'] ?? '1'; ?></div>
                        <div class="stat-label">🏆 المرتبة</div>
                    </div>
                </div>
                
                <h3 style="margin: 30px 0 15px 0;">آخر الأنشطة</h3>
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>النشاط</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentActivity)): ?>
                            <?php foreach ($recentActivity as $activity): ?>
                                <tr>
                                    <td><?php echo $activity['action']; ?></td>
                                    <td><?php echo $activity['date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" style="text-align: center; color: #666;">لا توجد أنشطة سابقة</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- محتوى تبويب كتبي -->
            <div id="books" class="tab-content">
                <div class="alert alert-info">
                    📚 هذا القسم يعرض الكتب التي قمت بإضافتها أو قراءتها
                </div>
                
                <?php if (!empty($userBooks)): ?>
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>الكتاب</th>
                                <th>المؤلف</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userBooks as $book): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                                    <td>
                                        <span style="padding: 3px 8px; border-radius: 12px; font-size: 12px;
                                              background: <?php echo $book['status_color']; ?>; color: white;">
                                            <?php echo $book['status']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $book['date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <p style="font-size: 18px; margin-bottom: 10px;">📖 لا توجد كتب حالياً</p>
                        <a href="<?php echo BASE_URL; ?>?url=books" class="btn">تصفح الكتب</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- روابط إضافية -->
        <div style="text-align: center; margin-top: 30px;">
            <a href="<?php echo BASE_URL; ?>?url=dashboard" class="btn btn-secondary">🏠 العودة للرئيسية</a>
            <a href="<?php echo BASE_URL; ?>?url=auth/logout" class="btn btn-danger">🚪 تسجيل الخروج</a>
        </div>
    </div>

    <script>
        // تبديل التبويبات
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
        }
        
        // معاينة الصورة قبل الرفع
        document.getElementById('profile_image').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // إزالة الصور السابقة
                    document.querySelectorAll('.image-preview').forEach(img => img.remove());
                    
                    // إنشاء صورة جديدة
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'image-preview';
                    img.style.marginTop = '10px';
                    
                    // إضافة الصورة بعد حقل الرفع
                    document.querySelector('input[name="profile_image"]').parentNode.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</body>
</html>