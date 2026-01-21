<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - <?php echo SITE_NAME; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* الشريط العلوي */
        .navbar {
            background-color: #2c3e50;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .nav-links a:hover {
            background-color: #34495e;
        }
        
        .nav-links a.active {
            background-color: #3498db;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3498db;
        }
        
        /* الرسائل */
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            animation: fadeIn 0.5s;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* إحصائيات */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #3498db;
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            margin: 10px 0;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        /* قسم المحتوى */
        .content-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .section-title {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ecf0f1;
            font-size: 24px;
        }
        
        /* الجداول */
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: right;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }
        
        .btn:hover {
            background-color: #2980b9;
        }
        
        .btn-sm {
            padding: 5px 12px;
            font-size: 12px;
        }
        
        .btn-danger {
            background-color: #e74c3c;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        /* الفوتر */
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            color: #7f8c8d;
            border-top: 1px solid #ecf0f1;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* الصور */
        .book-cover {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        /* تجاوبية */
        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- شريط التنقل -->
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_URL; ?>?url=dashboard" class="logo">📚 <?php echo SITE_NAME; ?></a>
            
            <ul class="nav-links">
                <li><a href="<?php echo BASE_URL; ?>?url=dashboard" class="active">🏠 الرئيسية</a></li>
                <li><a href="<?php echo BASE_URL; ?>?url=books">📚 الكتب</a></li>
                <li><a href="<?php echo BASE_URL; ?>?url=authors">✍️ المؤلفون</a></li>
                <li><a href="<?php echo BASE_URL; ?>?url=profile">👤 الملف الشخصي</a></li>
            </ul>
            
            <div class="user-info">
                <img src="<?php echo BASE_URL; ?>uploads/<?php echo $_SESSION['user']['profile_image'] ?? 'default.png'; ?>" 
                     alt="صورة الملف الشخصي" class="profile-img">
                <div>
                    <strong><?php echo $_SESSION['user']['username'] ?? 'زائر'; ?></strong>
                    <br>
                    <a href="<?php echo BASE_URL; ?>?url=auth/logout" style="color: #ecf0f1; font-size: 12px;">تسجيل الخروج</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- الرسائل -->
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

        <!-- الإحصائيات -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-number"><?php echo $totalBooks ?? '0'; ?></div>
                <div class="stat-label">إجمالي الكتب</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">✍️</div>
                <div class="stat-number"><?php echo $totalAuthors ?? '0'; ?></div>
                <div class="stat-label">عدد المؤلفين</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number"><?php echo $totalUsers ?? '0'; ?></div>
                <div class="stat-label">المستخدمين</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-number"><?php echo $newBooksThisMonth ?? '0'; ?></div>
                <div class="stat-label">كتب جديدة هذا الشهر</div>
            </div>
        </div>

        <!-- أحدث الكتب -->
        <div class="content-section">
            <h2 class="section-title">📖 أحدث الكتب المضافة</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>الغلاف</th>
                            <th>العنوان</th>
                            <th>المؤلف</th>
                            <th>سنة النشر</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($latestBooks)): ?>
                            <?php foreach ($latestBooks as $book): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo BASE_URL; ?>uploads/books/<?php echo $book['cover_image'] ?? 'default.jpg'; ?>" 
                                             alt="غلاف الكتاب" class="book-cover">
                                    </td>
                                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                                    <td><?php echo htmlspecialchars($book['author_name']); ?></td>
                                    <td><?php echo $book['published_year']; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>?url=books/show/<?php echo $book['id']; ?>" class="btn btn-sm">عرض</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">لا توجد كتب حالياً</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- أحدث المؤلفين -->
        <div class="content-section">
            <h2 class="section-title">✍️ أحدث المؤلفين</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>عدد الكتب</th>
                            <th>أول كتاب</th>
                            <th>آخر كتاب</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($latestAuthors)): ?>
                            <?php foreach ($latestAuthors as $author): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($author['name']); ?></td>
                                    <td><?php echo $author['book_count']; ?></td>
                                    <td><?php echo $author['first_book_year'] ?? '---'; ?></td>
                                    <td><?php echo $author['last_book_year'] ?? '---'; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>?url=authors/show/<?php echo $author['id']; ?>" class="btn btn-sm">عرض</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">لا توجد مؤلفين حالياً</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- روابط سريعة -->
        <div class="content-section">
            <h2 class="section-title">⚡ روابط سريعة</h2>
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="<?php echo BASE_URL; ?>?url=books/add" class="btn">➕ إضافة كتاب جديد</a>
                <a href="<?php echo BASE_URL; ?>?url=authors/add" class="btn">➕ إضافة مؤلف جديد</a>
                <a href="<?php echo BASE_URL; ?>?url=profile/edit" class="btn">👤 تعديل الملف الشخصي</a>
                <a href="<?php echo BASE_URL; ?>?url=reports" class="btn">📊 التقارير والإحصائيات</a>
            </div>
        </div>
    </div>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="container">
            <p>© <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> - جميع الحقوق محفوظة</p>
            <p style="margin-top: 10px; font-size: 14px;">
                تم التطوير باستخدام PHP MVC | إصدار 1.0.0
            </p>
        </div>
    </footer>
</body>
</html>