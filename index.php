<?php
// index.php - نقطة الدخول الرئيسية

// تضمين ملف الإعدادات
require_once __DIR__ . '/config.php';

// تضمين Autoload
require_once __DIR__ . '/autoload.php';

// استدعاء ملفات Core الأساسية
require_once APP_PATH . '/Core/Controller.php';
require_once APP_PATH . '/Core/Database.php';
require_once APP_PATH . '/Core/Session.php';

// روتينج بسيط
$url = $_GET['url'] ?? 'auth/login';
$url = trim($url, '/');
$urlParts = explode('/', $url);

// تحديد الـ Controller
$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'AuthController';
$method = $urlParts[1] ?? 'index';
$params = array_slice($urlParts, 2);

// مسار الـ Controller
$controllerFile = APP_PATH . "/Controllers/{$controllerName}.php";

// تحقق من وجود الـ Controller
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // إنشاء كائن من الـ Controller
    $controllerClass = "App\\Controllers\\{$controllerName}";
    $controller = new $controllerClass();
    
    // استدعاء الميثود
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        // إذا الميثود غير موجودة، توجيه لصفحة 404
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 - الصفحة غير موجودة</h1>";
        echo "<p>الطريقة '$method' غير موجودة في $controllerName</p>";
    }
} else {
    // إذا الـ Controller غير موجود، توجيه للتسجيل مباشرة
    header('Location: ' . BASE_URL . '?url=auth/register');
    exit();
}