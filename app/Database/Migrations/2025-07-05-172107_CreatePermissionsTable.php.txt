<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionsTable extends Migration
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
            // حقل لربط الصلاحية بالمجموعة التي تنتمي إليها
            'group_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            // المفتاح البرمجي الفريد للصلاحية (مثل: 'add_property')
            'permission_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            // الوصف الذي يظهر للمستخدم (مثل: 'القدرة على إضافة عقار جديد')
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // حقول Timestamps
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

        // (مهم) نحدد أن حقل 'group_id' هو مفتاح خارجي (Foreign Key)
        // يربط هذا الجدول بجدول 'permission_groups'
        $this->forge->addForeignKey('group_id', 'permission_groups', 'id', 'CASCADE', 'CASCADE');

        // نعطي الأمر النهائي لإنشاء الجدول
        $this->forge->createTable('permissions');
    }

    /**
     * الدالة التي تحذف الجدول (للتراجع).
     */
    public function down()
    {
        $this->forge->dropTable('permissions');
    }
}