<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = ['id_pegawai'];
    protected $primaryKey = 'id_pegawai';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tubel()
    {
        return $this->hasMany(Tubel::class, 'id_tubel');
    }
    public function rekom()
    {
        return $this->hasMany(Rekom::class, 'id_rekom');
    }
}
