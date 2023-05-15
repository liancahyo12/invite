<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pernikahan;

class pengaturan extends Model
{
    use HasFactory;
    protected $fillable = [
        'akad',
        'resepsi',
    ];

    public function pernikahan()
    {
        return $this->belongsTo(pernikahan::class);
    }
}
