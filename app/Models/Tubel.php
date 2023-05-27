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

    public function scopeFilter($query)
    {
        // dd(request('jenis_tubel'));
        if (request('jenis_tubel') ?? false) {
            $query->where('jenis_tubel', request('jenis_tubel'));
        }
        if (request('bulan') ?? false) {
            $query->whereMonth('tgl_mulai', request('bulan'));
        }
        if (request('tahun') ?? false) {
            $query->whereYear('tgl_mulai', request('tahun'));
        }

        return $query;
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}