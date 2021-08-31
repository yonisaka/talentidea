<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa';

    protected $fillable = [
        'subkategori_id',
        'mitra_id',
        'nama',
        'deskripsi',
        'rating',
    ];

    public function mitra(){
        return $this->belongsTo('App\Models\User', 'mitra_id', 'id');
    }

    public function paket(){
        return $this->hasMany('App\Models\Paket', 'jasa_id');
    }
}
