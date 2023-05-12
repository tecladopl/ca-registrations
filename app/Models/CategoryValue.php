<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryValue extends Model
{
    use HasFactory;

    public $fillable = [
        'amount',
        'min',
        'max',
        'value',
        'category_id'
    ];
}
