<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionGroupModel extends Model
{
    /**
     * اسم الجدول في قاعدة البيانات.
     */
    protected $table            = 'permission_groups';

    /**
     * المفتاح الرئيسي للجدول.
     */
    protected $primaryKey       = 'id';

    /**
     * نوع البيانات التي سيتم إرجاعها.
     */
    protected $returnType       = 'array';

    /**
     * تفعيل ميزة الحذف الناعم.
     */
    protected $useSoftDeletes   = true;

    /**
     * قائمة الحقول المسموح بإدخالها أو تحديثها.
     */
    protected $allowedFields    = [
        'group_name',
        'group_key',
        'description',
        'display_order'
    ];

    // إعدادات حقول الوقت (Timestamps)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}