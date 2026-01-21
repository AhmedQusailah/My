<?php
// api/books.php - API للحصول على جميع الكتب

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/Core/Database.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    $db = App\Core\Database::getInstance();
    
    // الحصول على معاملات البحث
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    
    $author_id = isset($_GET['author_id']) ? (int)$_GET['author_id'] : null;
    $year = isset($_GET['year']) ? $_GET['year'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    
    // بناء الاستعلام مع JOIN
    $sql = "SELECT 
                b.id,
                b.title,
                b.description,
                b.published_year,
                b.created_at,
                a.id as author_id,
                a.name as author_name,
                a.bio as author_bio
            FROM books b
            JOIN authors a ON b.author_id = a.id
            WHERE 1=1";
    
    $params = [];
    
    // إضافة فلتر المؤلف
    if ($author_id) {
        $sql .= " AND b.author_id = ?";
        $params[] = $author_id;
    }
    
    // إضافة فلتر السنة
    if ($year) {
        $sql .= " AND b.published_year = ?";
        $params[] = $year;
    }
    
    // إضافة فلتر البحث
    if ($search) {
        $sql .= " AND (b.title LIKE ? OR b.description LIKE ? OR a.name LIKE ?)";
        $searchTerm = "%$search%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }
    
    // إضافة الترتيب والتحديد
    $sql .= " ORDER BY b.created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    
    // تنفيذ الاستعلام
    $stmt = $db->query($sql, $params);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // جلب العدد الإجمالي
    $countSql = "SELECT COUNT(*) as total FROM books b JOIN authors a ON b.author_id = a.id";
    if ($author_id || $year || $search) {
        $countSql .= " WHERE 1=1";
        if ($author_id) $countSql .= " AND b.author_id = $author_id";
        if ($year) $countSql .= " AND b.published_year = '$year'";
        if ($search) $countSql .= " AND (b.title LIKE '%$search%' OR a.name LIKE '%$search%')";
    }
    $totalStmt = $db->query($countSql);
    $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // إضافة روابط للصور (إذا كانت موجودة)
    foreach ($books as &$book) {
        $book['cover_image'] = BASE_URL . 'uploads/books/' . ($book['cover_image'] ?? 'default.jpg');
        $book['links'] = [
            'self' => BASE_URL . 'api/books/' . $book['id'],
            'author' => BASE_URL . 'api/authors/' . $book['author_id'],
            'web_view' => BASE_URL . '?url=books/show/' . $book['id']
        ];
    }
    
    // إرجاع النتيجة
    echo json_encode([
        'success' => true,
        'data' => $books,
        'pagination' => [
            'total' => (int)$total,
            'per_page' => $limit,
            'current_page' => $page,
            'total_pages' => ceil($total / $limit)
        ],
        'meta' => [
            'version' => '1.0',
            'timestamp' => date('Y-m-d H:i:s')
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'code' => 500
    ], JSON_UNESCAPED_UNICODE);
}