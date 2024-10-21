<?php

use App\Http\Controllers\RolesAndPermissionsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users/roles','middleware' => ['auth','verified']],function (){
    Route::get('', [RolesAndPermissionsController::class, 'index_roles'])->name('roles.index');
    Route::get('getDT', [RolesAndPermissionsController::class, 'getDT_role'])->name('roles.DT');
    Route::get('formAdd', [RolesAndPermissionsController::class, 'form_add_role'])->name('roles.form-add');
    Route::get('get/{id}', [RolesAndPermissionsController::class, 'form_edit_role'])->name('roles.form-edit');
    Route::post('save', [RolesAndPermissionsController::class, 'save_role'])->name('roles.save');
    Route::post('update', [RolesAndPermissionsController::class, 'update_role'])->name('roles.update');
    Route::get('getPermissions/{id}', [RolesAndPermissionsController::class, 'getPermissions'])->name('roles.get-permissions');
    Route::get('delete/{id}', [RolesAndPermissionsController::class, 'delete_role'])->name('roles.delete');
    Route::post('update_permissions', [RolesAndPermissionsController::class, 'update_permissions'])->name('roles.update_permissions');
});

Route::group(['prefix' => 'users/permissions','middleware' => ['auth','verified']],function (){
    Route::get('', [RolesAndPermissionsController::class, 'index_permissions'])->name('permissions.index');
    Route::get('getDT', [RolesAndPermissionsController::class, 'getDT_permission'])->name('permissions.DT');
    Route::get('formAdd', [RolesAndPermissionsController::class, 'form_add_permission'])->name('permissions.form-add');
    Route::get('get/{id}', [RolesAndPermissionsController::class, 'form_edit_permission'])->name('permissions.form-edit');
    Route::post('save', [RolesAndPermissionsController::class, 'save_permission'])->name('permissions.save');
    Route::post('update', [RolesAndPermissionsController::class, 'update_permission'])->name('permissions.update');
    Route::get('delete/{id}', [RolesAndPermissionsController::class, 'delete_permission'])->name('permissions.delete');
});
