<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;

    protected $table = 'pimpinan';
    protected $guarded = ['id_pimpinan'];

    protected $primaryKey = 'id_pimpinan';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
