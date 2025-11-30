<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'foto',
        'foto_selesai',
        'status',
        'tanggapan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
