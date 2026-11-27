<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Translation;
use App\Support\LangTree;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['en', 'my', 'zh'] as $locale) {
            $path = lang_path("{$locale}/site.php");

            if (! is_file($path)) {
                continue;
            }

            $lines = LangTree::flatten(require $path);

            foreach ($lines as $key => $value) {
                Translation::query()->updateOrCreate(
                    [
                        'locale' => $locale,
                        'group' => 'site',
                        'key' => $key,
                    ],
                    ['value' => $value],
                );
            }
        }

        Translation::clearCache();

        $defaults = [
            'motto' => config('bcrl.motto'),
            'explore_url' => config('bcrl.explore_url'),
            'telegram_url' => config('bcrl.telegram_url'),
            'socials' => config('bcrl.socials'),
            'services' => config('bcrl.services'),
            'faq' => config('bcrl.faq'),
        ];

        foreach ($defaults as $key => $value) {
            if (Setting::query()->where('key', $key)->exists()) {
                continue;
            }

            Setting::putValue($key, $value);
        }
    }
}
