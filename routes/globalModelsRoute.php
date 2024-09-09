<?php

use App\Http\Controllers\GlobaleModelsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'globals/', 'middleware' => ['auth', 'verified']], function () {
    Route::get('', [GlobaleModelsController::class, 'index'])->name('globals.index');
    Route::get('getDT', [GlobaleModelsController::class, 'getDT'])->name('globals.dt');
    Route::get('formAdd', [GlobaleModelsController::class, 'formAdd'])->name('globals.form-add');
    Route::get('get/{id}', [GlobaleModelsController::class, 'formEdit'])->name('globals.form-edit');
    Route::post('save', [GlobaleModelsController::class, 'save'])->name('globals.save');
    Route::post('update', [GlobaleModelsController::class, 'update'])->name('globals.update');
    Route::get('delete/{id}', [GlobaleModelsController::class, 'delete'])->name('globals.delete');

    Route::get('{model_id}', [GlobaleModelsController::class, 'indexObjects'])->name('objects.index');
    Route::get('object/getDT/{model_id}', [GlobaleModelsController::class, 'getDTObject'])->name('objects.DT');
    Route::get('formAdd/{model_id}', [GlobaleModelsController::class, 'formAddObject'])->name('objects.form-add');
    Route::get('object/get/{model_id}/{id}', [GlobaleModelsController::class, 'formEditObject'])->name('objects.form-edit');
    Route::post('object/save', [GlobaleModelsController::class, 'saveObject'])->name('objects.save');
    Route::post('object/update', [GlobaleModelsController::class, 'updateObject'])->name('objects.update');
    Route::get('object/delete/{model_id}/{id}', [GlobaleModelsController::class, 'deleteObject'])->name('objects.delete');
});

