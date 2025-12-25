
<!-- دوال الوقت والتاريخ -->
<?php
// التاريخ والوقت الحالي
echo "التاريخ الحالي: " . date("Y-m-d") . "<br>";
echo "الوقت الحالي: " . date("H:i:s") . "<br>";

// طباعة اليوم
echo "اليوم: " . date("l") . "<br>";

// فرق الوقت (مثال)
$today = new DateTime();
$future = new DateTime("2025-01-01");
$diff = $today->diff($future);

echo "عدد الأيام المتبقية: " . $diff->days;
?>


<!-- دوال التعامل مع الملفات -->

<!-- إنشاء ملف وكتابة بيانات فيه -->
<?php
$filename = "data.txt";

// فتح الملف للكتابة
$file = fopen($filename, "w");
fwrite($file, "مرحبا بك في ملف PHP\n");
fwrite($file, "تاريخ الإنشاء: " . date("Y-m-d H:i:s"));
fclose($file);

echo "تم إنشاء الملف وكتابة البيانات بنجاح";
?>

<!-- قراءة محتوى الملف -->
 <?php
$filename = "data.txt";

if (file_exists($filename)) {
    $content = file_get_contents($filename);
    echo nl2br($content);
} else {
    echo "الملف غير موجود";
}
?>

<!-- الاتصال بقاعدة بيانات MySQL باستخدام PHP (PDO) -->
 <!-- الاتصال بقاعدة البيانات -->

 <?php
$host = "localhost";
$dbname = "test_db";
$user = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "تم الاتصال بقاعدة البيانات بنجاح";
} catch (PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>
