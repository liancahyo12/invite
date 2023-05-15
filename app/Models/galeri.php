<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pernikahan;

class galeri extends Model
{
    use HasFactory;
    protected $fillable = [
        'pernikahan_id',
        'nama',
        'bank',
        'rekening',
    ];

    public function pernikahan()
    {
        return $this->belongsTo(pernikahan::class);
    }
}
