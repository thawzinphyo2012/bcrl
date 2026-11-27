<?php

namespace Tests\Feature;

use App\Models\AuditionApplication;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_home_page_introduces_the_label(): void
    {
        $this->seed();

        $this->get('/')
            ->assertOk()
            ->assertSee('We create more than music.')
            ->assertSee("Let's get started")
            ->assertSee('FrezZon')
            ->assertSee('Create with Passion. Big Potential with Big Cheese.');
    }

    public function test_a_visitor_can_register_and_open_the_dashboard(): void
    {
        $this->seed();

        $this->post('/register', [
            'name' => 'Aye Aye',
            'email' => 'aye@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();

        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('Aye Aye');
    }

    public function test_an_artist_page_lists_members_and_songs(): void
    {
        $this->seed();

        $this->get('/artists/frezzon')
            ->assertOk()
            ->assertSee('Joshua')
            ->assertSee('Fashion')
            ->assertSee('Fresh Youth Energy');
    }

    public function test_a_visitor_can_apply_for_an_audition(): void
    {
        $this->seed();

        $response = $this->post('/auditions/apply', [
            'full_name' => 'Hla Hla',
            'age' => 19,
            'city' => 'Yangon',
            'contact' => '@hlahla',
            'email' => 'hla@example.com',
            'interest' => 'singing',
            'experience' => 'some',
            'why' => 'I want to grow as a singer and learn with other people who care about music.',
            'consent' => '1',
        ]);

        $response->assertRedirect(route('auditions.apply'));
        $this->assertDatabaseHas('audition_applications', [
            'full_name' => 'Hla Hla',
            'city' => 'Yangon',
        ]);
        $this->assertSame(1, AuditionApplication::count());
    }

    public function test_the_admin_panel_requires_a_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_the_admin_user_can_open_the_dashboard(): void
    {
        $this->seed();
        $user = User::where('email', 'studio@bcrl.local')->firstOrFail();

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Admin dashboard');
    }

    public function test_the_admin_user_can_create_a_group(): void
    {
        $this->seed();
        $user = User::where('email', 'studio@bcrl.local')->firstOrFail();

        $this->actingAs($user)
            ->post('/admin/groups', [
                'name' => 'Test Group',
                'concept' => 'Trial Concept',
                'genre' => 'Pop',
                'summary' => 'A temporary group used only for testing the admin panel.',
                'accent' => '#112233',
                'accent_ink' => '#e2a322',
                'telegram_url' => 'https://t.me/BCRL_OFFICIAL',
                'sort_order' => 9,
            ])
            ->assertRedirect(route('admin.groups.index'));

        $this->assertDatabaseHas('groups', ['slug' => 'test-group', 'name' => 'Test Group']);
        $this->assertNotNull(Group::where('slug', 'test-group')->first());
    }
}
