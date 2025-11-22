دوال النصوص والمصفوفات في لغة PHP
<br>;
أولاً: دوال النصوص (String Functions)
<br>;
1. strlen()
<br>;
تحسب طول النص وترجع عدد الحروف
<br>;
مثال:
<br>;
echo  strlen("Hello");   // تحسب طول النص
<br>;
2. str_word_count()
<br>;
تحسب عدد الكلمات داخل النص
<br>;
echo str_word_count("Hello world");
<br>;
3. strrev()
<br>;
تعكس ترتيب الحروف
<br>;
echo strrev("Hello");
<br>;
4. strpos()
<br>;
تبحث عن كلمة داخل نص وتعيد موقعها
<br>;
echo strpos("Hello world", "world");
<br>;
5. str_replace()
<br>;
تستبدل كلمة بكلمة أخرى
<br>;
echo str_replace("world", "PHP", "Hello world");
<br>;
6. strtolower()
<br>;
تحول النص إلى حروف صغيرة
<br>;
echo strtolower("HELLO");
<br>;
7. strtoupper()
<br>;
تحول النص إلى حروف كبيرة
<br>;
echo strtoupper("hello");
<br>;
8. trim()
<br>;
تزيل الفراغات من بداية ونهاية النص
<br>;
echo trim("   hello   ");
<br>;
9. substr()
<br>;
تقطع جزء من النص
<br>;
echo substr("Hello world", 0, 5);
<br>;
10. explode()
<br>;
تقسم النص إلى مصفوفة باستخدام فاصل
<br>;
print_r(explode(" ", "Hello world"));
<br>;
11. implode()
<br>;
تجمع عناصر المصفوفة داخل نص
<br>;
echo implode("-", ["Hello", "world"]);
<br>;
---
<br>;
ثانياً: دوال المصفوفات (Array Functions)
<br>;
1. count()
<br>;
تحسب عدد العناصر
<br>;
echo count([1,2,3]);
<br>;
2. array_push()
<br>;
تضيف عنصر جديد في آخر المصفوفة
<br>;
$arr = [1,2];
<br>;
array_push($arr, 3);
<br>;
3. array_pop()
<br>;
تحذف آخر عنصر
<br>;
$arr = [1,2,3];
<br>;
array_pop($arr);
<br>;
4. array_shift()
<br>;
تحذف أول عنصر
<br>;
$arr = [1,2,3];
<br>;
array_shift($arr);
<br>;
5. array_unshift()
<br>;
تضيف عنصر في بداية المصفوفة
<br>;
$arr = [2,3];
<br>;
array_unshift($arr, 1);
<br>;
6. array_merge()
<br>;
دمج مصفوفتين
<br>;
array_merge([1,2], [3,4]);
<br>;
7. in_array()
<br>;
تتحقق من وجود قيمة داخل المصفوفة
<br>;
in_array(3, [1,2,3]);
<br>;
8. array_search()
<br>;
تبحث عن قيمة وترجع موقعها
<br>;
array_search("apple", ["banana","apple"]);
<br>;
9. sort()
<br>;
ترتيب تصاعدي
<br>;
$arr = [3,1,2];
<br>;
sort($arr);
<br>;
10. rsort()
<br>;
ترتيب تنازلي
<br>;
$arr = [1,3,2];
<br>;
rsort($arr);
<br>;
11. array_reverse()
<br>;
تعكس ترتيب العناصر
<br>;
array_reverse([1,2,3]);
<br>;