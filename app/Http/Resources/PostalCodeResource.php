<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostalCodeResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $federal = (object)[];
        $federal->key = (int) $this->c_estado;
        $federal->name = $this->d_estado;
        $federal->code = $this->c_CP;
        $minicipality = (object)[];
        $minicipality->key = (int) ltrim($this->c_mnpio, '0');
        $minicipality->name = strtoupper($this->d_ciudad);

        return [
            'zip_code' => (int)$this->d_codigo,
            'locality' => $this->D_mnpio,
            'federal_entity' => $federal,
            'settlements' => $this->settlements->map(function ($settlement){
                $settlement_type = (object)[];
                $settlement_type->name = $settlement->d_tipo_asenta;
                return [
                    'key' => (int) ltrim($settlement->id_asenta_cpcons, '0'),
                    'name' => $settlement->d_asenta,
                    'zone_type' => $settlement->d_zona,
                    'settlement_type' => $settlement_type
                ];
            }),
            'municipality' => $minicipality

        ];
    }
}
