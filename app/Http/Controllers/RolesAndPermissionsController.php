<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RolesAndPermissionsController extends Controller
{
    public function index_roles()
    {
        return view('pages.roles.index');
    }

    public function getDT_role()
    {
        $roles = Role::query()->orderByDesc('id');
        return DataTables::of($roles)
            ->addColumn('actions', function ($role) {
                return view('pages.roles.actions', ["role" => $role])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function form_add_role()
    {
        return view('pages.roles.add');
    }

    public function save_role()
    {
        request()->validate([
            'name' => 'required',
        ]);

        $role = Role::create(['name' => request('name'), 'description' => request('description')]);


        return response()->json($role->id);
    }

    public function form_edit_role($id)
    {
        $role = Role::find($id);
        return view('pages.roles.get', [
            'role' => $role,

        ]);
    }

    public function update_role()
    {
        request()->validate([
            'name' => 'required',
        ]);

        $role = Role::find(request('id'));
        $role->name = request('name');
        $role->description = request('description');
        $role->save();

        return response()->json($role->id);
    }

    public function update_permissions()
    {

        $role = Role::find(request('role_id'));
        $role->syncPermissions(request('permissions'));
        return response()->json("success");

    }

    public function getPermissions($role_id)
    {
        $role = Role::find($role_id);
        $role_permissions = $role->permissions()->pluck('name')->toArray();
        return view('pages.roles.permissions', [
            'role' => $role,
            'permissions' => Permission::all(),
            'role_permissions' => $role_permissions,
        ]);
    }

    public function delete_role()
    {
        $role = Role::find(request('id'));
        $role->permissions()->detach();
        $role->delete();

        return response()->json($role->id);
    }

    public function index_permissions()
    {
        return view('pages.permissions.index');
    }

    public function getDT_permission()
    {
        $permissions = Permission::query()->orderByDesc('id');
        return DataTables::of($permissions)
            ->addColumn('actions', function ($permission) {
                return view('pages.permissions.actions', ["permission" => $permission])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function form_add_permission()
    {
        return view('pages.permissions.add');
    }

    public function save_permission()
    {
        request()->validate([
            'name' => 'required',
        ]);

        $permission = Permission::create(['name' => request('name')]);


        return response()->json($permission->id);
    }

    public function form_edit_permission($id)
    {
        $permission = Permission::find($id);
        return view('pages.permissions.get', [
            'permission' => $permission,

        ]);
    }

    public function update_permission()
    {
        request()->validate([
            'name' => 'required',
        ]);

        $permission = Permission::find(request('id'));
        $permission->name = request('name');
        $permission->save();
        return response()->json($permission->id);
    }


    public function delete_permission()
    {
        $permission = Permission::find(request('id'));
        $permission->delete();
        return response()->json('success');
    }

}
