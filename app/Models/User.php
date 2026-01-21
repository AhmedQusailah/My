<?php
// app/Models/User.php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'users';
    
    /**
     * تسجيل مستخدم جديد
     */
    public function register($data)
    {
        // تحقق من عدم وجود المستخدم مسبقاً
        if ($this->usernameExists($data['username'])) {
            throw new \Exception('اسم المستخدم موجود مسبقاً');
        }
        
        if ($this->emailExists($data['email'])) {
            throw new \Exception('البريد الإلكتروني موجود مسبقاً');
        }
        
        // تشفير كلمة المرور
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // إضافة تاريخ الإنشاء
        $data['created_at'] = date('Y-m-d H:i:s');
        
        // إنشاء المستخدم
        return $this->create($data);
    }
    
    /**
     * تسجيل الدخول
     */
    public function login($username, $password)
    {
        // جلب المستخدم
        $user = $this->findByUsername($username);
        
        if (!$user) {
            throw new \Exception('اسم المستخدم أو كلمة المرور غير صحيحة');
        }
        
        // التحقق من كلمة المرور
        if (!password_verify($password, $user['password'])) {
            throw new \Exception('اسم المستخدم أو كلمة المرور غير صحيحة');
        }
        
        // إرجاع بيانات المستخدم بدون كلمة المرور
        unset($user['password']);
        return $user;
    }
    
    /**
     * تحديث الملف الشخصي
     */
    public function updateProfile($userId, $data)
    {
        // إذا تم تغيير اسم المستخدم، تحقق من عدم تكراره
        if (isset($data['username']) && $this->usernameExists($data['username'], $userId)) {
            throw new \Exception('اسم المستخدم موجود مسبقاً');
        }
        
        // إذا تم تغيير البريد الإلكتروني، تحقق من عدم تكراره
        if (isset($data['email']) && $this->emailExists($data['email'], $userId)) {
            throw new \Exception('البريد الإلكتروني موجود مسبقاً');
        }
        
        // إذا تم إرسال كلمة مرور جديدة
        if (isset($data['new_password']) && !empty($data['new_password'])) {
            // يجب إرسال كلمة المرور الحالية للتحقق
            if (empty($data['current_password'])) {
                throw new \Exception('يجب إدخال كلمة المرور الحالية');
            }
            
            // جلب كلمة المرور الحالية من قاعدة البيانات
            $user = $this->find($userId);
            
            // التحقق من كلمة المرور الحالية
            if (!password_verify($data['current_password'], $user['password'])) {
                throw new \Exception('كلمة المرور الحالية غير صحيحة');
            }
            
            // تشفير كلمة المرور الجديدة
            $data['password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
            
            // إزالة الحقول غير اللازمة
            unset($data['current_password']);
            unset($data['new_password']);
        }
        
        // تحديث البيانات
        return $this->update($userId, $data);
    }
    
    /**
     * البحث عن مستخدم بواسطة اسم المستخدم
     */
    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        return $this->db->fetch($sql, [$username]);
    }
    
    /**
     * البحث عن مستخدم بواسطة البريد الإلكتروني
     */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->db->fetch($sql, [$email]);
    }
    
    /**
     * التحقق من وجود اسم مستخدم
     */
    public function usernameExists($username, $excludeId = null)
    {
        return $this->exists('username', $username, $excludeId);
    }
    
    /**
     * التحقق من وجود بريد إلكتروني
     */
    public function emailExists($email, $excludeId = null)
    {
        return $this->exists('email', $email, $excludeId);
    }
    
    /**
     * تحديث صورة الملف الشخصي
     */
    public function updateProfileImage($userId, $imageName)
    {
        $sql = "UPDATE users SET profile_image = ? WHERE id = ?";
        return $this->db->execute($sql, [$imageName, $userId]);
    }
    
    /**
     * جلب صورة الملف الشخصي
     */
    public function getProfileImage($userId)
    {
        $sql = "SELECT profile_image FROM users WHERE id = ?";
        $result = $this->db->fetch($sql, [$userId]);
        return $result['profile_image'] ?? 'default.png';
    }
    
    /**
     * تغيير كلمة المرور
     */
    public function changePassword($userId, $currentPassword, $newPassword)
    {
        // جلب المستخدم
        $user = $this->find($userId);
        
        // التحقق من كلمة المرور الحالية
        if (!password_verify($currentPassword, $user['password'])) {
            throw new \Exception('كلمة المرور الحالية غير صحيحة');
        }
        
        // تشفير كلمة المرور الجديدة
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // تحديث كلمة المرور
        return $this->update($userId, ['password' => $hashedPassword]);
    }
    
    /**
     * جلب عدد المستخدمين
     */
    public function getUserCount()
    {
        return $this->count();
    }
    
    /**
     * جلب آخر المستخدمين المسجلين
     */
    public function getLatestUsers($limit = 5)
    {
        $sql = "SELECT id, username, email, profile_image, created_at 
                FROM users 
                ORDER BY created_at DESC 
                LIMIT ?";
        
        return $this->db->fetchAll($sql, [$limit]);
    }
}