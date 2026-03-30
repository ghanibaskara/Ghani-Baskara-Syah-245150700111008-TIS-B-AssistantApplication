<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistantApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'student_id',
        'course_name',
        'gpa',
        'status'];
}
