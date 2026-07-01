<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\PortfolioItem;
use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_all_public_pages_return_successful_response(): void
    {
        foreach (['/', '/about', '/services', '/team', '/portfolio', '/contact'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_home_page_shows_about_content(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('ABOUT');
        $response->assertSee('Operational Edge');
        $response->assertSee('Founded in 2008');
    }

    public function test_team_page_shows_grouped_members(): void
    {
        $response = $this->get('/team');

        $response->assertOk();
        $response->assertSee(TeamMember::first()->name);
        $response->assertSee('Direction');
    }

    public function test_portfolio_page_shows_seeded_items(): void
    {
        $response = $this->get('/portfolio');

        $response->assertOk();
        $response->assertSee(PortfolioItem::first()->title);
    }

    public function test_services_page_shows_pipeline(): void
    {
        $response = $this->get('/services');

        $response->assertOk();
        $response->assertSee('THE EXECUTION PIPELINE');
        $response->assertSee('The Minds Behind the Lens');
    }

    public function test_contact_form_persists_submission(): void
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'Jane Producer',
            'email' => 'jane@example.com',
            'message' => 'We need a commercial shoot in Colombo next month.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'Jane Producer',
            'email' => 'jane@example.com',
        ]);

        $this->assertEquals(1, ContactSubmission::count());
    }

    public function test_contact_form_validation_rejects_invalid_input(): void
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('contact_submissions', 0);
    }

    public function test_unpublished_team_members_are_hidden(): void
    {
        TeamMember::query()->update(['is_published' => false]);

        $response = $this->get('/team');

        $response->assertOk();
        $response->assertDontSee('Priyantha Kaluarachchi');
    }
}
