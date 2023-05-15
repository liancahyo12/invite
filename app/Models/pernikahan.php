<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Boilerplate\User;
use App\Models\rekening;
use App\Models\tamu;
use App\Models\pengaturan;
use App\Models\galeri;
use App\Models\komentar;

class pernikahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uuid',
        'nama_cowo',
        'nama_al_cowo',
        'nama_cewe',
        'nama_al_cewe',
        'nama_mak_cewe',
        'nama_pak_cewe',
        'nama_mak_cowo',
        'nama_pak_cowo',
        'alamat_akad',
        'alamat_resepsi',
        'map',
        'akad',
        'resepsi',
        'sambutan1',
        'sambutan2',
        'sambutan3',
        'sambutan4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rekening()
    {
        return $this->hasMany(rekening::class);
    }
    
    public function komentar()
    {
        return $this->hasMany(komentar::class);
    }

    public function galeri()
    {
        return $this->hasMany(galeri::class);
    }

    public function pengaturan()
    {
        return $this->hasOne(pengaturan::class);
    }

    
}
