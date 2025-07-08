<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // (جديد) نطلب من قاعدة البيانات تجاهل قيود الربط مؤقتًا
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // الآن يمكننا تفريغ الجداول بأمان
        $this->db->table('permissions')->truncate();
        $this->db->table('permission_groups')->truncate();

        // -------------------------------------------------
        // 1. تعريف وإضافة مجموعات الصلاحيات (نفس الكود السابق)
        // -------------------------------------------------
        $groups = [
            ['group_name' => 'إدارة العقارات', 'group_key' => 'properties', 'display_order' => 1],
            ['group_name' => 'إدارة الوحدات', 'group_key' => 'units', 'display_order' => 2],
            ['group_name' => 'إدارة الملاك', 'group_key' => 'owners', 'display_order' => 3],
            ['group_name' => 'إدارة العملاء', 'group_key' => 'clients', 'display_order' => 4],
            ['group_name' => 'إدارة الموردين', 'group_key' => 'suppliers', 'display_order' => 5],
            ['group_name' => 'إدارة العقود', 'group_key' => 'contracts', 'display_order' => 6],
            ['group_name' => 'إدارة الوثائق', 'group_key' => 'documents', 'display_order' => 7],
            ['group_name' => 'إدارة المستخدمين', 'group_key' => 'users', 'display_order' => 8],
            ['group_name' => 'إدارة الأدوار', 'group_key' => 'roles', 'display_order' => 9],
            ['group_name' => 'إدارة الإعدادات', 'group_key' => 'settings', 'display_order' => 10],
        ];
        $this->db->table('permission_groups')->insertBatch($groups);

        // -------------------------------------------------
        // 2. جلب المجموعات مع الـ IDs الجديدة الخاصة بها (نفس الكود السابق)
        // -------------------------------------------------
        $groupsFromDb = $this->db->table('permission_groups')->get()->getResultArray();
        $groupMap = array_column($groupsFromDb, 'id', 'group_key');

        // -------------------------------------------------
        // 3. تعريف وإضافة الصلاحيات الفردية (نفس الكود السابق)
        // -------------------------------------------------
        $permissions = [
            // العقارات
            ['group_id' => $groupMap['properties'], 'permission_key' => 'view_properties', 'description' => 'عرض العقارات'],
            ['group_id' => $groupMap['properties'], 'permission_key' => 'add_property', 'description' => 'إضافة عقار'],
            ['group_id' => $groupMap['properties'], 'permission_key' => 'edit_property', 'description' => 'تعديل عقار'],
            ['group_id' => $groupMap['properties'], 'permission_key' => 'delete_property', 'description' => 'حذف عقار'],
            
            // ... (بقية الصلاحيات كما هي) ...
            ['group_id' => $groupMap['units'], 'permission_key' => 'view_units', 'description' => 'عرض الوحدات'],
            ['group_id' => $groupMap['units'], 'permission_key' => 'add_unit', 'description' => 'إضافة وحدة'],
            ['group_id' => $groupMap['units'], 'permission_key' => 'edit_unit', 'description' => 'تعديل وحدة'],
            ['group_id' => $groupMap['units'], 'permission_key' => 'delete_unit', 'description' => 'حذف وحدة'],
            
            ['group_id' => $groupMap['owners'], 'permission_key' => 'view_owners', 'description' => 'عرض الملاك'],
            ['group_id' => $groupMap['owners'], 'permission_key' => 'add_owner', 'description' => 'إضافة مالك'],
            ['group_id' => $groupMap['owners'], 'permission_key' => 'edit_owner', 'description' => 'تعديل مالك'],
            ['group_id' => $groupMap['owners'], 'permission_key' => 'delete_owner', 'description' => 'حذف مالك'],

            ['group_id' => $groupMap['users'], 'permission_key' => 'view_users', 'description' => 'عرض المستخدمين'],
            ['group_id' => $groupMap['users'], 'permission_key' => 'add_user', 'description' => 'إضافة مستخدم'],
            ['group_id' => $groupMap['users'], 'permission_key' => 'edit_user', 'description' => 'تعديل مستخدم'],
            ['group_id' => $groupMap['users'], 'permission_key' => 'delete_user', 'description' => 'حذف مستخدم'],

            ['group_id' => $groupMap['roles'], 'permission_key' => 'view_roles', 'description' => 'عرض الأدوار'],
            ['group_id' => $groupMap['roles'], 'permission_key' => 'add_role', 'description' => 'إضافة دور'],
            ['group_id' => $groupMap['roles'], 'permission_key' => 'edit_role', 'description' => 'تعديل دور'],
            ['group_id' => $groupMap['roles'], 'permission_key' => 'delete_role', 'description' => 'حذف دور'],
            ['group_id' => $groupMap['roles'], 'permission_key' => 'edit_role_permissions', 'description' => 'تعديل صلاحيات الدور'],

            ['group_id' => $groupMap['settings'], 'permission_key' => 'manage_lookups', 'description' => 'إدارة تهيئة المدخلات'],
            ['group_id' => $groupMap['settings'], 'permission_key' => 'manage_general_settings', 'description' => 'إدارة الإعدادات العامة'],
        ];

        $this->db->table('permissions')->insertBatch($permissions);
        
        // (جديد) نعيد تفعيل قيود الربط مرة أخرى
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        echo "Permissions and groups seeded successfully.\n";
    }
}