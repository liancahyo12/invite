<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pernikahan;

class komentar extends Model
{
    use HasFactory;
    protected $fillable = [
        'pernikahan_id',
        'nama',
        'komentar',
        'kehadiran',
    ];

    public function pernikahan()
    {
        return $this->belongsTo(pernikahan::class);
    }
}
