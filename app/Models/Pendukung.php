<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendukung extends Model
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

    public function wilayahs()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id')->withTrashed();
    }
}
