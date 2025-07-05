<?php

namespace App\Controllers;

use App\Models\PermissionGroupModel;
use App\Models\PermissionModel;

class Permissions extends BaseController
{
    public function index()
    {
        $groupModel = new PermissionGroupModel();
        $permissionModel = new PermissionModel();

        $groups = $groupModel->select('permission_groups.*, COUNT(permissions.id) as permissions_count')
                             ->join('permissions', 'permissions.group_id = permission_groups.id', 'left')
                             ->groupBy('permission_groups.id')
                             ->orderBy('permission_groups.display_order', 'ASC')
                             ->findAll();

        $active_group_id = $this->request->getGet('group_id') ?? ($groups[0]['id'] ?? 0);

        $permissions = [];
        if ($active_group_id) {
            $permissions = $permissionModel->where('group_id', $active_group_id)->findAll();
        }
        
        $active_group = null;
        if($active_group_id){
            $active_group = $groupModel->find($active_group_id);
        }

        // (جديد) حساب الإحصائيات
        $total_groups = count($groups);
        $total_permissions = $permissionModel->countAllResults(); // طريقة CodeIgniter لحساب كل السجلات

        $data = [
            'title'             => 'إدارة الصلاحيات والمجموعات',
            'groups'            => $groups,
            'permissions'       => $permissions,
            'active_group_id'   => $active_group_id,
            'active_group'      => $active_group,
            'total_groups'      => $total_groups,      // <-- متغير جديد
            'total_permissions' => $total_permissions, // <-- متغير جديد
        ];

        return view('permissions/index', $data);
    }

    // ===================================================================
    // دوال إدارة المجموعات
    // ===================================================================

    public function newGroup()
    {
        return view('permissions/groups/new_group_form');
    }

    public function createGroup()
    {
        $model = new PermissionGroupModel();
        if ($model->insert($this->request->getPost())) {
            return redirect()->to('permissions')->with('success', 'تمت إضافة المجموعة بنجاح.');
        }
        return redirect()->back()->withInput()->with('error', 'فشل إضافة المجموعة.');
    }

    public function editGroup($id)
    {
        $model = new PermissionGroupModel();
        $data['group'] = $model->find($id);
        return view('permissions/groups/edit_group_form', $data);
    }

    public function updateGroup()
    {
        $model = new PermissionGroupModel();
        $id = $this->request->getPost('id');
        if ($model->update($id, $this->request->getPost())) {
            return redirect()->to('permissions')->with('success', 'تم تحديث المجموعة بنجاح.');
        }
        return redirect()->back()->withInput()->with('error', 'فشل تحديث المجموعة.');
    }

    public function deleteGroup($id)
    {
        $model = new PermissionGroupModel();
        if ($model->delete($id)) {
            return redirect()->to('permissions')->with('success', 'تم حذف المجموعة بنجاح.');
        }
        return redirect()->to('permissions')->with('error', 'فشل حذف المجموعة.');
    }

    // ===================================================================
    // دوال إدارة الصلاحيات
    // ===================================================================

    public function newPermission($group_id)
    {
        $data['group_id'] = $group_id;
        return view('permissions/permissions/new_permission_form', $data);
    }

    public function createPermission()
    {
        $model = new PermissionModel();
        if ($model->insert($this->request->getPost())) {
            return redirect()->to('permissions?group_id=' . $this->request->getPost('group_id'))->with('success', 'تمت إضافة الصلاحية بنجاح.');
        }
        return redirect()->back()->withInput()->with('error', 'فشل إضافة الصلاحية.');
    }

    public function editPermission($id)
    {
        $model = new PermissionModel();
        $data['permission'] = $model->find($id);
        return view('permissions/permissions/edit_permission_form', $data);
    }

    public function updatePermission()
    {
        $model = new PermissionModel();
        $id = $this->request->getPost('id');
        if ($model->update($id, $this->request->getPost())) {
            return redirect()->to('permissions?group_id=' . $this->request->getPost('group_id'))->with('success', 'تم تحديث الصلاحية بنجاح.');
        }
        return redirect()->back()->withInput()->with('error', 'فشل تحديث الصلاحية.');
    }

    public function deletePermission($id)
    {
        $model = new PermissionModel();
        $permission = $model->find($id);
        if ($model->delete($id)) {
            return redirect()->to('permissions?group_id=' . $permission['group_id'])->with('success', 'تم حذف الصلاحية بنجاح.');
        }
        return redirect()->back()->with('error', 'فشل حذف الصلاحية.');
    }
    
}