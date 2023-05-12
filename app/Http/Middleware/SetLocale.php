<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\LocalizationController;

class SetLocale {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {

        if ($request->session()->has('locale') || session('locale')) {
            $language = session('locale');
            app()->setLocale($language);
        }else{
            session(['locale' => 'ge']);
        }
        return $next($request);
    }

}