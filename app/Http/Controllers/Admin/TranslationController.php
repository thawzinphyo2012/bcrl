<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SetLocale;
use App\Models\Translation;
use App\Support\LangTree;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class TranslationController extends Controller
{
    public function index(Request $request): View
    {
        $locale = $request->string('locale')->toString();

        if (! in_array($locale, SetLocale::LOCALES, true)) {
            $locale = 'en';
        }

        $rows = Translation::query()
            ->where('locale', $locale)
            ->where('group', 'site')
            ->orderBy('key')
            ->get();

        if ($rows->isEmpty()) {
            $path = lang_path("{$locale}/site.php");
            $flat = is_file($path) ? LangTree::flatten(require $path) : [];

            foreach ($flat as $key => $value) {
                Translation::query()->updateOrCreate(
                    ['locale' => $locale, 'group' => 'site', 'key' => $key],
                    ['value' => $value],
                );
            }

            $rows = Translation::query()
                ->where('locale', $locale)
                ->where('group', 'site')
                ->orderBy('key')
                ->get();
        }

        $groups = $rows->groupBy(function (Translation $row) {
            return explode('.', $row->key)[0] ?? 'other';
        });

        return view('admin.translations.index', [
            'locale' => $locale,
            'locales' => SetLocale::LOCALES,
            'groups' => $groups,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => ['required', 'in:'.implode(',', SetLocale::LOCALES)],
            'translations' => ['required', 'array'],
            'translations.*' => ['nullable', 'string'],
        ]);

        foreach ($data['translations'] as $key => $value) {
            Translation::query()->updateOrCreate(
                [
                    'locale' => $data['locale'],
                    'group' => 'site',
                    'key' => $key,
                ],
                ['value' => $value ?? ''],
            );
        }

        Translation::clearCache($data['locale']);
        Cache::forget("translations.{$data['locale']}.site");

        return back()->with('status', strtoupper($data['locale']).' language text saved.');
    }
}
