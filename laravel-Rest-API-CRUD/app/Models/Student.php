<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    //extendemos el templade
    protected $table = 'students';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'grado'];
}
