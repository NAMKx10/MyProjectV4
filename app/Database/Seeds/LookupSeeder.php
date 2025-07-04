<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LookupSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('lookup_options')->truncate();

        // في هذا الإصدار المصحح، كل مصفوفة تحتوي على نفس المفاتيح بالضبط.
        // الحقول التي ليس لها قيمة، تم وضع قيمتها null.
        $data = [
            // ====== المجموعة: أنواع العقارات ======
            ['group_key' => 'property_type', 'option_key' => 'property_type', 'option_value' => 'أنواع العقارات', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'property_type', 'option_key' => 'building', 'option_value' => 'عمارة سكنية', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'property_type', 'option_key' => 'commercial_center', 'option_value' => 'مركز تجاري', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'property_type', 'option_key' => 'villa', 'option_value' => 'فيلا', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'property_type', 'option_key' => 'land', 'option_value' => 'أرض', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],

            // ====== المجموعة: حالات العقار ======
            ['group_key' => 'property_status', 'option_key' => 'property_status', 'option_value' => 'حالات العقار', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'property_status', 'option_key' => 'active', 'option_value' => 'نشط', 'custom_fields_schema' => null, 'bg_color' => '#2fb344', 'color' => '#ffffff'],
            ['group_key' => 'property_status', 'option_key' => 'inactive', 'option_value' => 'غير نشط', 'custom_fields_schema' => null, 'bg_color' => '#d63939', 'color' => '#ffffff'],
            ['group_key' => 'property_status', 'option_key' => 'under_maintenance', 'option_value' => 'تحت الصيانة', 'custom_fields_schema' => null, 'bg_color' => '#f59f00', 'color' => '#ffffff'],

            // ====== المجموعة: أنواع الوحدات ======
            ['group_key' => 'unit_type', 'option_key' => 'unit_type', 'option_value' => 'أنواع الوحدات', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'unit_type', 'option_key' => 'apartment', 'option_value' => 'شقة', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'unit_type', 'option_key' => 'office', 'option_value' => 'مكتب', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'unit_type', 'option_key' => 'shop', 'option_value' => 'محل تجاري', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'unit_type', 'option_key' => 'warehouse', 'option_value' => 'مستودع', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],

            // ====== المجموعة: حالات الوحدة ======
            ['group_key' => 'unit_status', 'option_key' => 'unit_status', 'option_value' => 'حالات الوحدة', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'unit_status', 'option_key' => 'available', 'option_value' => 'متاحة', 'custom_fields_schema' => null, 'bg_color' => '#2fb344', 'color' => '#ffffff'],
            ['group_key' => 'unit_status', 'option_key' => 'rented', 'option_value' => 'مؤجرة', 'custom_fields_schema' => null, 'bg_color' => '#d63939', 'color' => '#ffffff'],
            ['group_key' => 'unit_status', 'option_key' => 'reserved', 'option_value' => 'محجوزة', 'custom_fields_schema' => null, 'bg_color' => '#f59f00', 'color' => '#ffffff'],

            // ====== المجموعة: حالات العقد ======
            ['group_key' => 'contract_status', 'option_key' => 'contract_status', 'option_value' => 'حالات العقد', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'contract_status', 'option_key' => 'active', 'option_value' => 'ساري', 'custom_fields_schema' => null, 'bg_color' => '#2fb344', 'color' => '#ffffff'],
            ['group_key' => 'contract_status', 'option_key' => 'expired', 'option_value' => 'منتهي', 'custom_fields_schema' => null, 'bg_color' => '#d63939', 'color' => '#ffffff'],
            ['group_key' => 'contract_status', 'option_key' => 'draft', 'option_value' => 'مسودة', 'custom_fields_schema' => null, 'bg_color' => '#6c757d', 'color' => '#ffffff'],

            // ====== المجموعة: أنواع الوثائق (مع حقول مخصصة) ======
            ['group_key' => 'document_type', 'option_key' => 'document_type', 'option_value' => 'أنواع الوثائق', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            [
                'group_key' => 'document_type', 'option_key' => 'deed', 'option_value' => 'صك ملكية',
                'custom_fields_schema' => json_encode([
                    ['label' => 'رقم الصك', 'name' => 'deed_number', 'type' => 'text', 'required' => true],
                    ['label' => 'تاريخ الصك', 'name' => 'deed_date', 'type' => 'date', 'required' => true]
                ]), 'bg_color' => null, 'color' => null
            ],
            [
                'group_key' => 'document_type', 'option_key' => 'building_license', 'option_value' => 'رخصة بناء',
                'custom_fields_schema' => json_encode([
                    ['label' => 'رقم الرخصة', 'name' => 'license_number', 'type' => 'text', 'required' => true],
                    ['label' => 'تاريخ الإصدار', 'name' => 'issue_date', 'type' => 'date', 'required' => true]
                ]), 'bg_color' => null, 'color' => null
            ],
            ['group_key' => 'document_type', 'option_key' => 'owner_id', 'option_value' => 'هوية المالك', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'document_type', 'option_key' => 'other', 'option_value' => 'أخرى', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            
            // ====== المجموعة: أنواع الكيانات (للربط) ======
            ['group_key' => 'entity_type', 'option_key' => 'entity_type', 'option_value' => 'أنواع الكيانات', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'entity_type', 'option_key' => 'properties', 'option_value' => 'عقار', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'entity_type', 'option_key' => 'owners', 'option_value' => 'مالك', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'entity_type', 'option_key' => 'clients', 'option_value' => 'عميل', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'entity_type', 'option_key' => 'units', 'option_value' => 'وحدة', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            
            // ====== المجموعة: أنواع الملاك ======
            ['group_key' => 'owner_type', 'option_key' => 'owner_type', 'option_value' => 'أنواع الملاك', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'owner_type', 'option_key' => 'individual', 'option_value' => 'فرد', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'owner_type', 'option_key' => 'company', 'option_value' => 'شركة', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],

            // ====== المجموعة: أنواع العملاء ======
            ['group_key' => 'client_type', 'option_key' => 'client_type', 'option_value' => 'أنواع العملاء', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'client_type', 'option_key' => 'individual', 'option_value' => 'فرد', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'client_type', 'option_key' => 'company', 'option_value' => 'شركة', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],

            // ====== المجموعة: دورات السداد ======
            ['group_key' => 'payment_cycle', 'option_key' => 'payment_cycle', 'option_value' => 'دورات السداد', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'payment_cycle', 'option_key' => 'monthly', 'option_value' => 'شهري', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'payment_cycle', 'option_key' => 'quarterly', 'option_value' => 'ربع سنوي', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'payment_cycle', 'option_key' => 'semi_annually', 'option_value' => 'نصف سنوي', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'payment_cycle', 'option_key' => 'annually', 'option_value' => 'سنوي', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
            ['group_key' => 'payment_cycle', 'option_key' => 'single_payment', 'option_value' => 'دفعة واحدة', 'custom_fields_schema' => null, 'bg_color' => null, 'color' => null],
        ];

        // في الإصدار المصحح، قمنا بتوحيد الحقول، لذلك حذفنا بعض الحقول التي لم تعد موجودة في الهجرة
        $filteredData = [];
        foreach ($data as $row) {
            $filteredData[] = [
                'group_key' => $row['group_key'],
                'option_key' => $row['option_key'],
                'option_value' => $row['option_value'],
                'custom_fields_schema' => $row['custom_fields_schema'],
                'bg_color' => $row['bg_color'],
                'color' => $row['color'],
            ];
        }

        $this->db->table('lookup_options')->insertBatch($filteredData);

        echo "Lookup options seeded successfully.\n";
    }
}