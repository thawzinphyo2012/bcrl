<?php

namespace Database\Seeders;

use App\Models\Founder;
use App\Models\Group;
use App\Models\Member;
use App\Models\NewsPost;
use App\Models\Song;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = require __DIR__.'/catalog.php';
        $groupIds = [];

        foreach ($catalog['groups'] as $groupData) {
            $members = $groupData['members'];
            unset($groupData['members']);

            $group = Group::updateOrCreate(['slug' => $groupData['slug']], $groupData);
            $groupIds[$group->slug] = $group->id;

            foreach ($members as $index => [$name, $slug]) {
                $member = Member::firstOrNew(['slug' => $slug]);
                $member->group_id = $group->id;
                $member->name = $name;
                $member->sort_order = $index + 1;
                $member->save();
            }
        }

        foreach ($catalog['songs'] as $song) {
            $existing = Song::where('slug', $song['slug'])->first();
            $identity = [
                'group_id' => $groupIds[$song['group']],
                'title' => $song['title'],
                'listen_url' => $song['listen_url'],
                'is_highlight' => $song['is_highlight'],
                'highlight_position' => $song['highlight_position'],
                'sort_order' => $song['sort_order'],
            ];

            if ($existing) {
                $existing->update($identity);

                continue;
            }

            Song::create($identity + [
                'slug' => $song['slug'],
                'description' => $song['description'],
                'released_on' => $song['released_on'],
            ]);
        }

        foreach ($catalog['founders'] as $founder) {
            Founder::updateOrCreate(['name' => $founder['name']], $founder);
        }

        foreach ($catalog['news'] as $post) {
            NewsPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
