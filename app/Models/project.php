<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'projectid';
}
