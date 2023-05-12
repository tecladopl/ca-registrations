<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Logs extends Model
{
    use HasFactory;

    public static function logEvent($event, $stack = ['app']){
        Log::stack($stack)->debug($event .' | IP: [ ' . $_SERVER['REMOTE_ADDR'] . ' ] USER_AGENT: [ ' . $_SERVER['HTTP_USER_AGENT'] . ' ]');
    }
}
