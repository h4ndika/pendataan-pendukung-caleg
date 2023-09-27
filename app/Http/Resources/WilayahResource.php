<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WilayahResource extends JsonResource
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
            'nama_wilayah' => $this->nama_wilayah,
            'anggota' => collect($this->anggotas)->only([
                'id',
                'name',
                'email',
                'phone',
            ]),
        ];
    }
}
