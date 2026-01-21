<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الكتب - <?php echo SITE_NAME; ?></title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 20px;
        }
        
        .filters {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .filter-select {
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: #667eea;
        }
        
        /* شبكة الكتب */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            position: relative;
        }
        
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .book-cover {
            height: 250px;
            overflow: hidden;
            position: relative;
        }
        
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .book-card:hover .book-cover img {
            transform: scale(1.05);
        }
        
        .book-overlay {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background: rgba(102, 126, 234, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .book-card:hover .book-overlay {
            opacity: 1;
        }
        
        .quick-view {
            color: white;
            background: transparent;
            border: 2px solid white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .quick-view:hover {
            background: white;
            color: #667eea;
        }
        
        .book-info {
            padding: 20px;
        }
        
        .book-title {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 10px;
            line-height: 1.4;
            height: 50px;
            overflow: hidden;
        }
        
        .book-author {
            color: #667eea;
            font-size: 14px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .book-meta {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 12px;
            margin-bottom: 15px;
        }
        
        .book-description {
            color: #666;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 20px;
            height: 60px;
            overflow: hidden;
        }
        
        .book-actions {
            display: flex;
            justify-content: space-between;
        }
        
        /* الأزرار */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-sm {
            padding: 8px 15px;
            font-size: 12px;
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
        
        .btn-add {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
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
        
        /* التصنيفات */
        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 30px 0;
        }
        
        .category-tag {
            padding: 8px 15px;
            background: #f0f0f0;
            border-radius: 20px;
            font-size: 13px;
            color: #666;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .category-tag:hover,
        .category-tag.active {
            background: #667eea;
            color: white;
        }
        
        /* الترقيم */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 40px 0;
        }
        
        .page-link {
            padding: 10px 15px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .page-link:hover {
            background: #f8f9fa;
            border-color: #667eea;
        }
        
        .page-link.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        /* الإحصائيات */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
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
            
            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
            
            .header h1 {
                font-size: 28px;
            }
        }
        
        @media (max-width: 480px) {
            .books-grid {
                grid-template-columns: 1fr;
            }
            
            .book-cover {
                height: 200px;
            }
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
        
        /* التحميل */
        .loading {
            text-align: center;
            padding: 40px;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
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
    <div class="container">
        <!-- رأس الصفحة -->
        <div class="header">
            <h1>📚 مكتبة الكتب</h1>
            <p>استكشف آلاف الكتب العربية في مختلف المجالات</p>
            
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
            
            <a href="<?php echo BASE_URL; ?>?url=books/create" class="btn btn-add">
                ➕ إضافة كتاب جديد
            </a>
        </div>

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
                <div class="stat-icon">📈</div>
                <div class="stat-number"><?php echo $newThisMonth ?? '0'; ?></div>
                <div class="stat-label">جديد هذا الشهر</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-number"><?php echo $topRated ?? '4.8'; ?></div>
                <div class="stat-label">متوسط التقييم</div>
            </div>
        </div>

        <!-- أدوات التحكم -->
        <div class="controls">
            <div class="search-box">
                <input type="text" 
                       id="searchInput" 
                       placeholder="🔍 ابحث عن كتاب، مؤلف، أو تصنيف..." 
                       class="search-input">
                <span class="search-icon">🔍</span>
            </div>
            
            <div class="filters">
                <select class="filter-select" id="categoryFilter">
                    <option value="">جميع التصنيفات</option>
                    <option value="أدب">أدب</option>
                    <option value="علوم">علوم</option>
                    <option value="تاريخ">تاريخ</option>
                    <option value="فلسفة">فلسفة</option>
                    <option value="دين">دين</option>
                    <option value="روايات">روايات</option>
                </select>
                
                <select class="filter-select" id="yearFilter">
                    <option value="">جميع السنوات</option>
                    <?php for ($year = date('Y'); $year >= 1900; $year--): ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endfor; ?>
                </select>
                
                <select class="filter-select" id="sortFilter">
                    <option value="newest">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                    <option value="title">حسب العنوان</option>
                    <option value="author">حسب المؤلف</option>
                </select>
            </div>
        </div>

        <!-- التصنيفات -->
        <div class="categories">
            <span class="category-tag active" data-category="">الكل</span>
            <span class="category-tag" data-category="أدب">أدب</span>
            <span class="category-tag" data-category="علوم">علوم</span>
            <span class="category-tag" data-category="تاريخ">تاريخ</span>
            <span class="category-tag" data-category="فلسفة">فلسفة</span>
            <span class="category-tag" data-category="دين">دين</span>
            <span class="category-tag" data-category="روايات">روايات</span>
            <span class="category-tag" data-category="شعر">شعر</span>
        </div>

        <!-- قائمة الكتب -->
        <div class="books-grid" id="booksContainer">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-card" data-category="<?php echo htmlspecialchars($book['category'] ?? ''); ?>"
                                          data-year="<?php echo $book['published_year']; ?>"
                                          data-title="<?php echo htmlspecialchars(strtolower($book['title'])); ?>"
                                          data-author="<?php echo htmlspecialchars(strtolower($book['author_name'])); ?>">
                        <div class="book-cover">
                            <img src="<?php echo BASE_URL; ?>uploads/books/<?php echo $book['cover_image'] ?? 'default.jpg'; ?>" 
                                 alt="<?php echo htmlspecialchars($book['title']); ?>">
                            <div class="book-overlay">
                                <button class="quick-view" onclick="viewBook(<?php echo $book['id']; ?>)">
                                    👁️ معاينة سريعة
                                </button>
                            </div>
                        </div>
                        
                        <div class="book-info">
                            <h3 class="book-title" title="<?php echo htmlspecialchars($book['title']); ?>">
                                <?php echo htmlspecialchars($book['title']); ?>
                            </h3>
                            
                            <p class="book-author">
                                ✍️ <?php echo htmlspecialchars($book['author_name']); ?>
                            </p>
                            
                            <div class="book-meta">
                                <span>📅 <?php echo $book['published_year']; ?></span>
                                <span>📊 <?php echo $book['views'] ?? 0; ?> مشاهدة</span>
                                <span>⭐ <?php echo $book['rating'] ?? '--'; ?></span>
                            </div>
                            
                            <p class="book-description" title="<?php echo htmlspecialchars($book['description']); ?>">
                                <?php echo mb_substr($book['description'], 0, 100); ?>...
                            </p>
                            
                            <div class="book-actions">
                                <a href="<?php echo BASE_URL; ?>?url=books/show/<?php echo $book['id']; ?>" 
                                   class="btn btn-sm">
                                    📖 قراءة المزيد
                                </a>
                                
                                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                                    <a href="<?php echo BASE_URL; ?>?url=books/edit/<?php echo $book['id']; ?>" 
                                       class="btn btn-sm btn-outline">
                                        ✏️ تعديل
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">📚</div>
                    <h3 style="color: #666; margin-bottom: 15px;">لا توجد كتب متاحة حالياً</h3>
                    <p style="color: #999; margin-bottom: 25px;">كن أول من يضيف كتاباً إلى المكتبة</p>
                    <a href="<?php echo BASE_URL; ?>?url=books/create" class="btn btn-add">
                        ➕ إضافة كتاب جديد
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- الترقيم -->
        <div class="pagination" id="pagination">
            <a href="#" class="page-link prev">السابق</a>
            <a href="#" class="page-link active">1</a>
            <a href="#" class="page-link">2</a>
            <a href="#" class="page-link">3</a>
            <a href="#" class="page-link next">التالي</a>
        </div>
    </div>

    <script>
        // البحث الفوري
        document.getElementById('searchInput').addEventListener('input', function(e) {
            filterBooks();
        });
        
        // التصفية حسب التصنيف
        document.querySelectorAll('.category-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                document.querySelectorAll('.category-tag').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                filterBooks();
            });
        });
        
        // التصفية حسب السنة
        document.getElementById('yearFilter').addEventListener('change', filterBooks);
        
        // الفرز
        document.getElementById('sortFilter').addEventListener('change', function() {
            sortBooks(this.value);
        });
        
        // دالة التصفية
        function filterBooks() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const activeCategory = document.querySelector('.category-tag.active').dataset.category;
            const selectedYear = document.getElementById('yearFilter').value;
            
            document.querySelectorAll('.book-card').forEach(card => {
                const title = card.dataset.title;
                const author = card.dataset.author;
                const category = card.dataset.category;
                const year = card.dataset.year;
                
                const matchesSearch = !searchTerm || 
                    title.includes(searchTerm) || 
                    author.includes(searchTerm);
                
                const matchesCategory = !activeCategory || category === activeCategory;
                const matchesYear = !selectedYear || year === selectedYear;
                
                if (matchesSearch && matchesCategory && matchesYear) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s';
                } else {
                    card.style.display = 'none';
                }
            });
            
            updateEmptyState();
        }
        
        // دالة الفرز
        function sortBooks(sortBy) {
            const container = document.getElementById('booksContainer');
            const books = Array.from(container.querySelectorAll('.book-card'));
            
            books.sort((a, b) => {
                switch(sortBy) {
                    case 'newest':
                        return parseInt(b.dataset.year) - parseInt(a.dataset.year);
                    case 'oldest':
                        return parseInt(a.dataset.year) - parseInt(b.dataset.year);
                    case 'title':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    case 'author':
                        return a.dataset.author.localeCompare(b.dataset.author);
                    default:
                        return 0;
                }
            });
            
            // إعادة ترتيب الكتب في الـDOM
            books.forEach(book => container.appendChild(book));
        }
        
        // تحديث حالة القائمة الفارغة
        function updateEmptyState() {
            const visibleBooks = document.querySelectorAll('.book-card[style="display: block"], .book-card:not([style])');
            const emptyState = document.querySelector('.empty-state');
            
            if (visibleBooks.length === 0 && !emptyState) {
                const booksContainer = document.getElementById('booksContainer');
                booksContainer.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">🔍</div>
                        <h3 style="color: #666; margin-bottom: 15px;">لا توجد نتائج للبحث</h3>
                        <p style="color: #999; margin-bottom: 25px;">حاول البحث بكلمات أخرى أو إزالة الفلاتر</p>
                        <button class="btn" onclick="resetFilters()">
                            🔄 إعادة تعيين الفلاتر
                        </button>
                    </div>
                `;
            } else if (visibleBooks.length > 0 && emptyState) {
                emptyState.remove();
            }
        }
        
        // إعادة تعيين الفلاتر
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.querySelectorAll('.category-tag').forEach(t => t.classList.remove('active'));
            document.querySelector('.category-tag[data-category=""]').classList.add('active');
            document.getElementById('yearFilter').value = '';
            document.getElementById('sortFilter').value = 'newest';
            
            document.querySelectorAll('.book-card').forEach(card => {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s';
            });
            
            document.querySelector('.empty-state')?.remove();
        }
        
        // عرض الكتاب (يمكن توسيعها لاحقاً)
        function viewBook(bookId) {
            window.location.href = `<?php echo BASE_URL; ?>?url=books/show/${bookId}`;
        }
        
        // تحميل المزيد من الكتب (توجيه)
        function loadMoreBooks() {
            alert('سيتم تطوير هذه الخاصية قريباً');
        }
        
        // تهيئة الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // تفعيل البحث عند الضغط على Enter
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    filterBooks();
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
            
            document.querySelectorAll('.book-card').forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s, transform 0.5s';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>