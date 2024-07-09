<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $casts = [
        'attachment' => 'array',
        'attachment_path' => 'array'
    ];

    // teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id');
    }
}
