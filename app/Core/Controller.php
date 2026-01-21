<?php
// app/Core/Controller.php

namespace App\Core;

class Controller
{
    /**
     * عرض View مع تمرير البيانات
     */
    protected function view($view, $data = [])
    {
        // استخراج البيانات لمتغيرات منفصلة
        extract($data);
        
        // مسار ملف الـ View
        $viewFile = APP_PATH . '/Views/' . $view . '.php';
        
        // التحقق من وجود ملف الـ View
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View not found: " . $view);
        }
    }
    
    /**
     * تحميل Model
     */
    protected function model($model)
    {
        $modelClass = "App\\Models\\" . $model;
        
        if (class_exists($modelClass)) {
            return new $modelClass();
        } else {
            die("Model not found: " . $model);
        }
    }
    
    /**
     * إعادة توجيه
     */
    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . '?url=' . $url);
        exit();
    }
    
    /**
     * التحقق من تسجيل الدخول
     */
    protected function requireLogin()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['error'] = "يجب تسجيل الدخول أولاً للوصول إلى هذه الصفحة";
            $this->redirect('auth/login');
        }
    }
    
    /**
     * إذا كان المستخدم مسجلاً، توجيهه للصفحة الرئيسية
     */
    protected function requireGuest()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            $this->redirect('books');
        }
    }
    
    /**
     * جلب بيانات POST
     */
    protected function input($key, $default = '')
    {
        return $_POST[$key] ?? $default;
    }
    
    /**
     * جلب بيانات GET
     */
    protected function get($key, $default = '')
    {
        return $_GET[$key] ?? $default;
    }
    
    /**
     * تعيين رسالة نجاح
     */
    protected function setSuccess($message)
    {
        $_SESSION['success'] = $message;
    }
    
    /**
     * تعيين رسالة خطأ
     */
    protected function setError($message)
    {
        $_SESSION['error'] = $message;
    }
    
    /**
     * تنظيف المدخلات
     */
    protected function cleanInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}