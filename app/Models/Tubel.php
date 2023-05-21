<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tubel extends Model
{
    use HasFactory;

    protected $table = 'tubel';
    protected $guarded = ['id_tubel'];
    protected $primaryKey = 'id_tubel';

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
