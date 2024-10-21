<?php

namespace App\Http\Controllers;

use App\Exports\GlobalExcelExport;
use App\Models\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExportsController
{

    public function index($slug)
    {
        $export = ExcelExport::where('slug', $slug)->first();
        if ($export) {
            return Excel::download(new GlobalExcelExport($export), $slug.'.xlsx');


        }

        else {
            abort(404);
        }
    }

}
