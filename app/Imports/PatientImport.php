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

class PatientImport implements ToCollection, WithChunkReading, WithStartRow, ShouldQueue
{
    //pass the client_id to the constructor

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Specify the chunk size for reading the file.
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    public function collection(Collection $collection)
    {
        $counter = 0;
        foreach ($collection as $index => $row) {
            $gender = $row[5];
            $first_name = $row[1];
            $last_name = $row[2];
            $phone = $row[4];
             if ($first_name){
            \DB::beginTransaction();
            try {
                Patient::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name??$first_name,
                    'phone' => $phone,
                    'gender_id' => $gender,
                    'birthday_year' =>  null,
                    'matricule' => Patient::generateUniqueMatricule()
                ]);
                \DB::commit();
                $counter++;
            }
            catch (\Exception $e) {
                \DB::rollBack();
                dd($e->getMessage());
                continue;
            }
             }

        }
        dump("Count inserted : ".$counter);
    }
}
