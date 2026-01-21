<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الكتاب - <?php echo SITE_NAME; ?></title>
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
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* رأس الصفحة */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
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
            font-size: 32px;
            margin-bottom: 10px;
            position: relative;
        }
        
        .header p {
            font-size: 18px;
            opacity: 0.9;
            position: relative;
        }
        
        /* بطاقة النموذج */
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        /* قسم المعلومات */
        .book-info {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            flex-wrap: wrap;
        }
        
        .book-cover {
            flex: 0 0 200px;
        }
        
        .cover-image {
            width: 200px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #e0e0e0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .book-details {
            flex: 1;
            min-width: 300px;
        }
        
        .book-title {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .book-author {
            font-size: 20px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .book-meta {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        
        .meta-item {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            color: #666;
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
            border-color: #4CAF50;
            background: white;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
            line-height: 1.6;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        /* تحميل الصور */
        .image-upload {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8f9fa;
            margin-bottom: 15px;
        }
        
        .image-upload:hover {
            border-color: #4CAF50;
            background: rgba(76, 175, 80, 0.05);
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
            max-width: 200px;
            max-height: 300px;
            border-radius: 10px;
            border: 2px solid #eee;
            margin-top: 15px;
        }
        
        .preview-container {
            text-align: center;
            margin-top: 20px;
        }
        
        /* الأزرار */
        .btn {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s;
            margin: 5px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(76, 175, 80, 0.3);
        }
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .btn-outline {
            background: white;
            color: #4CAF50;
            border: 2px solid #4CAF50;
        }
        
        .btn-outline:hover {
            background: #4CAF50;
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        /* أزرار الإجراءات */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 2px solid #f0f0f0;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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
        
        /* نصائح */
        .form-tip {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
            border-right: 4px solid #4dabf7;
        }
        
        .form-tip h4 {
            color: #1864ab;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .form-tip p {
            color: #495057;
            font-size: 13px;
            line-height: 1.5;
        }
        
        /* التحديد */
        .select2-container {
            width: 100% !important;
        }
        
        .select2-selection {
            padding: 12px;
            border: 2px solid #e0e0e0 !important;
            border-radius: 10px !important;
            min-height: 48px;
        }
        
        /* الإحصائيات */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin: 30px 0;
        }
        
        .stat-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-size: 12px;
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
        
        /* تعديلات للجوال */
        @media (max-width: 768px) {
            .book-info {
                flex-direction: column;
                text-align: center;
            }
            
            .book-cover {
                flex: 0 0 auto;
                margin: 0 auto;
            }
            
            .form-card {
                padding: 25px 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .action-buttons {
                justify-content: center;
            }
        }
    </style>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <!-- رأس الصفحة -->
        <div class="header">
            <h1>✏️ تعديل الكتاب</h1>
            <p>قم بتحديث معلومات الكتاب وإضافة التفاصيل الجديدة</p>
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

        <!-- بطاقة النموذج -->
        <form action="<?php echo BASE_URL; ?>?url=books/update/<?php echo $book['id']; ?>" method="POST" enctype="multipart/form-data" id="editBookForm">
            <div class="form-card">
                <!-- معلومات الكتاب الحالية -->
                <div class="book-info">
                    <div class="book-cover">
                        <img src="<?php echo BASE_URL; ?>uploads/books/<?php echo $book['cover_image'] ?? 'default.jpg'; ?>" 
                             alt="غلاف الكتاب" class="cover-image" id="currentCover">
                    </div>
                    
                    <div class="book-details">
                        <h2 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h2>
                        <p class="book-author">✍️ <?php echo htmlspecialchars($book['author_name'] ?? 'غير معروف'); ?></p>
                        
                        <div class="book-meta">
                            <span class="meta-item">📅 <?php echo $book['published_year']; ?></span>
                            <span class="meta-item">🔤 <?php echo $book['language'] ?? 'العربية'; ?></span>
                            <span class="meta-item">📊 <?php echo $book['views'] ?? 0; ?> مشاهدة</span>
                        </div>
                        
                        <div class="stats">
                            <div class="stat-item">
                                <div class="stat-value"><?php echo $book['pages'] ?? '--'; ?></div>
                                <div class="stat-label">عدد الصفحات</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value"><?php echo $book['isbn'] ?? '--'; ?></div>
                                <div class="stat-label">رقم ISBN</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value"><?php echo date('Y/m/d', strtotime($book['created_at'])); ?></div>
                                <div class="stat-label">تاريخ الإضافة</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- النموذج -->
                <h2 style="margin-bottom: 25px; color: #2c3e50; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
                    ⚙️ تعديل معلومات الكتاب
                </h2>
                
                <div class="form-group">
                    <label for="title" class="required">عنوان الكتاب</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           class="form-control" 
                           placeholder="أدخل عنوان الكتاب"
                           value="<?php echo htmlspecialchars($book['title']); ?>"
                           required
                           maxlength="200">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="author_id" class="required">المؤلف</label>
                        <select id="author_id" name="author_id" class="form-control" required>
                            <option value="">اختر المؤلف</option>
                            <?php if (!empty($authors)): ?>
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?php echo $author['id']; ?>" 
                                        <?php echo ($author['id'] == $book['author_id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($author['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="published_year" class="required">سنة النشر</label>
                        <input type="number" 
                               id="published_year" 
                               name="published_year" 
                               class="form-control" 
                               min="1000" 
                               max="<?php echo date('Y'); ?>"
                               value="<?php echo $book['published_year']; ?>"
                               required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="isbn">الرقم الدولي (ISBN)</label>
                        <input type="text" 
                               id="isbn" 
                               name="isbn" 
                               class="form-control" 
                               placeholder="مثال: 978-3-16-148410-0"
                               value="<?php echo htmlspecialchars($book['isbn'] ?? ''); ?>"
                               pattern="^(97(8|9))?\d{9}(\d|X)$">
                    </div>
                    
                    <div class="form-group">
                        <label for="pages">عدد الصفحات</label>
                        <input type="number" 
                               id="pages" 
                               name="pages" 
                               class="form-control" 
                               min="1" 
                               value="<?php echo $book['pages'] ?? ''; ?>"
                               placeholder="عدد الصفحات">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="language">اللغة</label>
                        <select id="language" name="language" class="form-control">
                            <option value="arabic" <?php echo ($book['language'] ?? 'arabic') == 'arabic' ? 'selected' : ''; ?>>العربية</option>
                            <option value="english" <?php echo ($book['language'] ?? '') == 'english' ? 'selected' : ''; ?>>الإنجليزية</option>
                            <option value="french" <?php echo ($book['language'] ?? '') == 'french' ? 'selected' : ''; ?>>الفرنسية</option>
                            <option value="other" <?php echo ($book['language'] ?? '') == 'other' ? 'selected' : ''; ?>>أخرى</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">التصنيف</label>
                        <input type="text" 
                               id="category" 
                               name="category" 
                               class="form-control" 
                               value="<?php echo htmlspecialchars($book['category'] ?? ''); ?>"
                               placeholder="مثال: أدب، علوم، تاريخ..."
                               list="categories">
                        <datalist id="categories">
                            <option value="أدب">
                            <option value="علوم">
                            <option value="تاريخ">
                            <option value="فلسفة">
                            <option value="دين">
                            <option value="سيرة ذاتية">
                            <option value="روايات">
                            <option value="شعر">
                        </datalist>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description" class="required">وصف الكتاب</label>
                    <textarea id="description" 
                              name="description" 
                              class="form-control" 
                              placeholder="اكتب وصفاً مختصراً للكتاب..."
                              required
                              rows="8"><?php echo htmlspecialchars($book['description']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="cover_image">صورة الغلاف الجديدة</label>
                    <div class="form-tip">
                        <h4>📷 تحديث الصورة</h4>
                        <p>يمكنك ترك هذا الحقل فارغاً إذا كنت لا تريد تغيير الصورة الحالية</p>
                    </div>
                    
                    <div class="image-upload" onclick="document.getElementById('cover_image').click()">
                        <div class="upload-icon">🔄</div>
                        <p>انقر لتحديث صورة الغلاف</p>
                        <p style="font-size: 12px; color: #666; margin-top: 5px;">
                            المسموح: JPG, PNG, GIF - الحد الأقصى: 2MB
                        </p>
                        <input type="file" 
                               id="cover_image" 
                               name="cover_image" 
                               accept="image/*" 
                               onchange="previewImage(event)">
                    </div>
                    
                    <div class="preview-container">
                        <img id="imagePreview" class="image-preview" alt="معاينة الصورة الجديدة">
                    </div>
                </div>
                
                <!-- أزرار الإجراءات -->
                <div class="form-actions">
                    <div>
                        <a href="<?php echo BASE_URL; ?>?url=books/show/<?php echo $book['id']; ?>" class="btn btn-outline">
                            👁️ معاينة
                        </a>
                        <a href="<?php echo BASE_URL; ?>?url=books" class="btn btn-secondary">
                            📋 القائمة
                        </a>
                    </div>
                    
                    <div class="action-buttons">
                        <button type="submit" class="btn" id="submitBtn">
                            💾 حفظ التعديلات
                        </button>
                        
                        <a href="<?php echo BASE_URL; ?>?url=books/delete/<?php echo $book['id']; ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('⚠️ هل أنت متأكد من حذف هذا الكتاب؟ لا يمكن التراجع عن هذا الإجراء.');">
                            🗑️ حذف الكتاب
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // تهيئة Select2
        $(document).ready(function() {
            $('#author_id').select2({
                placeholder: 'اختر المؤلف',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "لا توجد نتائج";
                    }
                }
            });
        });
        
        // معاينة الصورة
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            
            if (file) {
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert('حجم الصورة كبير جداً. الحد الأقصى 2MB');
                    event.target.value = '';
                    preview.style.display = 'none';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    
                    // تحديث الصورة الحالية أيضاً للمعاينة
                    document.getElementById('currentCover').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
        
        // التحقق قبل الإرسال
        document.getElementById('editBookForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const author = document.getElementById('author_id').value;
            const year = document.getElementById('published_year').value;
            const description = document.getElementById('description').value.trim();
            
            // التحقق من الحقول الإجبارية
            if (!title) {
                e.preventDefault();
                alert('يرجى إدخال عنوان الكتاب');
                document.getElementById('title').focus();
                return false;
            }
            
            if (!author) {
                e.preventDefault();
                alert('يرجى اختيار المؤلف');
                return false;
            }
            
            if (!year || year < 1000 || year > new Date().getFullYear()) {
                e.preventDefault();
                alert('يرجى إدخال سنة نشر صحيحة');
                document.getElementById('published_year').focus();
                return false;
            }
            
            if (!description) {
                e.preventDefault();
                alert('يرجى إدخال وصف الكتاب');
                document.getElementById('description').focus();
                return false;
            }
            
            // التحقق من ISBN إذا تم إدخاله
            const isbn = document.getElementById('isbn').value;
            if (isbn && !/^(97(8|9))?\d{9}(\d|X)$/.test(isbn.replace(/-/g, ''))) {
                e.preventDefault();
                alert('يرجى إدخال رقم ISBN صحيح');
                document.getElementById('isbn').focus();
                return false;
            }
            
            // إظهار رسالة التحميل
            document.getElementById('submitBtn').innerHTML = '⏳ جاري الحفظ...';
            document.getElementById('submitBtn').disabled = true;
            
            return true;
        });
        
        // التحقق من ISBN أثناء الكتابة
        document.getElementById('isbn').addEventListener('input', function(e) {
            const value = e.target.value.replace(/-/g, '');
            const isValid = /^(97(8|9))?\d{9}(\d|X)$/.test(value);
            
            if (value && !isValid) {
                e.target.style.borderColor = '#dc3545';
                e.target.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
            } else {
                e.target.style.borderColor = value ? '#28a745' : '#e0e0e0';
                e.target.style.boxShadow = value ? '0 0 0 3px rgba(40, 167, 69, 0.1)' : 'none';
            }
        });
        
        // عد الأحرف للوصف
        document.getElementById('description').addEventListener('input', function(e) {
            const charCount = e.target.value.length;
            const counter = document.getElementById('charCounter') || (function() {
                const counter = document.createElement('div');
                counter.id = 'charCounter';
                counter.style.fontSize = '12px';
                counter.style.color = '#666';
                counter.style.marginTop = '5px';
                e.target.parentNode.appendChild(counter);
                return counter;
            })();
            
            counter.textContent = `${charCount} حرف`;
            counter.style.color = charCount < 50 ? '#dc3545' : charCount < 100 ? '#ffc107' : '#28a745';
        });
        
        // تفعيل عداد الأحرف عند التحميل
        document.addEventListener('DOMContentLoaded', function() {
            const description = document.getElementById('description');
            if (description.value) {
                description.dispatchEvent(new Event('input'));
            }
        });
    </script>
</body>
</html>