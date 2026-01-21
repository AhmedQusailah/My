<?php
// app/Models/Book.php

namespace App\Models;

use App\Core\Model;

class Book extends Model
{
    protected $table = 'books';
    
    /**
     * جلب جميع الكتب مع معلومات المؤلف (JOIN)
     */
    public function getAllWithAuthors()
    {
        $sql = "SELECT 
                    b.*,
                    a.name as author_name,
                    a.bio as author_bio
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                ORDER BY b.title";
        
        return $this->db->fetchAll($sql);
    }
    
    /**
     * جلب كتاب معين مع معلومات المؤلف
     */
    public function getBookWithAuthor($bookId)
    {
        $sql = "SELECT 
                    b.*,
                    a.name as author_name,
                    a.bio as author_bio
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                WHERE b.id = ?";
        
        return $this->db->fetch($sql, [$bookId]);
    }
    
    /**
     * جلب كتب مؤلف معين
     */
    public function getBooksByAuthor($authorId)
    {
        $sql = "SELECT 
                    b.*,
                    a.name as author_name
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                WHERE b.author_id = ? 
                ORDER BY b.published_year DESC";
        
        return $this->db->fetchAll($sql, [$authorId]);
    }
    
    /**
     * البحث في الكتب
     */
    public function search($keyword)
    {
        $sql = "SELECT 
                    b.*,
                    a.name as author_name
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                WHERE b.title LIKE ? 
                OR b.description LIKE ? 
                OR a.name LIKE ? 
                ORDER BY b.title";
        
        $searchTerm = "%$keyword%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm]);
    }
    
    /**
     * جلب الكتب حسب السنة
     */
    public function getBooksByYear($year)
    {
        $sql = "SELECT 
                    b.*,
                    a.name as author_name
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                WHERE b.published_year = ? 
                ORDER BY b.title";
        
        return $this->db->fetchAll($sql, [$year]);
    }
    
    /**
     * جلب أحدث الكتب
     */
    public function getLatestBooks($limit = 5)
    {
        $sql = "SELECT 
                    b.*,
                    a.name as author_name
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                ORDER BY b.created_at DESC 
                LIMIT ?";
        
        return $this->db->fetchAll($sql, [$limit]);
    }
    
    /**
     * جلب إحصائيات الكتب
     */
    public function getStatistics()
    {
        $sql = "SELECT 
                    COUNT(*) as total_books,
                    MIN(published_year) as oldest_year,
                    MAX(published_year) as newest_year,
                    AVG(LENGTH(description)) as avg_description_length
                FROM books";
        
        return $this->db->fetch($sql);
    }
    
    /**
     * جلب الكتب مع التصنيف
     */
    public function paginateWithAuthors($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        
        $sql = "SELECT 
                    b.*,
                    a.name as author_name
                FROM books b 
                JOIN authors a ON b.author_id = a.id 
                ORDER BY b.title 
                LIMIT ?, ?";
        
        return $this->db->fetchAll($sql, [$offset, $perPage]);
    }
    
    /**
     * التحقق من وجود كتاب بنفس العنوان لنفس المؤلف
     */
    public function existsByTitleAndAuthor($title, $authorId, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM books WHERE title = ? AND author_id = ?";
        $params = [$title, $authorId];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $count = $this->db->fetchColumn($sql, $params);
        return $count > 0;
    }
}