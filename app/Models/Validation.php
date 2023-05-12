<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Validation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['rule', 'message', 'attach'];

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function answers(){
        return $this->belongsToMany(Answer::class);
    }

}
