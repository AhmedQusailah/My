<?php
// app/Controllers/ProfileController.php

namespace App\Controllers;

class ProfileController
{
    public function edit()
    {
        // حماية الصفحة - التحقق من تسجيل الدخول
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['error'] = "يجب تسجيل الدخول أولاً";
            header('Location: ' . BASE_URL . '?url=auth/login');
            exit();
        }
        
        $title = "تعديل الملف الشخصي";
        $user = [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => 'user@example.com', // سيتم جلبها من قاعدة البيانات
            'profile_image' => 'default.png'
        ];
        
        require_once APP_PATH . '/Views/profile/edit.php';
    }
    
    public function update()
    {
        // حماية الصفحة
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['error'] = "يجب تسجيل الدخول أولاً";
            header('Location: ' . BASE_URL . '?url=auth/login');
            exit();
        }
        
        // التحقق من أن الطريقة POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '?url=profile/edit');
            exit();
        }
        
        // جلب البيانات
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        
        // تحقق بسيط
        if (empty($username) || empty($email)) {
            $_SESSION['error'] = "اسم المستخدم والبريد الإلكتروني مطلوبان";
            header('Location: ' . BASE_URL . '?url=profile/edit');
            exit();
        }
        
        // معالجة رفع الصورة
        $profile_image = $this->handleImageUpload();
        
        // إذا تم رفع صورة جديدة
        if ($profile_image) {
            // حفظ اسم الصورة في الجلسة (سيتم حفظها في قاعدة البيانات لاحقاً)
            $_SESSION['profile_image'] = $profile_image;
        }
        
        // إذا تم إدخال كلمة مرور جديدة
        if (!empty($new_password)) {
            if (empty($current_password)) {
                $_SESSION['error'] = "يجب إدخال كلمة المرور الحالية لتغيير كلمة المرور";
                header('Location: ' . BASE_URL . '?url=profile/edit');
                exit();
            }
            
            // هنا سيتم التحقق من كلمة المرور الحالية في قاعدة البيانات
            
            // إذا كانت صحيحة، تحديث كلمة المرور
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            // حفظ في قاعدة البيانات
        }
        
        // تحديث بيانات الجلسة
        $_SESSION['username'] = $username;
        
        $_SESSION['success'] = "تم تحديث الملف الشخصي بنجاح";
        header('Location: ' . BASE_URL . '?url=profile/edit');
        exit();
    }
    
    private function handleImageUpload()
    {
        // إذا لم يتم رفع أي ملف
        if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        
        $file = $_FILES['profile_image'];
        
        // التحقق من وجود خطأ في الرفع
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "حدث خطأ أثناء رفع الصورة";
            return null;
        }
        
        // التحقق من نوع الملف
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_ext, $allowed_types)) {
            $_SESSION['error'] = "نوع الملف غير مسموح. المسموح: " . implode(', ', $allowed_types);
            return null;
        }
        
        // التحقق من حجم الملف (2MB كحد أقصى)
        $max_size = 2 * 1024 * 1024; // 2MB
        if ($file['size'] > $max_size) {
            $_SESSION['error'] = "حجم الصورة كبير جداً. الحد الأقصى 2MB";
            return null;
        }
        
        // إنشاء اسم فريد للملف
        $new_filename = uniqid() . '_' . time() . '.' . $file_ext;
        $upload_path = UPLOAD_PATH . $new_filename;
        
        // نقل الملف إلى مجلد التحميلات
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            return $new_filename;
        } else {
            $_SESSION['error'] = "فشل في حفظ الصورة";
            return null;
        }
    }
    
}
