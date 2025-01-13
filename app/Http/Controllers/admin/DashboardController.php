<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    //
    // this method show dashboard page for admin user
    public function index(){
        $users = User::with('role.permissions')->get();
        $permissions = Permission::all();
        $roles = Role::with('permissions')->distinct()->get();
        return view('admin.dashboard',['users'=>$users,'permissions'=>$permissions,'roles'=>$roles]);
    }
    public function otherDashboard(){
        // $posts = Post::all();
        // return view('admin.other_dashboard',['posts'=>$posts]);


        $user = Auth::guard('admin')->user();
        $permissions = [];
    
        if ($user) {
            // Fetch all permissions for the user's role
            $userPermissions = DB::table('role_permission')
                ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
                ->where('role_permission.role_id', $user->role_id)
                ->pluck('permissions.name')
                ->toArray();
    
            // Map permissions to a flag array
            foreach ($userPermissions as $permission) {
                $permissions[$permission] = true;
            }
        }

        $posts = Post::all(); // Replace with your logic to fetch posts

        return view('admin.other_dashboard', compact('posts', 'permissions'));
    }
}
