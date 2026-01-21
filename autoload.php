<?php
// autoload.php - محمل تلقائي يدوي

spl_autoload_register(function ($className) {
    // تحويل namespace إلى مسار ملف
    $className = str_replace('App\\', '', $className);
    $className = str_replace('\\', '/', $className);
    
    // المسارات المحتملة للملفات
    $possiblePaths = [
        __DIR__ . '/' . $className . '.php',
        __DIR__ . '/app/' . $className . '.php',
        __DIR__ . '/app/Core/' . $className . '.php',
        __DIR__ . '/app/Controllers/' . $className . '.php',
        __DIR__ . '/app/Models/' . $className . '.php'
    ];
    
    // البحث عن الملف
    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
    
    // إذا لم يتم العثور على الملف
    die("Class $className not found!");
});