<?php
// config.php - إعدادات التطبيق

// إعدادات قاعدة البيانات
define('DB_HOST', 'localhost');
define('DB_NAME', 'library_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// إعدادات المسارات
define('BASE_URL', 'http://localhost/library/');
define('BASE_PATH', dirname(__FILE__));
define('APP_PATH', BASE_PATH . '/app');
define('UPLOAD_PATH', BASE_PATH . '/uploads/');

// إعدادات التطبيق
define('SITE_NAME', 'المكتبة الإلكترونية');
define('SESSION_NAME', 'library_session');

// إعدادات الصور
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_TYPES', ['jpg', 'jpeg', 'png', 'gif']);

// إعدادات العرض
error_reporting(E_ALL);
ini_set('display_errors', 1);

// بدء الجلسة
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}
