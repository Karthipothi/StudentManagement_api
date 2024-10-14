<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacherdetails extends Model
{
    use HasFactory;
    protected $table='teacher_details';
    protected $fillable=[
            'name',
            'email',
            'course',
            'phnnbr'
    ];
}
