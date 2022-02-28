<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SatuanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'satuan_jumlah_name'=> $this->satuan_jumlah_name,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,            
        ];
    }
}
