<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    protected $fillable = ['url', 'status', 'created_at', 'updated_at'];
}
