<?php
try{

    $driver="mysql";
    $dbname="lab5";
    $host="localhost";
    $username="root";
    $password="";


    $dsn="$driver:host=$host;dbname=$dbname";

    $pdo=new PDO($dsn,$username,$password);

    echo "✅ اتصال ناجح!";

    $users=$pdo->prepare("SELECT * FROM `users`");
    $users->execute();

    echo "<pre>";
    print_r($users->fetchAll());
    echo "</pre>";


} catch (PDOException $e) {
    echo "❌ فشل الاتصال: " . $e->getMessage();
}