<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionGroupsTable extends Migration
{
    /**
     * الدالة التي تنشئ الجدول.
     */
    public function up()
    {
        $this->forge->addField([
            // حقل المعرف الرئيسي (Primary Key)
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            // اسم المجموعة الذي يظهر للمستخدم
            'group_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            // المفتاح البرمجي للمجموعة (للاستخدام في الكود)
            'group_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            // الوصف (اختياري)
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // حقل لترتيب العرض
            'display_order' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],
            // حقول Timestamps التي ينشئها CodeIgniter تلقائيًا
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            // حقل الحذف الناعم
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // نحدد أن حقل 'id' هو المفتاح الرئيسي
        $this->forge->addKey('id', true);
        
        // نضيف فهرسًا على المفتاح البرمجي لتسريع البحث
        $this->forge->addKey('group_key');

        // نعطي الأمر النهائي لإنشاء الجدول
        $this->forge->createTable('permission_groups');
    }

    /**
     * الدالة التي تحذف الجدول (للتراجع).
     */
    public function down()
    {
        $this->forge->dropTable('permission_groups');
    }
}