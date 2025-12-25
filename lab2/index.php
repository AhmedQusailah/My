<!-----------------------------------***********------------------------------->
<!-- شكل الدالة في PHP -->
<?php

function sayHello() {
    echo "مرحباً بك في عالم الدوال!<br>";
}

sayHello();
sayHello();

?>
<!------------------------------------------------------------->
<!-- دوال بدون مدخلات ومخرجات -->
<?php

function welcomeStudents() {
    echo "أهلاً بالطلاب!<br>";
}

welcomeStudents();
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

function sumFixed() {
    return 10 + 20;
}

$result = sumFixed();
echo "النتيجة = $result<br>";

?>
<!------------------------------------------------------------------>
<!-- دوال بمدخلات + ترجع قيمة -->
<?php

function add($a, $b) {
    return $a + $b;
}

$result = add(5, 7);
echo "الناتج = $result<br>";

?>
<!-------------------------------------------------------------------->
<!-- دالة تستقبل الاسم والعمر وتعيد نصاً منسقًا -->
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

function testLocal() {
    $x = 10;
    echo $x . "<br>";
}

testLocal();
// echo $x; // خطأ: متغير محلي

?>
<!------------------------------------------------------------------------>
<!-- المتغيرات العامة -->
<?php

$x = 5;

function showGlobal() {
    global $x;
    echo $x . "<br>";
}

showGlobal();

?>
<!-------------------------------------------------------------------------->
<!-- استخدام $GLOBALS -->
<?php

$x = 20;

function demoGlobals() {
    echo $GLOBALS['x'] . "<br>";
}

demoGlobals();

?>
<!------------------------------------------------------------------------->
<!-- القيم الافتراضية للبارامترات -->
<?php

function welcomeUser($name = "ضيف") {
    echo "أهلاً يا $name <br>";
}

welcomeUser();
welcomeUser("أحمد");

?>
<!------------------------------------------------------------------------->
<!-- دوال ببارامترات متعددة -->
<?php

function sumThree($a, $b, $c) {
    return $a + $b + $c;
}

echo sumThree(1, 2, 3) . "<br>";

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

echo sumAll(1, 2, 3, 4, 5) . "<br>";

?>
<!-------------------------------------------------------------------------->
<!-- الدوال المجهولة -->
<?php

$hello = function() {
    echo "Hello!<br>";
};

$hello();

?>
<!-------------------------------------------------------------------------->
<!-- دالة مجهولة تستقبل بارامترات -->
<?php

$sumAnon = function($a, $b) {
    return $a + $b;
};

echo $sumAnon(5, 7) . "<br>";

?>
<!----------------------------------------------------------------------------->
<!-- Callback Functions -->
<?php

function process($callback) {
    echo "بدء المعالجة...<br>";
    $callback();
}

process(function() {
    echo "تم التنفيذ داخل الكول باك!<br>";
});

?>
<!---------------------------------------------------------------------------->
<!-- تطبيق عملي شامل -->
<?php

$students = ["Ali", "Omar", "Zed", "Lena", "Areej"];

$result = array_filter($students, function($name) {
    return strlen($name) > 3;
});

$result = array_values($result);
print_r($result);
echo "<br>";

?>
<!---------------------------------------------------------------------------->
<!-- الدوال داخل OOP -->
<?php

class Student {
    public function sayHello() {
        echo "مرحبًا، أنا طالب!<br>";
    }
}

$st = new Student();
$st->sayHello();

?>
<!------------------------------------------------------------------------------->
<!-- مثال متقدم لدوال داخل Class -->
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
echo $calc->add(10, 5) . "<br>";
echo $calc->multiply(4, 3) . "<br>";

?>
<!----------------------------------------------------------------------------->
<!-- الدوال مع الخصائص -->
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
echo $user->getName() . "<br>";

?>
<!------------------------------------------------------------------------------->
<!-- حساب عاملي العدد -->
<?php

function factorial($n) {
    if ($n <= 1) return 1;
    return $n * factorial($n - 1);
}

echo factorial(5) . "<br>";

?>
<!---------------------------------------------------------------------------->
<!-- Closure -->
<?php

$message = "مرحبًا";

$greeter = function() use ($message) {
    echo $message . "<br>";
};

$greeter();

?>
<!------------------------------------------------------------------------------>
<!-- Higher-Order Functions -->
<?php

$numbers = [1, 2, 3, 4];

$squared = array_map(function($n) {
    return $n * $n;
}, $numbers);

print_r($squared);
echo "<br>";

?>
<!------------------------------------------------------------------------------>
<!-- دالة تُرجع دالة -->
<?php

function multiplier($n) {
    return function($x) use ($n) {
        return $x * $n;
    };
}

$double = multiplier(2);
echo $double(10) . "<br>";

$triple = multiplier(3);
echo $triple(10) . "<br>";

?>
<!---------------------------------------------------------------------------->
<!-- Currying -->
<?php

function multiply($a) {
    return function($b) use ($a) {
        return function($c) use ($a, $b) {
            return $a * $b * $c;
        };
    };
}

echo multiply(2)(3)(4) . "<br>";

?>
<!---------------------------------------------------------------------------->
<!-- مثال Laravel Validation -->
<?php

function minLength($min) {
    return function($text) use ($min) {
        return strlen($text) >= $min;
    };
}

$validateName = minLength(5);

echo $validateName("Ali") ? "true<br>" : "false<br>";
echo $validateName("Ahmed") ? "true<br>" : "false<br>";

?>
<!---------------------------------------------------------------------------->
<!-- Function Composition -->
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
echo $combined(5);

?>
