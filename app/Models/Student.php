<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// app/Models/Student.php


class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'birth_place', 'birth_date'];


}




