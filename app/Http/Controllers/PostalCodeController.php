<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostalCodeResource;
use App\Imports\PostalCodeImport;
use App\Models\PostalCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PostalCodeController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import()
    {
        Excel::import(new PostalCodeImport,Storage::disk('public')->path('CPdescarga.xls'));

        return back();
    }

    public function getCodPostalInfo($cod){
        $codPostal = DB::table('postal_codes')->where('d_codigo', '=', $cod)
        ->select('d_codigo', 'D_mnpio', 'c_estado', 'd_estado', 'c_CP', 'c_mnpio', 'd_ciudad')
        ->first();
        if(is_null($codPostal)){
            abort(404);
        }
        $codPostal->settlements = DB::table('postal_codes')->where('d_codigo', '=', $cod)
            ->select('d_tipo_asenta', 'id_asenta_cpcons', 'd_asenta', 'd_zona')
            ->get();
        return new PostalCodeResource($codPostal);
    }
}
