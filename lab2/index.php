<!-----------------------------------***********------------------------------->
<!-- شكل الدالة في PHP -->
<?php

function sayHello() {
    echo "مرحباً بك في عالم الدوال!<br>";
}

sayHello(); // استدعاء الدالة
sayHello(); // يمكنك استدعاؤها أكثر من مرة!

?>
<!------------------------------------------------------------->
<!-- دوال بدون مددخلات ومخرجات -->
<?php

function welcome() {
    echo "أهلاً بالطلاب!<br>";
}

welcome();
?>
<!-------------------------------------------------------------->
<!-- دوال بمدخلات -->
<?php

function greet($name) {
    echo "مرحباً يا $name!<br>";
}

greet("أحمد");
greet("سارة");
greet("إبراهيم");

?>
<!---------------------------------------------------------------->
<!-- دوال ترجع قيمة -->
<?php

	function sum() {
	    return 10 + 20;
	}
	
	$result = sum();
	
	echo "النتيجة = $result";

?>
<!------------------------------------------------------------------>
<!-- دوال بمدخلات + ترجع قيمة -->
<?php

function add($a, $b) {
    return $a + $b;
}

$result = add(5, 7);

echo "الناتج = $result";

?>
<!-------------------------------------------------------------------->
<!-- اكتب دالة تستقبل الاسم والعمر وتعيد نصاً منسقًا -->
<?php

function userInfo($name, $age) {
    return "الاسم: $name — العمر: $age سنة<br>";
}

echo userInfo("أحمد", 22);
echo userInfo("سارة", 19);

?>
<!-------------------------------------------------------------------->
<!-- المتغيرات المحلية -->
<?php

function test() {
    $x = 10; // متغير محلي
    echo $x;
}

test();   // 10
echo $x;  // ❌ خطأ — المتغير غير موجود خارج الدالة

?>
<!------------------------------------------------------------------------>
<!-- المتغيرات العامة -->
<?php

$x = 5;

function show() {
    global $x;
    echo $x; // يعمل
}

show();

?>
<!-------------------------------------------------------------------------->
<!-- استخدام $GLOBALS — الطريقة الأكثر احترافية -->
<?php

$x = 20;

function demo() {
    echo $GLOBALS['x'];
}

demo(); // 20

?>
<!------------------------------------------------------------------------->
<!-- القيم الافتراضية للبارامترات -->
<?php

function welcome($name = "ضيف") {
    echo "أهلاً يا $name <br>";
}

welcome();           // أهلاً يا ضيف
welcome("أحمد");     // أهلاً يا أحمد

?>
<!------------------------------------------------------------------------->
<!-- دوال ببارامترات متعددة -->
<?php
function sum($a, $b, $c) {
    return $a + $b + $c;
}

echo sum(1, 2, 3);
?>
<!------------------------------------------------------------------------>
<!-- دوال تستقبل عددًا غير محدود من القيم -->
<?php

function sumAll(...$numbers) {
    $total = 0;

    foreach ($numbers as $n) {
        $total += $n;
    }

    return $total;
}

echo sumAll(1, 2, 3, 4, 5);

?>
<!-------------------------------------------------------------------------->
<!-- الدوال المجهولة -->
<?php

$hello = function() {
    echo "Hello!";
};

$hello(); // استدعاء

?>
<!-------------------------------------------------------------------------->
<!-- دالة مجهولة تستقبل بارامترات -->
<?php
$sum = function($a, $b) {
    return $a + $b;
};

echo $sum(5, 7);
?>
<!----------------------------------------------------------------------------->
<!--  Callback Functions -->
<?php

function process($callback) {
    echo "بدء المعالجة...<br>";
    $callback();
}

process(function() {
    echo "تم التنفيذ داخل الكول باك!";
});

?>
<!---------------------------------------------------------------------------->
<!-- تطبيق عملي شامل -->
<?php

$students = ["Ali", "Omar", "Zed", "Lena", "Areej"];

$result = array_filter($students, function($name) {
    return strlen($name) > 3;
});

print_r($result);

?>
<!---------------------------------------------------------------------------->
<!-- الدوال داخل OOP (الطرق Methods) -->
<?php

class Student {
    
    public function sayHello() {
        echo "مرحبًا، أنا طالب!";
    }
}

$st = new Student();
$st->sayHello();

?>
<!------------------------------------------------------------------------------->
<!-- مثال متقدم لدوال داخل الـ Class (OOP) -->
<?php

class Calculator {

    public function add($a, $b) {
        return $a + $b;
    }

    public function multiply($a, $b) {
        return $a * $b;
    }
}

$calc = new Calculator();

echo $calc->add(10, 5);
echo $calc->multiply(4, 3);

?>
<!----------------------------------------------------------------------------->
<!-- الدوال مع الخصائص (Using $this) -->
<?php

class User {
    public $name;

    public function setName($n) {
        $this->name = $n;
    }

    public function getName() {
        return $this->name;
    }
}

$user = new User();
$user->setName("أحمد");

echo $user->getName(); // أحمد

?>
<!------------------------------------------------------------------------------->
<!--  حساب عاملي العدد (Factorial) -->
<?php

function factorial($n) {
    if ($n == 1) return 1;

    return $n * factorial($n - 1);
}

echo factorial(5); // 120

?>
<!---------------------------------------------------------------------------->
<!-- مفهوم الـ Closure (الدوال المغلقة) -->
<?php

$message = "مرحبًا";

$greeter = function() use ($message) {
    echo $message;
};

$greeter();

?>
<!------------------------------------------------------------------------------>
<!--  Higher-Order Functions -->
<?php
$numbers = [1, 2, 3, 4];

$squared = array_map(function($n) {
    return $n * $n;
}, $numbers);

print_r($squared);
?>
<!------------------------------------------------------------------------------>
<!-- دالة تُرجع دالة (Function Returning Function) -->
<?php

function multiplier($n) {
    return function($x) use ($n) {
        return $x * $n;
    };
}

$double = multiplier(2);
echo $double(10); // 20

$triple = multiplier(3);
echo $triple(10); // 30

?>
<!----------------------------------------------------------------------------->
<!-- مثال أساسي للـ Closure -->
<?php

$message = "Hello";

$greet = function() use ($message) {
    echo $message;
};

$greet();
?>
<!---------------------------------------------------------------------------->
<!-- Currying (تقسيم الدالة إلى مراحل) -->
<?php

function multiply($a) {
    return function($b) use ($a) {
        return function($c) use ($a, $b) {
            return $a * $b * $c;
        };
    };
}

echo multiply(2)(3)(4); // 24

?>
<!---------------------------------------------------------------------------->
<!-- (يستخدم في Laravel Validation) -->
<?php

function minLength($min) {
    return function($text) use ($min) {
        return strlen($text) >= $min;
    };
}

$validateName = minLength(5);

echo $validateName("Ali");    // false  
echo $validateName("Ahmed");  // true

?>
<!--------------------------------------------------------------------------->
<!--  Function Composition -->
<?php
function double($n) {
    return $n * 2;
}

function increment($n) {
    return $n + 1;
}

function compose($f, $g) {
    return function($x) use ($f, $g) {
        return $f($g($x));
    };
}

$combined = compose('double', 'increment');

echo $combined(5); // (5 + 1) × 2 = 12
?>
<!-----------------------------************---------------------------------->
