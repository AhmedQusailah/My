<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة كتاب جديد - <?php echo SITE_NAME; ?></title>
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
        
        /* خطوات النموذج */
        .form-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }
        
        .form-steps::before {
            content: '';
            position: absolute;
            top: 25px;
            right: 0;
            left: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: #e0e0e0;
            color: #666;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 20px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .step.active .step-number {
            background: #667eea;
            color: white;
            box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.2);
        }
        
        .step.completed .step-number {
            background: #28a745;
            color: white;
        }
        
        .step-label {
            font-size: 14px;
            color: #666;
        }
        
        .step.active .step-label {
            color: #667eea;
            font-weight: 500;
        }
        
        /* أقسام النموذج */
        .form-section {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .form-section.active {
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
        
        textarea.form-control {
            min-height: 120px;
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
            max-width: 200px;
            max-height: 300px;
            border-radius: 10px;
            border: 2px solid #eee;
            margin-top: 15px;
            display: none;
        }
        
        .preview-container {
            text-align: center;
            margin-top: 20px;
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
            margin: 5px;
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
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        /* أزرار التنقل */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 2px solid #f0f0f0;
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
        
        /* شريط التقدم */
        .progress-bar {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            width: 0%;
            transition: width 0.5s;
        }
        
        /* تعديلات للجوال */
        @media (max-width: 768px) {
            .form-steps {
                flex-direction: column;
                gap: 20px;
            }
            
            .form-steps::before {
                display: none;
            }
            
            .step {
                display: flex;
                align-items: center;
                gap: 15px;
            }
            
            .step-number {
                margin: 0;
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .form-card {
                padding: 25px 20px;
            }
            
            .form-navigation {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-navigation .btn {
                width: 100%;
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
            <h1>📖 إضافة كتاب جديد</h1>
            <p>شارك معرفتك وأضف كتاباً جديداً إلى مكتبتنا</p>
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

        <!-- شريط التقدم -->
        <div class="progress-bar">
            <div class="progress-fill" id="progressFill"></div>
        </div>

        <!-- خطوات النموذج -->
        <div class="form-steps">
            <div class="step active" id="step1">
                <div class="step-number">1</div>
                <div class="step-label">معلومات الكتاب</div>
            </div>
            <div class="step" id="step2">
                <div class="step-number">2</div>
                <div class="step-label">التفاصيل</div>
            </div>
            <div class="step" id="step3">
                <div class="step-number">3</div>
                <div class="step-label">المرفقات</div>
            </div>
            <div class="step" id="step4">
                <div class="step-number">4</div>
                <div class="step-label">المراجعة</div>
            </div>
        </div>

        <!-- النموذج -->
        <form action="<?php echo BASE_URL; ?>?url=books/store" method="POST" enctype="multipart/form-data" id="bookForm">
            <div class="form-card">
                <!-- القسم 1: معلومات الكتاب -->
                <div class="form-section active" id="section1">
                    <h2 style="margin-bottom: 25px; color: #2c3e50;">معلومات الكتاب الأساسية</h2>
                    
                    <div class="form-group">
                        <label for="title" class="required">عنوان الكتاب</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               class="form-control" 
                               placeholder="أدخل عنوان الكتاب"
                               required
                               maxlength="200">
                        <div class="form-tip">
                            <h4>💡 نصيحة</h4>
                            <p>اكتب العنوان كما هو مكتوب على الغلاف، مع الحرص على كتابته باللغة العربية الفصحى</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="author_id" class="required">المؤلف</label>
                        <select id="author_id" name="author_id" class="form-control" required>
                            <option value="">اختر المؤلف</option>
                            <?php if (!empty($authors)): ?>
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?php echo $author['id']; ?>">
                                        <?php echo htmlspecialchars($author['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <div class="form-tip">
                            <h4>👤 مؤلف جديد؟</h4>
                            <p>إذا لم تجد المؤلف في القائمة، يمكنك <a href="<?php echo BASE_URL; ?>?url=authors/create" style="color: #667eea;">إضافة مؤلف جديد</a></p>
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
                                   pattern="^(97(8|9))?\d{9}(\d|X)$">
                        </div>
                        
                        <div class="form-group">
                            <label for="published_year" class="required">سنة النشر</label>
                            <input type="number" 
                                   id="published_year" 
                                   name="published_year" 
                                   class="form-control" 
                                   min="1000" 
                                   max="<?php echo date('Y'); ?>"
                                   value="<?php echo date('Y'); ?>"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- القسم 2: التفاصيل -->
                <div class="form-section" id="section2">
                    <h2 style="margin-bottom: 25px; color: #2c3e50;">تفاصيل الكتاب</h2>
                    
                    <div class="form-group">
                        <label for="description" class="required">وصف الكتاب</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-control" 
                                  placeholder="اكتب وصفاً مختصراً للكتاب..."
                                  required
                                  rows="6"></textarea>
                        <div class="form-tip">
                            <h4>📝 نصائح للوصف</h4>
                            <p>• اكتب ملخصاً موجزاً للكتاب<br>
                               • اذكر الفئات المستهدفة<br>
                               • أبرز النقاط الرئيسية<br>
                               • تجنب الإفساد (Spoilers)</p>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="language">اللغة</label>
                            <select id="language" name="language" class="form-control">
                                <option value="arabic">العربية</option>
                                <option value="english">الإنجليزية</option>
                                <option value="french">الفرنسية</option>
                                <option value="other">أخرى</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="pages">عدد الصفحات</label>
                            <input type="number" 
                                   id="pages" 
                                   name="pages" 
                                   class="form-control" 
                                   min="1" 
                                   placeholder="عدد الصفحات">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">التصنيف</label>
                        <input type="text" 
                               id="category" 
                               name="category" 
                               class="form-control" 
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

                <!-- القسم 3: المرفقات -->
                <div class="form-section" id="section3">
                    <h2 style="margin-bottom: 25px; color: #2c3e50">مرفقات الكتاب</h2>
                    
                    <div class="form-group">
                        <label for="cover_image">صورة الغلاف</label>
                        <div class="image-upload" onclick="document.getElementById('cover_image').click()">
                            <div class="upload-icon">📷</div>
                            <p>انقر لرفع صورة الغلاف</p>
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
                            <img id="imagePreview" class="image-preview" alt="معاينة الصورة">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="file">ملف الكتاب (PDF)</label>
                        <div class="image-upload" onclick="document.getElementById('file').click()" style="padding: 30px 20px;">
                            <div class="upload-icon">📄</div>
                            <p>انقر لرفع ملف الكتاب (اختياري)</p>
                            <p style="font-size: 12px; color: #666; margin-top: 5px;">
                                المسموح: PDF - الحد الأقصى: 10MB
                            </p>
                            <input type="file" 
                                   id="file" 
                                   name="file" 
                                   accept=".pdf" 
                                   onchange="previewFileName(event)">
                        </div>
                        <div id="fileName" style="margin-top: 10px; color: #666; font-size: 14px;"></div>
                    </div>
                </div>

                <!-- القسم 4: المراجعة -->
                <div class="form-section" id="section4">
                    <h2 style="margin-bottom: 25px; color: #2c3e50">مراجعة المعلومات</h2>
                    
                    <div class="form-tip" style="margin-bottom: 30px;">
                        <h4>✅ تأكد من المعلومات</h4>
                        <p>يرجى مراجعة جميع المعلومات المدخلة قبل حفظ الكتاب</p>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 25px; border-radius: 10px;">
                        <h3 style="color: #2c3e50; margin-bottom: 20px; border-bottom: 2px solid #dee2e6; padding-bottom: 10px;">
                            ملخص المعلومات
                        </h3>
                        
                        <div class="form-row">
                            <div>
                                <h4 style="color: #666; margin-bottom: 10px;">📖 معلومات الكتاب</h4>
                                <p><strong>العنوان:</strong> <span id="reviewTitle"></span></p>
                                <p><strong>المؤلف:</strong> <span id="reviewAuthor"></span></p>
                                <p><strong>سنة النشر:</strong> <span id="reviewYear"></span></p>
                            </div>
                            
                            <div>
                                <h4 style="color: #666; margin-bottom: 10px;">📝 التفاصيل</h4>
                                <p><strong>التصنيف:</strong> <span id="reviewCategory"></span></p>
                                <p><strong>اللغة:</strong> <span id="reviewLanguage"></span></p>
                                <p><strong>الصفحات:</strong> <span id="reviewPages"></span></p>
                            </div>
                        </div>
                        
                        <div style="margin-top: 20px;">
                            <h4 style="color: #666; margin-bottom: 10px;">📄 المرفقات</h4>
                            <p><strong>صورة الغلاف:</strong> <span id="reviewImage">لم يتم رفع صورة</span></p>
                            <p><strong>ملف PDF:</strong> <span id="reviewFile">لم يتم رفع ملف</span></p>
                        </div>
                    </div>
                </div>

                <!-- أزرار التنقل -->
                <div class="form-navigation">
                    <button type="button" class="btn btn-outline" id="prevBtn" onclick="prevStep()" style="display: none;">
                        ⏪ السابق
                    </button>
                    
                    <button type="button" class="btn" id="nextBtn" onclick="nextStep()">
                        التالي ⏩
                    </button>
                    
                    <button type="submit" class="btn" id="submitBtn" style="display: none;">
                        💾 حفظ الكتاب
                    </button>
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
        
        let currentStep = 1;
        const totalSteps = 4;
        
        // تحديث شريط التقدم
        function updateProgress() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }
        
        // تحديث الخطوات
        function updateSteps() {
            // تحديث حالة الخطوات
            for (let i = 1; i <= totalSteps; i++) {
                const step = document.getElementById('step' + i);
                const section = document.getElementById('section' + i);
                
                if (i < currentStep) {
                    step.classList.remove('active');
                    step.classList.add('completed');
                    section.classList.remove('active');
                } else if (i === currentStep) {
                    step.classList.add('active');
                    step.classList.remove('completed');
                    section.classList.add('active');
                } else {
                    step.classList.remove('active', 'completed');
                    section.classList.remove('active');
                }
            }
            
            // تحديث أزرار التنقل
            document.getElementById('prevBtn').style.display = currentStep > 1 ? 'inline-block' : 'none';
            
            if (currentStep < totalSteps) {
                document.getElementById('nextBtn').style.display = 'inline-block';
                document.getElementById('submitBtn').style.display = 'none';
            } else {
                document.getElementById('nextBtn').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'inline-block';
                updateReview();
            }
            
            updateProgress();
        }
        
        // الانتقال للخطوة التالية
        function nextStep() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateSteps();
                }
            }
        }
        
        // العودة للخطوة السابقة
        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                updateSteps();
            }
        }
        
        // التحقق من صحة الخطوة
        function validateStep(step) {
            switch(step) {
                case 1:
                    const title = document.getElementById('title').value.trim();
                    const author = document.getElementById('author_id').value;
                    const year = document.getElementById('published_year').value;
                    
                    if (!title) {
                        alert('يرجى إدخال عنوان الكتاب');
                        document.getElementById('title').focus();
                        return false;
                    }
                    
                    if (!author) {
                        alert('يرجى اختيار المؤلف');
                        return false;
                    }
                    
                    if (!year || year < 1000 || year > new Date().getFullYear()) {
                        alert('يرجى إدخال سنة نشر صحيحة');
                        document.getElementById('published_year').focus();
                        return false;
                    }
                    break;
                    
                case 2:
                    const description = document.getElementById('description').value.trim();
                    if (!description) {
                        alert('يرجى إدخال وصف الكتاب');
                        document.getElementById('description').focus();
                        return false;
                    }
                    break;
                    
                case 3:
                    // لا يوجد تحقق إجباري للخطوة 3
                    break;
            }
            return true;
        }
        
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
                }
                reader.readAsDataURL(file);
            }
        }
        
        // معاينة اسم الملف
        function previewFileName(event) {
            const file = event.target.files[0];
            const fileName = document.getElementById('fileName');
            
            if (file) {
                if (file.size > 10 * 1024 * 1024) { // 10MB
                    alert('حجم الملف كبير جداً. الحد الأقصى 10MB');
                    event.target.value = '';
                    fileName.textContent = '';
                    return;
                }
                
                if (!file.name.toLowerCase().endsWith('.pdf')) {
                    alert('يجب أن يكون الملف بصيغة PDF');
                    event.target.value = '';
                    fileName.textContent = '';
                    return;
                }
                
                fileName.textContent = '📄 ' + file.name;
            }
        }
        
        // تحديث صفحة المراجعة
        function updateReview() {
            document.getElementById('reviewTitle').textContent = document.getElementById('title').value || 'غير محدد';
            document.getElementById('reviewAuthor').textContent = 
                document.getElementById('author_id').options[document.getElementById('author_id').selectedIndex]?.text || 'غير محدد';
            document.getElementById('reviewYear').textContent = document.getElementById('published_year').value || 'غير محدد';
            document.getElementById('reviewCategory').textContent = document.getElementById('category').value || 'غير محدد';
            document.getElementById('reviewLanguage').textContent = 
                document.getElementById('language').options[document.getElementById('language').selectedIndex]?.text || 'غير محدد';
            document.getElementById('reviewPages').textContent = document.getElementById('pages').value || 'غير محدد';
            
            const coverImage = document.getElementById('cover_image').files[0];
            document.getElementById('reviewImage').textContent = coverImage ? coverImage.name : 'لم يتم رفع صورة';
            
            const file = document.getElementById('file').files[0];
            document.getElementById('reviewFile').textContent = file ? file.name : 'لم يتم رفع ملف';
        }
        
        // التحقق قبل الإرسال
        document.getElementById('bookForm').addEventListener('submit', function(e) {
            if (!validateStep(1) || !validateStep(2)) {
                e.preventDefault();
                alert('يرجى ملء جميع الحقول الإجبارية');
                return false;
            }
            
            // إظهار رسالة التحميل
            document.getElementById('submitBtn').innerHTML = '⏳ جاري الحفظ...';
            document.getElementById('submitBtn').disabled = true;
            
            return true;
        });
        
        // تهيئة الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            updateSteps();
            
            // إضافة حدث للخطوات للتنقل بالضغط عليها
            for (let i = 1; i <= totalSteps; i++) {
                document.getElementById('step' + i).addEventListener('click', function() {
                    if (i <= currentStep) {
                        currentStep = i;
                        updateSteps();
                    }
                });
            }
            
            // تحديث المراجعة عند تغيير أي حقل
            const formInputs = document.querySelectorAll('#bookForm input, #bookForm select, #bookForm textarea');
            formInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (currentStep === totalSteps) {
                        updateReview();
                    }
                });
                input.addEventListener('input', function() {
                    if (currentStep === totalSteps) {
                        updateReview();
                    }
                });
            });
        });
    </script>
</body>
</html>