<?php

namespace App\Models;

use App\Models\CategoryType;
use App\Models\CategoryValue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'priority', 'assembly_id', 'category_type_id'];

    public function category_type() {
        return $this->belongsTo('App\Models\CategoryType');
    }

    public function category_values() {
        return $this->hasMany('App\Models\CategoryValue');
    }

}
