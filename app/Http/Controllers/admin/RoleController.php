<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;


class RoleController extends Controller
{
    //
    public function addRole(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:25',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if($validator->passes()){
           $role = new Role();
           $role->name = $request->name;
           $role->save();

           if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }

            return redirect()->route('admin.dashboard')->with('success', 'New role added successfully!');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'permissions' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        // Update permissions
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Role updated successfully!');
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);

        // Delete the role
        $role->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Role deleted successfully!');
    }

}
