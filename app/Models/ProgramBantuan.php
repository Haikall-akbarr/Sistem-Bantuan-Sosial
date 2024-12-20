<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    use HasFactory;

    protected $table = 'program_bantuan';
    protected $fillable = ['nama_program', 'deskripsi'];

    public function distribusi()
    {
    return $this->hasMany(Distribusi::class);
    }

}

