<?php
$conn = new PDO(
    "mysql:host=localhost;dbname=bank",
    "root",
    ""
);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
$from = 1;     // الحساب الأول
$to = 2;       // الحساب الثاني
$amount = 100; // مبلغ التحويل

try {
    // بدء المعاملة
    $conn->beginTransaction();

    // التحقق من الرصيد
    $stmt = $conn->prepare("SELECT balance FROM accounts WHERE id = ?");
    $stmt->execute([$from]);
    $balance = $stmt->fetchColumn();

    if ($balance < $amount) {
        throw new Exception("الرصيد غير كافٍ");
    }

    // خصم الرصيد من الحساب الأول
    $stmt = $conn->prepare(
        "UPDATE accounts SET balance = balance - ? WHERE id = ?"
    );
    $stmt->execute([$amount, $from]);

    // إضافة الرصيد للحساب الثاني
    $stmt = $conn->prepare(
        "UPDATE accounts SET balance = balance + ? WHERE id = ?"
    );
    $stmt->execute([$amount, $to]);

    // تسجيل العملية
    $stmt = $conn->prepare(
        "INSERT INTO transactions 
        (from_account, to_account, amount, created_at)
        VALUES (?, ?, ?, NOW())"
    );
    $stmt->execute([$from, $to, $amount]);

    // تنفيذ العملية
    $conn->commit();
    echo "تم التحويل بنجاح";

} catch (Exception $e) {
    // التراجع في حال الخطأ
    $conn->rollBack();
    echo "فشلت العملية: " . $e->getMessage();
}
?>
