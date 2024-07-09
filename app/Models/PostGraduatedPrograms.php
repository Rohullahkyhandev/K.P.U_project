<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGraduatedPrograms extends Model
{
    use HasFactory;

    // teacher
    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }
}
