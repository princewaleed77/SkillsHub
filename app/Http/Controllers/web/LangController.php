<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function set($lang, Request $request)
    {
        if (! in_array($lang, ['en', 'ar'])) {
            $lang = 'en';
        }
        $request->session()->put('lang',$lang);
        return back();
    }
}
