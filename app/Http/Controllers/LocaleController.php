<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $locale = $request->validate([
            'locale' => ['required', 'in:'.implode(',', SetLocale::LOCALES)],
        ])['locale'];

        return back()->withCookie(cookie('bcrl_locale', $locale, 60 * 24 * 365));
    }
}
