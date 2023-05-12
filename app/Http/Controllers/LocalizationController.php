<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localization as Localization;
use App\Exceptions\LocaleException;

class LocalizationController extends Controller {

    /**
     *
     *
     * @param string $locale
     */
    public static function setLocale(Request $request) {

//        $locales = Localization::all()->pluck('locale')->toArray();
//
//        if (!in_array($locale, $locales)) {
//            throw new LocaleException;
//        }

        $locale = $request->input('locale');
        session(['locale' => $locale]);

        app()->setLocale($locale);

        return redirect()->back();
    }

    public static function getLocale()
    {

    }


}