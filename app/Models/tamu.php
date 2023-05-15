<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pernikahan;

class tamu extends Model
{
    use HasFactory;
    protected $fillable = [
        'pernikahan_id',
        'uuid',
        'nama',
        'alamat',
        'catatan',
    ];

    public function pernikahan()
    {
        return $this->belongsTo(pernikahan::class);
    }
}
