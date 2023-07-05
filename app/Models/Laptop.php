<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $table = "laptop";

    protected $fillable = [
        'code',
        'brand',
    ];



    protected $attributes = [
        'status' => "available",
    ];

}
