<?php
// app/Models/Author.php

namespace App\Models;

use App\Core\Model;

class Author extends Model
{
    protected $table = 'authors';
    
    /**
     * جلب جميع المؤلفين مع عدد كتب كل مؤلف
     */
    public function getAllWithBookCount()
    {
        $sql = "SELECT 
                    a.*, 
                    COUNT(b.id) as book_count 
                FROM authors a 
                LEFT JOIN books b ON a.id = b.author_id 
                GROUP BY a.id 
                ORDER BY a.name";
        
        return $this->db->fetchAll($sql);
    }
    
    /**
     * جلب مؤلف مع كتبه
     */
    public function getAuthorWithBooks($authorId)
    {
        $sql = "SELECT 
                    a.*,
                    b.id as book_id,
                    b.title,
                    b.description,
                    b.published_year
                FROM authors a 
                LEFT JOIN books b ON a.id = b.author_id 
                WHERE a.id = ?
                ORDER BY b.published_year DESC";
        
        return $this->db->fetchAll($sql, [$authorId]);
    }
    
    /**
     * البحث عن مؤلف بالاسم
     */
    public function searchByName($name)
    {
        $sql = "SELECT * FROM authors WHERE name LIKE ? ORDER BY name";
        return $this->db->fetchAll($sql, ["%$name%"]);
    }
    
    /**
     * التحقق من وجود مؤلف بالاسم
     */
    public function existsByName($name, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM authors WHERE name = ?";
        $params = [$name];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $count = $this->db->fetchColumn($sql, $params);
        return $count > 0;
    }
    
    /**
     * جلب المؤلفين مع التصنيف
     */
    public function paginateWithStats($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        
        $sql = "SELECT 
                    a.*,
                    COUNT(b.id) as total_books,
                    MIN(b.published_year) as first_book_year,
                    MAX(b.published_year) as last_book_year
                FROM authors a 
                LEFT JOIN books b ON a.id = b.author_id 
                GROUP BY a.id 
                ORDER BY a.name 
                LIMIT ?, ?";
        
        return $this->db->fetchAll($sql, [$offset, $perPage]);
    }
    
    /**
     * جذب أفضل المؤلفين حسب عدد الكتب
     */
    public function getTopAuthors($limit = 5)
    {
        $sql = "SELECT 
                    a.*,
                    COUNT(b.id) as book_count
                FROM authors a 
                LEFT JOIN books b ON a.id = b.author_id 
                GROUP BY a.id 
                ORDER BY book_count DESC, a.name 
                LIMIT ?";
        
        return $this->db->fetchAll($sql, [$limit]);
    }
}