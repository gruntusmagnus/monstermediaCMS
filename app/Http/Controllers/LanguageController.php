<?php

namespace App\Http\Controllers;

use App\Language;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function saveLanguage($isoCode)
    {
        if (in_array($isoCode, \Config::get('translatable.locales'))) {
            Session::put('appLanguage', $isoCode);
            Cookie::queue(Cookie::forever('appLanguage', $isoCode));
            if (Auth::user()) {
                Auth::user()->language()->associate(Language::where('iso_code', $isoCode)->first())->save();
            }
            \App::setLocale($isoCode);
        }
        return redirect()->back();
    }

    public function setLanguage()
    {
        if (Session::has('appLanguage') && in_array(Session::get('appLanguage'), \Config::get('translatable.locales'))) {
            $localLang = Session::get('appLanguage');
        } else if (Auth::user()) {
            $localLang = (Auth::user()->language())->iso_code;
        } else if (Cookie::get('appLanguage')) {
            $localLang = Cookie::get('appLanguage');
        } else {
            $localLang = \Config::get('app.fallback_locale');
        }

        \App::setLocale($localLang);
        return redirect()->back();
    }

}
