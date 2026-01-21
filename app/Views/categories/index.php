<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التصنيفات - <?php echo SITE_NAME; ?></title>
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
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* رأس الصفحة */
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            border-radius: 15px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
            position: relative;
        }
        
        .header p {
            font-size: 18px;
            opacity: 0.9;
            position: relative;
            margin-bottom: 20px;
        }
        
        /* أدوات التحكم */
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 14px 50px 14px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff6b6b;
            font-size: 20px;
        }
        
        /* شبكة التصنيفات */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .category-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            position: relative;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .category-header {
            height: 120px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .category-icon {
            font-size: 50px;
            color: white;
            z-index: 2;
        }
        
        .category-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        .category-info {
            padding: 25px;
        }
        
        .category-title {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .category-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .stat {
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #ff6b6b;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-size: 12px;
        }
        
        .category-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
            text-align: center;
        }
        
        /* الأزرار */
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            text-align: center;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }
        
        .btn-outline {
            background: white;
            color: #ff6b6b;
            border: 2px solid #ff6b6b;
        }
        
        .btn-outline:hover {
            background: #ff6b6b;
            color: white;
        }
        
        .btn-add {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        }
        
        .btn-add:hover {
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
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
        
        /* بطاقة فارغة */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        
        .empty-icon {
            font-size: 60px;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        
        /* إحصائيات عامة */
        .overview-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .overview-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        
        .overview-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        
        .overview-number {
            font-size: 36px;
            font-weight: bold;
            color: #ff6b6b;
            margin-bottom: 5px;
        }
        
        .overview-label {
            color: #666;
            font-size: 14px;
        }
        
        /* التبويبات */
        .tabs {
            display: flex;
            border-bottom: 2px solid #eee;
            margin-bottom: 30px;
            flex-wrap: wrap;
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
            color: #ff6b6b;
            border-bottom-color: #ff6b6b;
            background-color: rgba(255, 107, 107, 0.05);
        }
        
        .tab:hover {
            color: #ee5a52;
        }
        
        /* الرسوم المتحركة */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
        
        /* تعديلات للجوال */
        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
            }
            
            .search-box {
                min-width: 100%;
            }
            
            .categories-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
            
            .header h1 {
                font-size: 28px;
            }
            
            .tabs {
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .category-header {
                height: 100px;
            }
            
            .category-icon {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- رأس الصفحة -->
        <div class="header">
            <h1>📂 التصنيفات</h1>
            <p>استكشاف الكتب حسب التصنيفات المختلفة</p>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" style="max-width: 600px; margin: 20px auto;">
                    ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error" style="max-width: 600px; margin: 20px auto;">
                    ❌ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <a href="<?php echo BASE_URL; ?>?url=categories/create" class="btn btn-add" style="display: inline-block; width: auto;">
                ➕ إضافة تصنيف جديد
            </a>
        </div>

        <!-- إحصائيات عامة -->
        <div class="overview-stats">
            <div class="overview-card">
                <div class="overview-icon">📂</div>
                <div class="overview-number"><?php echo $totalCategories ?? '0'; ?></div>
                <div class="overview-label">إجمالي التصنيفات</div>
            </div>
            
            <div class="overview-card">
                <div class="overview-icon">📚</div>
                <div class="overview-number"><?php echo $totalBooks ?? '0'; ?></div>
                <div class="overview-label">الكتب المصنفة</div>
            </div>
            
            <div class="overview-card">
                <div class="overview-icon">⭐</div>
                <div class="overview-number"><?php echo $mostPopularCategory ?? 'أدب'; ?></div>
                <div class="overview-label">الأكثر شعبية</div>
            </div>
            
            <div class="overview-card">
                <div class="overview-icon">🔄</div>
                <div class="overview-number"><?php echo date('Y/m'); ?></div>
                <div class="overview-label">آخر تحديث</div>
            </div>
        </div>

        <!-- التبويبات -->
        <div class="tabs">
            <div class="tab active" onclick="showTab('all')">جميع التصنيفات</div>
            <div class="tab" onclick="showTab('popular')">الأكثر شعبية</div>
            <div class="tab" onclick="showTab('recent')">المضافة حديثاً</div>
            <div class="tab" onclick="showTab('books')">حسب عدد الكتب</div>
        </div>

        <!-- أدوات التحكم -->
        <div class="controls">
            <div class="search-box">
                <input type="text" 
                       id="searchInput" 
                       placeholder="🔍 ابحث عن تصنيف..." 
                       class="search-input">
                <span class="search-icon">🔍</span>
            </div>
        </div>

        <!-- قائمة التصنيفات -->
        <div class="categories-grid" id="categoriesContainer">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <div class="category-card" data-name="<?php echo htmlspecialchars(strtolower($category['name'])); ?>"
                                              data-description="<?php echo htmlspecialchars(strtolower($category['description'] ?? '')); ?>">
                        <div class="category-header">
                            <div class="category-icon">
                                <?php 
                                $icons = ['📚', '✍️', '🎨', '🔬', '📜', '💭', '🕌', '📖', '🎭', '🌍'];
                                echo $icons[($category['id'] ?? 0) % count($icons)]; 
                                ?>
                            </div>
                        </div>
                        
                        <div class="category-info">
                            <h3 class="category-title"><?php echo htmlspecialchars($category['name']); ?></h3>
                            
                            <div class="category-stats">
                                <div class="stat">
                                    <div class="stat-number"><?php echo $category['book_count'] ?? '0'; ?></div>
                                    <div class="stat-label">الكتب</div>
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-number"><?php echo $category['author_count'] ?? '0'; ?></div>
                                    <div class="stat-label">المؤلفين</div>
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-number"><?php echo $category['views'] ?? '0'; ?></div>
                                    <div class="stat-label">المشاهدات</div>
                                </div>
                            </div>
                            
                            <p class="category-description">
                                <?php 
                                $description = $category['description'] ?? 'لا يوجد وصف';
                                echo htmlspecialchars(mb_strlen($description) > 100 ? mb_substr($description, 0, 100) . '...' : $description);
                                ?>
                            </p>
                            
                            <a href="<?php echo BASE_URL; ?>?url=books?category=<?php echo urlencode($category['name']); ?>" 
                               class="btn">
                                📖 تصفح الكتب
                            </a>
                            
                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                                <div style="display: flex; gap: 10px; margin-top: 15px;">
                                    <a href="<?php echo BASE_URL; ?>?url=categories/edit/<?php echo $category['id']; ?>" 
                                       class="btn btn-outline" style="flex: 1;">
                                        ✏️ تعديل
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>?url=categories/delete/<?php echo $category['id']; ?>" 
                                       class="btn btn-outline" 
                                       style="flex: 1; background: #f8f9fa; color: #dc3545; border-color: #dc3545;"
                                       onclick="return confirm('⚠️ هل أنت متأكد من حذف هذا التصنيف؟');">
                                        🗑️ حذف
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">📂</div>
                    <h3 style="color: #666; margin-bottom: 15px;">لا توجد تصنيفات حالياً</h3>
                    <p style="color: #999; margin-bottom: 25px;">أضف أول تصنيف لبدء تنظيم مكتبتك</p>
                    <a href="<?php echo BASE_URL; ?>?url=categories/create" class="btn btn-add" style="display: inline-block; width: auto;">
                        ➕ إضافة تصنيف جديد
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // البحث الفوري
        document.getElementById('searchInput').addEventListener('input', function(e) {
            filterCategories();
        });
        
        // دالة التصفية
        function filterCategories() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            document.querySelectorAll('.category-card').forEach(card => {
                const name = card.dataset.name;
                const description = card.dataset.description;
                
                const matchesSearch = !searchTerm || 
                    name.includes(searchTerm) || 
                    description.includes(searchTerm);
                
                if (matchesSearch) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s';
                } else {
                    card.style.display = 'none';
                }
            });
            
            updateEmptyState();
        }
        
        // دالة عرض التبويبات
        function showTab(tabType) {
            // تحديث التبويبات النشطة
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');
            
            // هنا يمكنك إضافة منطق لترتيب التصنيفات حسب التبويب
            const categories = Array.from(document.querySelectorAll('.category-card'));
            
            categories.sort((a, b) => {
                switch(tabType) {
                    case 'popular':
                        const viewsA = parseInt(a.querySelector('.stat:nth-child(3) .stat-number').textContent);
                        const viewsB = parseInt(b.querySelector('.stat:nth-child(3) .stat-number').textContent);
                        return viewsB - viewsA;
                    case 'books':
                        const booksA = parseInt(a.querySelector('.stat:first-child .stat-number').textContent);
                        const booksB = parseInt(b.querySelector('.stat:first-child .stat-number').textContent);
                        return booksB - booksA;
                    case 'recent':
                        // يمكن إضافة منطق للتاريخ لاحقاً
                        return 0;
                    default:
                        return 0;
                }
            });
            
            // إعادة ترتيب التصنيفات
            const container = document.getElementById('categoriesContainer');
            categories.forEach(category => container.appendChild(category));
        }
        
        // تحديث حالة القائمة الفارغة
        function updateEmptyState() {
            const visibleCategories = document.querySelectorAll('.category-card[style="display: block"], .category-card:not([style])');
            const emptyState = document.querySelector('.empty-state');
            
            if (visibleCategories.length === 0 && !emptyState) {
                const container = document.getElementById('categoriesContainer');
                container.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">🔍</div>
                        <h3 style="color: #666; margin-bottom: 15px;">لا توجد نتائج للبحث</h3>
                        <p style="color: #999; margin-bottom: 25px;">حاول البحث بكلمات أخرى</p>
                        <button class="btn" onclick="resetSearch()">
                            🔄 إعادة تعيين البحث
                        </button>
                    </div>
                `;
            } else if (visibleCategories.length > 0 && emptyState && emptyState.parentNode === container) {
                emptyState.remove();
            }
        }
        
        // إعادة تعيين البحث
        function resetSearch() {
            document.getElementById('searchInput').value = '';
            filterCategories();
        }
        
        // تهيئة الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // تفعيل البحث عند الضغط على Enter
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    filterCategories();
                }
            });
            
            // تأثيرات عند التمرير
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.category-card').forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s, transform 0.5s';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>