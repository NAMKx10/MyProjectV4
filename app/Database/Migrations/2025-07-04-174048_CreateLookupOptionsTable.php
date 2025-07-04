<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLookupOptionsTable extends Migration
{
    /**
     * الدالة التي تنشئ الجدول.
     * يتم استدعاؤها عند تنفيذ أمر "php spark migrate".
     */
    public function up()
    {
        // نبدأ بتعريف حقول الجدول باستخدام $this->forge
        $this->forge->addField([
            // حقل المعرف الرئيسي (Primary Key)
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            // المفتاح الذي يجمع الخيارات (مثل 'property_types')
            'group_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            // المفتاح البرمجي للخيار (مثل 'apartment', 'villa')
            'option_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            // القيمة التي تظهر للمستخدم (مثل 'شقة', 'فيلا')
            'option_value' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            // حقل JSON لتخزين مخطط الحقول المخصصة
            'custom_fields_schema' => [
                'type' => 'TEXT',
                'null' => true, // يمكن أن يكون فارغًا
            ],

            'advanced_config' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            // حقل لترتيب العرض
            'display_order' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],
            // حقول الألوان للتخصيص
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'bg_color' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
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

        // نحدد أن حقل 'id' هو المفتاح الرئيسي (Primary Key)
        $this->forge->addKey('id', true);

        // نضيف "فهرس" على حقل group_key لتسريع عمليات البحث
        $this->forge->addKey('group_key');

        // الآن، نعطي الأمر النهائي لإنشاء الجدول بالاسم 'lookup_options'
        $this->forge->createTable('lookup_options');
    }

    /**
     * الدالة التي تحذف الجدول (للتراجع).
     * يتم استدعاؤها عند تنفيذ أمر "php spark migrate:rollback".
     */
    public function down()
    {
        // أمر بسيط لحذف الجدول بالكامل
        $this->forge->dropTable('lookup_options');
    }
}