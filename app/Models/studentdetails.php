<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentdetails extends Model
{
    use HasFactory;
    protected $table='student_details';
    protected $fillable=[
            'name',
            'dob',
            'email',
            'course',
            'phnnbr'
    ];
}
