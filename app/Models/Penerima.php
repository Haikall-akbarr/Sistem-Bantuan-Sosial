<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    protected $table = 'penerima';
    protected $fillable = ['nama', 'nik', 'alamat', 'no_hp'];


    public function distribusi()
    {
    return $this->hasMany(Distribusi::class);
    }

}

