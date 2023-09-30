<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnggotaResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'ketua' => collect($this->whenLoaded('ketuas'))->only([
                'id',
                'name',
                'email',
                'phone',
            ]),
            'wilayah' => new WilayahResource($this->whenLoaded('wilayahs')),
            'action' => '<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit"
            onclick=\'editdata('.$this->id.')\'>Update</button>
        <button class="btn btn-danger" onclick=\'deletedata('.$this->id.')\'>Delete</button>'
        ];
    }
}
