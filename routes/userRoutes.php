<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users/','middleware' => ['auth','verified']],function (){
    Route::get('', [UsersController::class, 'index'])->name('users.index');
    Route::get('getDT', [UsersController::class, 'getDT'])->name('users.DT');
    Route::get('formAdd', [UsersController::class, 'formAdd'])->name('users.form-add');
    Route::get('get/{id}', [UsersController::class, 'formEdit'])->name('users.form-edit');
    Route::post('save', [UsersController::class, 'save'])->name('users.save');
    Route::post('update', [UsersController::class, 'update'])->name('users.update');
    Route::get('delete/{id}', [UsersController::class, 'delete'])->name('users.delete');
    Route::get('testing', function (){
        // cretae 9 permissions in loop
//        for ($i=2;$i<=9;$i++){
//            $permission = \Spatie\Permission\Models\Permission::create(['name' => 'permission'.$i]);
//        }
    });
});

