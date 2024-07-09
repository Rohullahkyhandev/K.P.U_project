<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // teacher
    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }
}
