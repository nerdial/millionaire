<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    protected $fillable = [
        'title', 'is_correct'
    ];

    protected $visible = [
      'id' , 'title', 'is_correct'
    ];

    use HasFactory;
}
