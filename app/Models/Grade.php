<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $primaryKey = 'CodeGrade';
    protected $keyType = 'string';
    public $timestamps = false;
}
