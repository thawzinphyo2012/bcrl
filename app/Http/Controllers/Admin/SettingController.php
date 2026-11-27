<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $socials = Setting::getValue('socials', config('bcrl.socials'));
        $services = Setting::getValue('services', config('bcrl.services'));
        $faq = Setting::getValue('faq', config('bcrl.faq'));

        return view('admin.settings.edit', [
            'motto' => Setting::getValue('motto', config('bcrl.motto')),
            'explore_url' => Setting::getValue('explore_url', config('bcrl.explore_url')),
            'telegram_url' => Setting::getValue('telegram_url', config('bcrl.telegram_url')),
            'socials' => is_array($socials) ? $socials : config('bcrl.socials'),
            'services' => is_array($services) ? $services : config('bcrl.services'),
            'faq' => is_array($faq) ? $faq : config('bcrl.faq'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'motto' => ['required', 'string', 'max:255'],
            'explore_url' => ['required', 'url', 'max:255'],
            'telegram_url' => ['required', 'url', 'max:255'],
            'socials' => ['required', 'array'],
            'socials.*.label' => ['required', 'string', 'max:40'],
            'socials.*.url' => ['nullable', 'url', 'max:255'],
            'services' => ['required', 'array'],
            'services.*.title' => ['required', 'string', 'max:120'],
            'services.*.text' => ['required', 'string', 'max:500'],
            'faq' => ['required', 'array'],
            'faq.*.en_q' => ['required', 'string', 'max:255'],
            'faq.*.en_a' => ['required', 'string', 'max:2000'],
            'faq.*.my_q' => ['required', 'string', 'max:255'],
            'faq.*.my_a' => ['required', 'string', 'max:2000'],
        ]);

        $socials = collect($data['socials'])
            ->map(fn (array $item) => [
                'label' => $item['label'],
                'url' => $item['url'] ?: null,
            ])
            ->values()
            ->all();

        Setting::putValue('motto', $data['motto']);
        Setting::putValue('explore_url', $data['explore_url']);
        Setting::putValue('telegram_url', $data['telegram_url']);
        Setting::putValue('socials', $socials);
        Setting::putValue('services', $data['services']);
        Setting::putValue('faq', array_values($data['faq']));

        return back()->with('status', 'Site settings saved.');
    }
}
