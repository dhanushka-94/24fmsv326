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

    public function test_about_page_shows_content(): void
    {
        $response = $this->get('/about');

        $response->assertOk();
        $response->assertSee('Stories need');
        $response->assertSee('precision');
        $response->assertSee('deliver');
        $response->assertSee('About');
        $response->assertSee('Founded in 2008');
        $response->assertSee('absolute clarity under pressure');
        $response->assertSee('bespoke teams tailored');
        $response->assertSee('about-logo-24.png', false);
    }

    public function test_contact_page_shows_updated_address(): void
    {
        $response = $this->get('/contact');

        $response->assertOk();
        $response->assertSee('Get in touch');
        $response->assertSee('Office');
        $response->assertSee('24frames (PVT) LTD.');
        $response->assertSee('04 1/1, Park Circus, Park Road, Colombo 05, Sri Lanka');
        $response->assertSee('From initial planning to the final wrap');
        $response->assertSee('Olexto Digital Solutions');
    }

    public function test_site_footer_is_not_shown_on_public_pages(): void
    {
        foreach (['/', '/about', '/services', '/team', '/portfolio'] as $url) {
            $this->get($url)->assertOk()->assertDontSee('site-footer', false);
        }
    }

    public function test_home_page_shows_hero_content(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Trusted by over 1000+ industry leading brands');
        $response->assertSee('We Create');
        $response->assertSee('Ads.');
        $response->assertDontSee('Crafting Stories, Frame by Frame');
        $response->assertDontSee('Founded in 2008, 24 Frames is Sri Lanka');
    }

    public function test_client_carousel_appears_on_home_about_and_portfolio(): void
    {
        foreach (['/', '/about', '/portfolio'] as $url) {
            $this->get($url)->assertOk()->assertSee('aria-label="Our clients"', false);
        }
    }

    public function test_client_carousel_hidden_on_services_team_and_contact(): void
    {
        foreach (['/services', '/team', '/contact'] as $url) {
            $this->get($url)->assertOk()->assertDontSee('aria-label="Our clients"', false);
        }
    }

    public function test_team_page_shows_grouped_members(): void
    {
        $response = $this->get('/team');

        $response->assertOk();
        $response->assertSee(TeamMember::first()->name);
        $response->assertSee('Built by the');
        $response->assertSee('Precision.');
        $response->assertSee('DIRECTION');
        $response->assertSee('PRODUCTION &amp; OPERATIONS', false);
    }

    public function test_portfolio_page_shows_seeded_items(): void
    {
        $response = $this->get('/portfolio');

        $response->assertOk();
        $response->assertSee('Proven on the global stage');
        $response->assertSee('Our reel represents over two decades');
        $response->assertSee('Commercial Reel Highlights', false);
        $response->assertSee('Documentary Production', false);
        $response->assertSee('portfolio-hero-media', false);
        $response->assertSee('x-data="videoTheater()"', false);
    }

    public function test_portfolio_page_features_latest_item_and_opens_player_for_grid_items(): void
    {
        $latest = PortfolioItem::query()->create([
            'title' => 'Latest Featured Reel',
            'category' => 'Commercial',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'sort_order' => 999,
            'is_published' => true,
        ]);

        $gridItem = PortfolioItem::query()->create([
            'title' => 'Grid Player Reel',
            'category' => 'Film',
            'youtube_url' => 'https://youtu.be/9bZkp7q19f0',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->get('/portfolio');

        $response->assertOk();
        $response->assertSee('Latest Featured Reel', false);
        $response->assertSee('Grid Player Reel', false);
        $response->assertSee('dQw4w9WgXcQ', false);
        $response->assertSee('9bZkp7q19f0', false);
        $response->assertSee('portfolio-hero-media', false);
    }

    public function test_services_page_shows_pipeline(): void
    {
        $response = $this->get('/services');

        $response->assertOk();
        $response->assertSee('THE EXECUTION PIPELINE');
        $response->assertSee('THE MINDS BEHIND THE LENS');
        $response->assertSee('Shoot-ready.');
        $response->assertSee('AI-Driven Concepting &amp; Asset Generation:', false);
        $response->assertSee('services-pipeline-item-label', false);
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

    public function test_team_page_shows_uploaded_storage_photo(): void
    {
        $member = TeamMember::query()->published()->first();
        $member->update([
            'photo' => 'team/test-portrait.jpg',
            'department' => 'production',
            'is_published' => true,
        ]);

        $url = $member->fresh()->photoUrl();

        $this->assertNotNull($url);
        $this->assertStringContainsString('storage/team/test-portrait.jpg', $url);

        $this->get('/team')
            ->assertOk()
            ->assertSee($url, false);
    }
}
