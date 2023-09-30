<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendukungResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_pendukung' => $this->nama_pendukung,
            'phone' => $this->phone,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'tps' => $this->tps,
            'point' => $this->point,
            'keterangan' => $this->keterangan,
            'wilayahs' => collect($this->wilayahs)->only([
                'id',
                'nama_wilayah',
            ]),
            'action' => '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit"
            onclick=\'editdata('.$this->id.')\'>Update</button>
        <button class="btn btn-danger" onclick=\'deletedata('.$this->id.')\'>Delete</button>'
        ];
    }
}
