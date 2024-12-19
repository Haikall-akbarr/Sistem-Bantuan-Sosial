<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;

    protected $table = 'distribusi';

    public function penerima()
{
    return $this->belongsTo(Penerima::class);
}

public function programBantuan()
{
    return $this->belongsTo(ProgramBantuan::class);
}

}


