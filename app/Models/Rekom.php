<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekom extends Model
{
    use HasFactory;

    protected $table = 'rekom';
    protected $primaryKey = 'id_rekom';
    protected $guarded = ['id_rekom'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function pimpinan()
    {
        return $this->belongsTo(Pimpinan::class, 'id_pimpinan');
    }
}
