<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class LoginController extends Controller
{
    //this method will show admin login page
    public function index(){
        return view('admin.login');
    }

    // this method will Authenticate Admin User
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::guard('admin')->user();

                // Check if the user's role has the "superadmin" permission
                $hasSuperadminPermission = DB::table('role_permission')
                    ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
                    ->where('role_permission.role_id', $user->role_id)
                    ->where('permissions.name', 'superadmin')
                    ->exists();
                if (!$hasSuperadminPermission) {
                    // Auth::guard('admin')->logout();
                    // return redirect()->route('admin.login')->with('error', 'You are not authorized to access this page.');
                    return redirect()->route('other.dashboard');
                }
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login')->with('error','Either email or password is incorrect.');
            }
        } else {
            return redirect()->route('admin.login')->withInput()->withErrors($validator);
        }
    }

    // this methout logout admin user
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('posts.index');
    }

    public function addUser(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        if($validator->passes()){
           $user = new User();
           $user->name = $request->name;
           $user->email = $request->email;
           $user->password = Hash::make($request->password);
           $user->role_id = $request->role_id;
           $user->save();

           return redirect()->route('admin.dashboard')->with('success','User successfully created.');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if($validator->passes()){
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
    
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');
        } else {
            return redirect()->route('admin.dashboard')->withInput()->withErrors($validator);
        }

    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }


}
