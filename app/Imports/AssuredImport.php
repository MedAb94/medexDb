<?php

namespace App\Imports;

use App\Models\Assured;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class AssuredImport implements ToCollection
{
    //pass the client_id to the constructor
    public function __construct($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            if (!isset($row[2])) {
                continue;
            }
            $instance = new \App\Models\reception\Assured();

            $instance->client_id = $this->client_id;
            $instance->matricule = $row[2];
            $instance->name = $row[6] . ' ' . $row[7];
            $instance->birthdate = $row[8];
            $instance->relation = $row[9];
            $instance->identification = $row[17];
            $instance->insurance_start_date = $row[11];
            $instance->insurance_end_date = $row[12];

            $instance->save();
        }
    }
}
