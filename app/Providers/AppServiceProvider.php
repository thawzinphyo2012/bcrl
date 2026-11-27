<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Translation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! $this->databaseReady()) {
            return;
        }

        $this->bootSettings();
        $this->bootTranslations();
    }

    protected function databaseReady(): bool
    {
        try {
            return Schema::hasTable('settings') && Schema::hasTable('translations');
        } catch (\Throwable) {
            return false;
        }
    }

    protected function bootSettings(): void
    {
        $motto = Setting::getValue('motto', config('bcrl.motto'));
        $explore = Setting::getValue('explore_url', config('bcrl.explore_url'));
        $telegram = Setting::getValue('telegram_url', config('bcrl.telegram_url'));
        $socials = Setting::getValue('socials', config('bcrl.socials'));
        $services = Setting::getValue('services', config('bcrl.services'));
        $faq = Setting::getValue('faq', config('bcrl.faq'));

        config([
            'bcrl.motto' => $motto,
            'bcrl.explore_url' => $explore,
            'bcrl.telegram_url' => $telegram,
            'bcrl.socials' => is_array($socials) ? $socials : config('bcrl.socials'),
            'bcrl.services' => is_array($services) ? $services : config('bcrl.services'),
            'bcrl.faq' => is_array($faq) ? $faq : config('bcrl.faq'),
        ]);
    }

    protected function bootTranslations(): void
    {
        foreach (['en', 'my', 'zh'] as $locale) {
            $lines = Cache::rememberForever("translations.{$locale}.site", function () use ($locale) {
                return Translation::query()
                    ->where('locale', $locale)
                    ->where('group', 'site')
                    ->pluck('value', 'key')
                    ->all();
            });

            if ($lines === []) {
                continue;
            }

            $prefixed = [];
            foreach ($lines as $key => $value) {
                $prefixed['site.'.$key] = $value;
            }

            app('translator')->addLines($prefixed, $locale);
        }
    }
}
