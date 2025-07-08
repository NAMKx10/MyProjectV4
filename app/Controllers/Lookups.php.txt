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
    // دوال إدارة المجموعات
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
     * يعرض نموذج تعديل المجموعة مع بياناتها الحالية.
     */
    public function editGroup($group_key)
    {
        $model = new LookupOptionModel();
        $group_data = $model->where('group_key', $group_key)->where('option_key', $group_key)->first();
        if (!$group_data) { /* يمكنك إضافة معالجة للخطأ هنا */ }
        $data = ['group' => $group_data];
        return view('settings/groups/edit_group_form', $data);
    }

    /**
     * يعالج بيانات نموذج "تعديل المجموعة" ويحدثها في قاعدة البيانات.
     */
    public function updateGroup()
    {
        $original_group_key = $this->request->getPost('original_group_key');
        $new_group_key      = $this->request->getPost('group_key');
        $new_option_value   = $this->request->getPost('option_value');
        
        $model = new LookupOptionModel();
        
        if ($model->where('group_key', $original_group_key)->set(['group_key' => $new_group_key])->update()) {
            $model->where('option_key', $original_group_key)->where('group_key', $new_group_key)->set(['option_key' => $new_group_key, 'option_value' => $new_option_value])->update();
            return redirect()->to('lookups?group=' . $new_group_key)->with('success', 'تم تحديث المجموعة بنجاح.');
        } else {
            return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء تحديث المجموعة.');
        }
    }

    /**
     * (جديد) يحذف مجموعة بكل الخيارات التابعة لها.
     */
    public function deleteGroup($group_key)
    {
        $model = new LookupOptionModel();
        
        // الموديل سيقوم بالحذف الناعم تلقائيًا بفضل تفعيل useSoftDeletes
        if ($model->where('group_key', $group_key)->delete()) {
            return redirect()->to('lookups')->with('success', 'تم حذف المجموعة بنجاح.');
        } else {
            return redirect()->to('lookups')->with('error', 'حدث خطأ أثناء حذف المجموعة.');
        }
    }


    // ===================================================================
    // (جديد) دوال خاصة بإدارة الخيارات
    // ===================================================================

    /**
     * يعرض واجهة نموذج "إضافة خيار جديد".
     */
    public function newOption($group_key)
    {
        $data = ['group_key' => $group_key];
        return view('settings/options/new_option_form', $data);
    }

    /**
     * يعالج بيانات نموذج "إضافة خيار جديد" ويحفظها.
     */
    public function createOption()
    {
        $model = new LookupOptionModel();
        
        $data = [
            'group_key'    => $this->request->getPost('group_key'),
            'option_key'   => $this->request->getPost('option_key'),
            'option_value' => $this->request->getPost('option_value'),
            'bg_color'     => $this->request->getPost('bg_color'),
            'color'        => $this->request->getPost('color'),
        ];

        if ($model->insert($data)) {
            return redirect()->to('lookups?group=' . $data['group_key'])->with('success', 'تمت إضافة الخيار بنجاح.');
        } else {
            return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء إضافة الخيار.');
        }
    }

    /**
     * يعرض نموذج تعديل الخيار مع بياناته الحالية.
     */
    public function editOption($id)
    {
        $model = new LookupOptionModel();
        $option = $model->find($id);

        if (!$option) { /* يمكنك إضافة معالجة للخطأ هنا */ }
        
        $data = ['option' => $option];
        
        return view('settings/options/edit_option_form', $data);
    }

    /**
     * يعالج بيانات نموذج "تعديل الخيار" ويحدثها.
     */
    public function updateOption()
    {
        $model = new LookupOptionModel();
        $id = $this->request->getPost('id');
        
        $data = [
            'option_key'   => $this->request->getPost('option_key'),
            'option_value' => $this->request->getPost('option_value'),
            'bg_color'     => $this->request->getPost('bg_color'),
            'color'        => $this->request->getPost('color'),
            // لا ننسى إضافة الحقول المتقدمة هنا لاحقًا
        ];

        if ($model->update($id, $data)) {
            $group_key = $this->request->getPost('group_key');
            return redirect()->to('lookups?group=' . $group_key)->with('success', 'تم تحديث الخيار بنجاح.');
        } else {
            return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء تحديث الخيار.');
        }
    }
    
    /**
     * يحذف خيارًا محددًا (حذف ناعم).
     */
    public function deleteOption($id)
    {
        $model = new LookupOptionModel();
        
        // نحتاج لمعرفة المجموعة للعودة إليها بعد الحذف
        $option = $model->find($id);
        $group_key = $option['group_key'] ?? null;

        if ($model->delete($id)) {
            return redirect()->to('lookups?group=' . $group_key)->with('success', 'تم حذف الخيار بنجاح.');
        } else {
            return redirect()->to('lookups?group=' . $group_key)->with('error', 'حدث خطأ أثناء حذف الخيار.');
        }
    }
    


}