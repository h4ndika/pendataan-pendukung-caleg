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
            'wilayah' => collect($this->wilayahs)->only([
                'id',
                'nama_wilayah',
            ]),
        ];
    }
}
