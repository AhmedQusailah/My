<?php
// app/Controllers/BookController.php

namespace App\Controllers;

class BookController
{
    public function index()
    {
        // حماية الصفحة - التحقق من تسجيل الدخول
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['error'] = "يجب تسجيل الدخول أولاً";
            header('Location: ' . BASE_URL . '?url=auth/login');
            exit();
        }
        
        // بيانات تجريبية للكتب (سيتم استبدالها بقاعدة بيانات)
        $books = [
            [
                'id' => 1,
                'title' => 'ما وراء الطبيعة',
                'author_name' => 'أحمد خالد توفيق',
                'description' => 'سلسلة روايات رعب وخيال علمي',
                'published_year' => 1992
            ],
            [
                'id' => 2,
                'title' => 'ذاكرة للنسيان',
                'author_name' => 'محمود درويش',
                'description' => 'قصيدة طويلة عن حصار بيروت',
                'published_year' => 1986
            ],
            [
                'id' => 3,
                'title' => 'يوتوبيا',
                'author_name' => 'أحمد خالد توفيق',
                'description' => 'رواية ديستوبية عن مستقبل مصر',
                'published_year' => 2008
            ]
        ];
        
        $title = "قائمة الكتب";
        require_once APP_PATH . '/Views/books/index.php';
    }
    
    public function show($id)
    {
        // حماية الصفحة
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $_SESSION['error'] = "يجب تسجيل الدخول أولاً";
            header('Location: ' . BASE_URL . '?url=auth/login');
            exit();
        }
        
        // هنا سيتم جلب الكتاب من قاعدة البيانات باستخدام JOIN
        $book = [
            'id' => $id,
            'title' => 'كتاب تجريبي',
            'author_name' => 'مؤلف تجريبي',
            'description' => 'وصف الكتاب هنا',
            'published_year' => 2023
        ];
        
        $title = $book['title'];
        require_once APP_PATH . '/Views/books/show.php';
    }
}