<?php

namespace App\Models;

use CodeIgniter\Model;

class LookupOptionModel extends Model
{
    /**
     * اسم الجدول في قاعدة البيانات.
     * تم تعديله ليتطابق مع الاسم الذي اخترناه في ملف الهجرة.
     */
    protected $table            = 'lookup_options';

    /**
     * المفتاح الرئيسي للجدول.
     */
    protected $primaryKey       = 'id';

    /**
     * تحديد ما إذا كان المفتاح الرئيسي يزداد تلقائيًا.
     */
    protected $useAutoIncrement = true;

    /**
     * نوع البيانات التي سيتم إرجاعها (array, object, or class name).
     * 'array' هو خيار جيد ومناسب.
     */
    protected $returnType       = 'array';

    /**
     * تفعيل ميزة الحذف الناعم.
     * هذا يخبر الموديل بأن يقوم بتحديث حقل 'deleted_at' بدلاً من الحذف الفعلي.
     */
    protected $useSoftDeletes   = true;

    /**
     * هذا يضمن أن المدخلات يتم التحقق منها قبل حفظها (ميزة أمان).
     */
    protected $protectFields    = true;
    
    /**
     * قائمة الحقول المسموح بإدخالها أو تحديثها من خلال الموديل.
     * أي حقل غير موجود هنا سيتم تجاهله لحماية قاعدة البيانات.
     */
    protected $allowedFields    = [
        'group_key', 
        'option_key', 
        'option_value', 
        'custom_fields_schema', 
        'advanced_config',
        'display_order', 
        'color', 
        'bg_color'
    ];

    // =================================================================
    // إعدادات حقول الوقت (Timestamps)
    // =================================================================
    
    /**
     * تفعيل التحديث التلقائي لحقول الوقت (created_at, updated_at).
     */
    protected $useTimestamps = true;

    /**
     * اسم حقل تاريخ الإنشاء.
     */
    protected $createdField  = 'created_at';
    
    /**
     * اسم حقل تاريخ التحديث.
     */
    protected $updatedField  = 'updated_at';

    /**
     * اسم حقل تاريخ الحذف (للحذف الناعم).
     */
    protected $deletedField  = 'deleted_at';


    // (يمكن حذف بقية المتغيرات غير المستخدمة مثل Validation و Callbacks، 
    // ولكن لا بأس من تركها الآن فلن تؤثر على الأداء)
}