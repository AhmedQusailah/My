<?php
// app/Core/Database.php

namespace App\Core;

class Database
{
    private $connection;
    private static $instance = null;
    
    /**
     * Constructor - إنشاء اتصال بقاعدة البيانات
     */
    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            
            $this->connection = new \PDO($dsn, DB_USER, DB_PASS);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            
            // تعيين الترميز
            $this->connection->exec("SET NAMES utf8mb4");
            $this->connection->exec("SET CHARACTER SET utf8mb4");
            
        } catch (\PDOException $e) {
            die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
        }
    }
    
    /**
     * الحصول على نسخة واحدة من الاتصال (Singleton Pattern)
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * الحصول على كائن الاتصال PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * تنفيذ استعلام SELECT
     */
    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            die("خطأ في الاستعلام: " . $e->getMessage());
        }
    }
    
    /**
     * جلب جميع الصفوف
     */
    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * جلب صف واحد
     */
    public function fetch($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    /**
     * جلب قيمة عمود واحد
     */
    public function fetchColumn($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchColumn();
    }
    
    /**
     * تنفيذ INSERT, UPDATE, DELETE
     */
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute($params);
        } catch (\PDOException $e) {
            die("خطأ في تنفيذ الأمر: " . $e->getMessage());
        }
    }
    
    /**
     * الحصول على آخر ID تم إدخاله
     */
    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
    
    /**
     * بدء عملية Transaction
     */
    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }
    
    /**
     * تأكيد Transaction
     */
    public function commit()
    {
        return $this->connection->commit();
    }
    
    /**
     * التراجع عن Transaction
     */
    public function rollBack()
    {
        return $this->connection->rollBack();
    }
    
    /**
     * التحقق من وجود جدول
     */
    public function tableExists($tableName)
    {
        $sql = "SHOW TABLES LIKE ?";
        $result = $this->fetch($sql, [$tableName]);
        return !empty($result);
    }
    
    /**
     * إغلاق الاتصال
     */
    public function close()
    {
        $this->connection = null;
        self::$instance = null;
    }
}