<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExcelExportsController;
use App\Http\Controllers\StandController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require_once 'auth.php';
require_once 'userRoutes.php';
require_once 'rolesAndPermissionsRoute.php';
require_once 'globalModelsRoute.php';


Route::group(['prefix' => '', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [ContactController::class, 'index'])->name('contacts');
    Route::get('/create/{id?}', [ContactController::class, 'create'])->name('contacts.create');
    Route::get('/data', [ContactController::class, 'dt'])->name('contacts.dt');
    Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
    Route::delete('/delete/{id}', [ContactController::class, 'delete'])->name('contacts.delete');
});

Route::group(['prefix' => 'stands', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [StandController::class, 'index'])->name('stands');
    Route::get('dt', [StandController::class, 'dt'])->name('stands.dt');
    Route::get('plan', [StandController::class, 'plan'])->name('stands.plan');
});

//error
Route::get('/error', function () {
    abort(500);
});

Route::get('/import_excel', function () {
echo 'importing' . '<br>';
    // matwabie excel import
    Excel::import(new class() implements Maatwebsite\Excel\Concerns\ToCollection {
        public function collection($rows)
        {
            foreach ($rows as $key => $row) {
                if ($key > 0 && $row[0] != '') {
                    $type = \App\Models\ContactType::where('name', $row[1])->first();
                    if (!$type) {
                        echo 'type not found ' . $row[1] . '<br>';
                        return;
                    }
                    $country = \App\Models\Country::where('name', $row[6])->first();
                    if (!$country) {
                        echo 'country not found' . $row[6];
                        return;
                    }
                    echo $row[0] . '<br>';
                    $phones = $row[3] ?? '';
                    $phone1 = '';
                    $phone2 = '';
                    $phone3 = '';

                    if (strpos($phones, '/') !== false) {
                        $phones = explode('/', $phones);
                        $phone1 = $phones[0];
                        $phone2 = $phones[1] ?? '';
                        $phone3 = $phones[2] ?? '';
                    }

                    if (strpos($row[4], '/') !== false) {
                        $row[4] = explode('/', $row[4])[0];
                    }


                    $contact = new \App\Models\Contact();
                    $contact->name = $row[0];
                    $contact->type_id = $type->id;
                    $contact->address = $row[2];
                    $contact->phone1 = $phone1;
                    $contact->phone2 = $phone2;
                    $contact->phone3 = $phone3;
                    $contact->email = $row[4];
                    $contact->website = $row[5];
                    $contact->country_id = $country->id;
                    $contact->save();
                }
            }
        }
    }, 'db.xlsx');

    return 'imported';
});


//export
Route::get('exports/{slug}', [ExcelExportsController::class, 'index'])->name('export');


require __DIR__ . '/auth.php';



