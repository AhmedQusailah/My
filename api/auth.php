<?php
// api/auth.php - API للمصادقة

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Models/User.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// السماح بـ OPTIONS للـ CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    $db = App\Core\Database::getInstance();
    $userModel = new App\Models\User();
    
    // تحديد العملية المطلوبة
    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            handlePostRequest($action, $userModel);
            break;
            
        case 'GET':
            handleGetRequest($action, $userModel);
            break;
            
        default:
            throw new Exception('Method not allowed', 405);
    }
    
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'code' => $e->getCode() ?: 500
    ], JSON_UNESCAPED_UNICODE);
}

function handlePostRequest($action, $userModel) {
    switch ($action) {
        case 'register':
            handleRegister($userModel);
            break;
            
        case 'login':
            handleLogin($userModel);
            break;
            
        case 'logout':
            handleLogout();
            break;
            
        default:
            throw new Exception('Invalid action', 400);
    }
}

function handleGetRequest($action, $userModel) {
    switch ($action) {
        case 'profile':
            handleGetProfile($userModel);
            break;
            
        case 'check':
            handleCheckAuth();
            break;
            
        default:
            throw new Exception('Invalid action', 400);
    }
}

// 1. تسجيل مستخدم جديد
function handleRegister($userModel) {
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
    
    // التحقق من البيانات المطلوبة
    $required = ['username', 'email', 'password'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            throw new Exception("حقل $field مطلوب", 400);
        }
    }
    
    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('البريد الإلكتروني غير صالح', 400);
    }
    
    // التحقق من قوة كلمة المرور
    if (strlen($data['password']) < 6) {
        throw new Exception('كلمة المرور يجب أن تكون 6 أحرف على الأقل', 400);
    }
    
    // تسجيل المستخدم
    $userId = $userModel->register([
        'username' => trim($data['username']),
        'email' => trim($data['email']),
        'password' => $data['password']
    ]);
    
    // جلب بيانات المستخدم المسجل
    $user = $userModel->find($userId);
    unset($user['password']);
    
    echo json_encode([
        'success' => true,
        'message' => 'تم إنشاء الحساب بنجاح',
        'data' => [
            'user' => $user,
            'token' => generateToken($user['id']),
            'links' => [
                'login' => BASE_URL . 'api/auth?action=login',
                'profile' => BASE_URL . 'api/auth?action=profile'
            ]
        ]
    ], JSON_UNESCAPED_UNICODE);
}

// 2. تسجيل الدخول
function handleLogin($userModel) {
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
    
    // التحقق من البيانات المطلوبة
    if (empty($data['username']) || empty($data['password'])) {
        throw new Exception('اسم المستخدم وكلمة المرور مطلوبان', 400);
    }
    
    // محاولة تسجيل الدخول
    $user = $userModel->login($data['username'], $data['password']);
    
    // إنشاء جلسة
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = $user;
    
    echo json_encode([
        'success' => true,
        'message' => 'تم تسجيل الدخول بنجاح',
        'data' => [
            'user' => $user,
            'session_id' => session_id(),
            'token' => generateToken($user['id']),
            'expires' => time() + (24 * 60 * 60) // 24 ساعة
        ]
    ], JSON_UNESCAPED_UNICODE);
}

// 3. تسجيل الخروج
function handleLogout() {
    session_start();
    
    if (isset($_SESSION['logged_in'])) {
        $username = $_SESSION['username'] ?? '';
        
        // تدمير الجلسة
        session_destroy();
        $_SESSION = [];
        
        echo json_encode([
            'success' => true,
            'message' => "تم تسجيل الخروج بنجاح",
            'data' => [
                'username' => $username
            ]
        ], JSON_UNESCAPED_UNICODE);
    } else {
        throw new Exception('لم يتم تسجيل الدخول', 401);
    }
}

// 4. الحصول على بيانات الملف الشخصي
function handleGetProfile($userModel) {
    // التحقق من المصادقة
    $userId = verifyAuth();
    
    // جلب بيانات المستخدم
    $user = $userModel->find($userId);
    unset($user['password']);
    
    // إحصائيات إضافية
    $db = App\Core\Database::getInstance();
    $stats = [
        'books_added' => $db->fetchColumn("SELECT COUNT(*) FROM books WHERE user_id = ?", [$userId]) ?: 0,
        'reviews' => $db->fetchColumn("SELECT COUNT(*) FROM reviews WHERE user_id = ?", [$userId]) ?: 0,
        'joined_days' => round((time() - strtotime($user['created_at'])) / (60 * 60 * 24))
    ];
    
    echo json_encode([
        'success' => true,
        'data' => [
            'user' => $user,
            'stats' => $stats,
            'links' => [
                'edit' => BASE_URL . 'api/auth?action=edit',
                'books' => BASE_URL . 'api/users/' . $userId . '/books'
            ]
        ]
    ], JSON_UNESCAPED_UNICODE);
}

// 5. التحقق من حالة المصادقة
function handleCheckAuth() {
    session_start();
    
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo json_encode([
            'success' => true,
            'authenticated' => true,
            'data' => [
                'user_id' => $_SESSION['user_id'] ?? null,
                'username' => $_SESSION['username'] ?? null,
                'session_id' => session_id()
            ]
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            'success' => true,
            'authenticated' => false,
            'message' => 'لم يتم تسجيل الدخول'
        ], JSON_UNESCAPED_UNICODE);
    }
}

// دوال مساعدة
function generateToken($userId) {
    return base64_encode($userId . ':' . time() . ':' . hash('sha256', $userId . time() . 'library_secret_key'));
}

function verifyAuth() {
    session_start();
    
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        throw new Exception('غير مصرح بالوصول', 401);
    }
    
    return $_SESSION['user_id'];
}