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
            'action' => '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit"
            onclick=\'editdata('.$this->id.')\'>Update</button>
        <button class="btn btn-danger" onclick=\'deletedata('.$this->id.')\'>Delete</button>'
        ];
    }
}
