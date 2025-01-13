<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\DashboardController;



Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::group(['prefix' => 'admin'], function(){

    // Guest Middleware
    Route::group(['middleware' => 'admin.guest'], function() {
        Route::get('login',[LoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');
    });

    // Auth Middleware
    Route::group(['middleware' => 'admin.auth'], function() {
        Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

        Route::group(['prefix'=>'superadmin'], function(){
            Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
            Route::post('role/add',[RoleController::class,'addRole'])->name('admin.addRole');
            Route::post('role/update/{id}', [RoleController::class, 'updateRole'])->name('admin.updateRole');
            Route::delete('role/delete/{id}', [RoleController::class, 'deleteRole'])->name('admin.deleteRole');
            Route::post('user/add', [LoginController::class, 'addUser'])->name('admin.addUser');
            Route::put('user/update/{id}', [LoginController::class, 'updateUser'])->name('admin.updateUser');
            Route::delete('user/delete/{id}', [LoginController::class, 'deleteUser'])->name('admin.deleteUser');
        });
        Route::get('admin/dashboard', [DashboardController::class, 'otherDashboard'])->name('other.dashboard');
        Route::post('post/add', [PostController::class, 'addPost'])->name('admin.addPost');
        Route::put('post/update/{id}', [PostController::class, 'updatePost'])->name('admin.updatePost');
        Route::delete('post/delete/{id}', [PostController::class, 'deletePost'])->name('admin.deletePost');
        Route::put('post/publish/{id}', [PostController::class, 'publishPost'])->name('admin.publishPost');
        Route::put('/post/toggle-status/{id}', [PostController::class, 'toggleStatus'])->name('post.toggleStatus');



    });
});

Route::get('/home/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/home/posts/{id}', [PostController::class, 'show'])->name('posts.show');






