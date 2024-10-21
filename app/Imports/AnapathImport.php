<?php

namespace App\Imports;

use App\Models\Assured;
use App\Models\hospitalisation\Patient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AnapathImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }


    public function collection(Collection $collection)
    {
        $counter = 0;
        foreach ($collection as $index => $row) {
            $service_id = $row[0];
            $anapath_id = $row[4];
             if ($anapath_id){
            \DB::beginTransaction();
            try {
               $service = \App\Models\hospitalisation\Service::find($service_id);
                $service->anapath_id = $anapath_id;
                $service->save();
                \DB::commit();
                $counter++;
            }
            catch (\Exception $e) {
                \DB::rollBack();
                dd($e->getTrace());
                continue;
            }
             }

        }
        dump("Count inserted : ".$counter);
    }
}
