<?php
// app/Controllers/AuthController.php

namespace App\Controllers;

class AuthController
{
    public function index()
    {
        // الافتراضي: توجيه إلى صفحة التسجيل
        $this->register();
    }
    
    public function register()
    {
        // عرض صفحة التسجيل
        $title = "إنشاء حساب جديد";
        require_once APP_PATH . '/Views/auth/register.php';
    }
    
    public function login()
    {
        // عرض صفحة تسجيل الدخول
        $title = "تسجيل الدخول";
        require_once APP_PATH . '/Views/auth/login.php';
    }
    
    public function doRegister()
    {
        // معالجة طلب التسجيل
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '?url=auth/register');
            exit();
        }
        
        // جلب البيانات
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        // تحقق بسيط (سيتم تطويره لاحقاً)
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = "جميع الحقول مطلوبة";
            header('Location: ' . BASE_URL . '?url=auth/register');
            exit();
        }
        
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "كلمات المرور غير متطابقة";
            header('Location: ' . BASE_URL . '?url=auth/register');
            exit();
        }
        
        // تشفير كلمة المرور
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // هنا سيتم حفظ المستخدم في قاعدة البيانات (عندما ننشئ Model)
        
        // نجاح التسجيل
        $_SESSION['success'] = "تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.";
        $_SESSION['username'] = $username;
        
        header('Location: ' . BASE_URL . '?url=auth/login');
        exit();
    }
    
    public function doLogin()
    {
        // معالجة طلب تسجيل الدخول
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '?url=auth/login');
            exit();
        }
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = "اسم المستخدم وكلمة المرور مطلوبان";
            header('Location: ' . BASE_URL . '?url=auth/login');
            exit();
        }
        
        // هنا سيتم التحقق من المستخدم في قاعدة البيانات
        
        // محاكاة نجاح تسجيل الدخول
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        
        $_SESSION['success'] = "مرحباً $username! تم تسجيل الدخول بنجاح.";
        
        header('Location: ' . BASE_URL . '?url=books');
        exit();
    }
    
    public function logout()
    {
        // تسجيل الخروج
        session_destroy();
        $_SESSION = [];
        
        header('Location: ' . BASE_URL . '?url=auth/login');
        exit();
    }
}