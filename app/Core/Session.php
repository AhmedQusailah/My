<?php
// app/Core/Session.php

namespace App\Core;

class Session
{
    /**
     * بدء الجلسة إذا لم تكن بدأت
     */
    public static function init()
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (defined('SESSION_NAME')) {
                session_name(SESSION_NAME);
            }
            session_start();
        }
    }
    
    /**
     * تعيين قيمة في الجلسة
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    /**
     * الحصول على قيمة من الجلسة
     */
    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }
    
    /**
     * التحقق من وجود مفتاح في الجلسة
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }
    
    /**
     * حذف مفتاح من الجلسة
     */
    public static function delete($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
    
    /**
     * تعيين رسالة فلاش (تظهر مرة واحدة)
     */
    public static function setFlash($type, $message)
    {
        self::set('flash_' . $type, $message);
    }
    
    /**
     * الحصول على رسالة فلاش وحذفها
     */
    public static function getFlash($type)
    {
        $key = 'flash_' . $type;
        $message = self::get($key);
        self::delete($key);
        return $message;
    }
    
    /**
     * التحقق من وجود رسالة فلاش
     */
    public static function hasFlash($type)
    {
        return self::has('flash_' . $type);
    }
    
    /**
     * تعيين رسالة نجاح
     */
    public static function setSuccess($message)
    {
        self::setFlash('success', $message);
    }
    
    /**
     * تعيين رسالة خطأ
     */
    public static function setError($message)
    {
        self::setFlash('error', $message);
    }
    
    /**
     * الحصول على رسالة النجاح
     */
    public static function getSuccess()
    {
        return self::getFlash('success');
    }
    
    /**
     * الحصول على رسالة الخطأ
     */
    public static function getError()
    {
        return self::getFlash('error');
    }
    
    /**
     * التحقق من وجود رسالة نجاح
     */
    public static function hasSuccess()
    {
        return self::hasFlash('success');
    }
    
    /**
     * التحقق من وجود رسالة خطأ
     */
    public static function hasError()
    {
        return self::hasFlash('error');
    }
    
    /**
     * تعيين بيانات المستخدم عند تسجيل الدخول
     */
    public static function setUser($userData)
    {
        self::set('user', $userData);
        self::set('logged_in', true);
    }
    
    /**
     * الحصول على بيانات المستخدم
     */
    public static function getUser($key = null)
    {
        $user = self::get('user', []);
        
        if ($key) {
            return $user[$key] ?? null;
        }
        
        return $user;
    }
    
    /**
     * التحقق من تسجيل الدخول
     */
    public static function isLoggedIn()
    {
        return self::get('logged_in', false);
    }
    
    /**
     * تسجيل الخروج
     */
    public static function logout()
    {
        // مسح جميع بيانات الجلسة
        $_SESSION = [];
        
        // إذا كانت الجلسة تستخدم كوكيز، احذف الكوكي
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // تدمير الجلسة
        session_destroy();
    }
    
    /**
     * تجديد معرف الجلسة
     */
    public static function regenerate()
    {
        session_regenerate_id(true);
    }
    
    /**
     * الحصول على معرف الجلسة
     */
    public static function getId()
    {
        return session_id();
    }
    
    /**
     * مسح جميع بيانات الجلسة
     */
    public static function clear()
    {
        session_unset();
        $_SESSION = [];
    }
}