<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wilayah extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function anggotas()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id')->withTrashed();
    }

    public function pendukungs()
    {
        return $this->hasMany(Pendukung::class, 'wilayah_id');
    }
}
