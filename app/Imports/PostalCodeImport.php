<?php

namespace App\Imports;

use App\Models\PostalCode;
use Maatwebsite\Excel\Concerns\ToModel;

class PostalCodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ini_set('max_execution_time', 0);
        if(array_key_exists('14', $row)){
            if('d_codigo' !== $row[0]){
                return new PostalCode([
                    'd_codigo' => $row[0],
                    'd_asenta' => $row[1],
                    'd_tipo_asenta' => $row[2],
                    'D_mnpio' => $row[3],
                    'd_estado' => $row[4],
                    'd_ciudad' => $row[5],
                    'd_CP' => $row[6],
                    'c_estado' => $row[7],
                    'c_oficina' => $row[8],
                    'c_CP' => $row[9],
                    'c_tipo_asenta' => $row[10],
                    'c_mnpio' => $row[11],
                    'id_asenta_cpcons' => $row[12],
                    'd_zona' => $row[13],
                    'c_cve_ciudad' => $row[14],
                ]);

            }
        }

    }
}
