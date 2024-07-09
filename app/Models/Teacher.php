<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;


    // faculty
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    // department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // post programs
    public function post_graduated_program()
    {
        return $this->belongsTo(PostGraduatedPrograms::class, 'program_id');
    }

    // promotins
    public function teacher_promotion()
    {
        return $this->hasMany(Promotion::class, 'teacher_id');
    }

    // user relation ship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
