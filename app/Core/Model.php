<?php
// app/Core/Model.php

namespace App\Core;

class Model
{
    protected $db;
    protected $table;
    protected $primaryKey = 'id';
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    /**
     * جلب جميع السجلات
     */
    public function all($orderBy = 'id', $order = 'DESC')
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$order}";
        return $this->db->fetchAll($sql);
    }
    
    /**
     * جلب سجل بواسطة ID
     */
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    /**
     * إنشاء سجل جديد
     */
    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $values = array_values($data);
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $values);
        
        return $this->db->lastInsertId();
    }
    
    /**
     * تحديث سجل
     */
    public function update($id, $data)
    {
        $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';
        $values = array_values($data);
        $values[] = $id;
        
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = ?";
        return $this->db->execute($sql, $values);
    }
    
    /**
     * حذف سجل
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->execute($sql, [$id]);
    }
    
    /**
     * جلب سجل بواسطة عمود معين
     */
    public function findBy($column, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return $this->db->fetch($sql, [$value]);
    }
    
    /**
     * التحقق من وجود سجل
     */
    public function exists($column, $value, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$column} = ?";
        $params = [$value];
        
        if ($excludeId) {
            $sql .= " AND {$this->primaryKey} != ?";
            $params[] = $excludeId;
        }
        
        $count = $this->db->fetchColumn($sql, $params);
        return $count > 0;
    }
    
    /**
     * Pagination - جلب سجلات مع تحديد عدد
     */
    public function paginate($page = 1, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$order} LIMIT ?, ?";
        
        return $this->db->fetchAll($sql, [$offset, $perPage]);
    }
    
    /**
     * عد جميع السجلات
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        return $this->db->fetchColumn($sql);
    }
    
    /**
     * تنفيذ استعلام مخصص
     */
    public function query($sql, $params = [])
    {
        return $this->db->query($sql, $params);
    }
    
    /**
     * جلب جميع الصفوف من استعلام مخصص
     */
    public function fetchAllQuery($sql, $params = [])
    {
        return $this->db->fetchAll($sql, $params);
    }
    
    /**
     * جلب صف واحد من استعلام مخصص
     */
    public function fetchQuery($sql, $params = [])
    {
        return $this->db->fetch($sql, $params);
    }
}