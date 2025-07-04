<?php

namespace App\Controllers;

use App\Models\LookupOptionModel;

class Lookups extends BaseController
{
    /**
     * يعرض الصفحة الرئيسية لموديول تهيئة المدخلات
     */
    public function index()
    {
        $model = new LookupOptionModel();
        
        $options = $model->orderBy('group_key', 'ASC')->orderBy('display_order', 'ASC')->findAll();
        $grouped_options = [];
        foreach ($options as $option) {
            if ($option['group_key'] === $option['option_key']) {
                $grouped_options[$option['group_key']]['display_name'] = $option['option_value'];
                $grouped_options[$option['group_key']]['main_option'] = $option;
            } else {
                $grouped_options[$option['group_key']]['options'][] = $option;
            }
        }
        
        $active_group_key = $this->request->getGet('group') ?? array_key_first($grouped_options);

        $data = [
            'title'            => 'تهيئة مدخلات النظام',
            'grouped_options'  => $grouped_options,
            'active_group_key' => $active_group_key,
        ];

        return view('settings/lookups_index', $data);
    }

    // ===================================================================
    // دوال خاصة بإدارة المجموعات
    // ===================================================================

    /**
     * يعرض واجهة نموذج "إضافة مجموعة جديدة".
     */
    public function newGroup()
    {
        return view('settings/groups/new_group_form');
    }

    /**
     * يعالج بيانات نموذج "إضافة مجموعة جديدة" ويحفظها في قاعدة البيانات.
     */
    public function createGroup()
    {
        $data = [
            'group_key'    => $this->request->getPost('group_key'),
            'option_key'   => $this->request->getPost('group_key'),
            'option_value' => $this->request->getPost('option_value'),
        ];

        $model = new LookupOptionModel();
        if ($model->insert($data)) {
            return redirect()->to('lookups')->with('success', 'تمت إضافة المجموعة بنجاح.');
        } else {
            return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء إضافة المجموعة.');
        }
    }

    /**
     * (جديد) يعرض نموذج تعديل المجموعة مع بياناتها الحالية.
     */
    public function editGroup($group_key)
    {
        $model = new LookupOptionModel();
        
        // نبحث عن سجل المجموعة الرئيسي (حيث group_key و option_key متطابقان)
        $group_data = $model->where('group_key', $group_key)
                            ->where('option_key', $group_key)
                            ->first();

        if (!$group_data) {
            // في حالة عدم العثور على المجموعة، يمكنك عرض خطأ
            // لكن للتبسيط، سنعرض النموذج فارغًا
        }
        
        $data = ['group' => $group_data];
        
        return view('settings/groups/edit_group_form', $data);
    }

    /**
     * (جديد) يعالج بيانات نموذج "تعديل المجموعة" ويحدثها في قاعدة البيانات.
     */
    public function updateGroup()
    {
        $original_group_key = $this->request->getPost('original_group_key');
        $new_group_key      = $this->request->getPost('group_key');
        $new_option_value   = $this->request->getPost('option_value');
        
        $model = new LookupOptionModel();
        
        // نقوم بتحديث كل السجلات التي تنتمي للمجموعة القديمة إلى المفتاح الجديد
        if ($model->where('group_key', $original_group_key)
                  ->set(['group_key' => $new_group_key])
                  ->update()) 
        {
            // ثم نقوم بتحديث بيانات سجل المجموعة الرئيسي نفسه
            $model->where('option_key', $original_group_key)
                  ->where('group_key', $new_group_key) // نستخدم المفتاح الجديد هنا
                  ->set(['option_key' => $new_group_key, 'option_value' => $new_option_value])
                  ->update();

            return redirect()->to('lookups?group=' . $new_group_key)->with('success', 'تم تحديث المجموعة بنجاح.');
        } 
        else 
        {
            return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء تحديث المجموعة.');
        }
    }
}