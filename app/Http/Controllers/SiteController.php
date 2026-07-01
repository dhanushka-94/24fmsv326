<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Director;
use App\Models\PortfolioItem;
use App\Models\TeamMember;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', array_merge($this->shared(), [
            'brands' => $this->clientNames(),
        ]));
    }

    public function about(): View
    {
        return view('pages.home', array_merge($this->shared(), [
            'brands' => $this->clientNames(),
        ]));
    }

    public function services(): View
    {
        return view('pages.services', array_merge($this->shared(), [
            'directors' => $this->directorCards(),
            'pipeline' => config('frames.pipeline', []),
        ]));
    }

    public function team(): View
    {
        $teamMembers = TeamMember::published()->get();

        return view('pages.team', array_merge($this->shared(), [
            'teamMembers' => $teamMembers,
            'teamByDepartment' => $teamMembers->groupBy('department'),
        ]));
    }

    public function portfolio(): View
    {
        return view('pages.portfolio', array_merge($this->shared(), [
            'portfolio' => PortfolioItem::published()->get(),
            'brands' => $this->clientNames(),
        ]));
    }

    public function contact(): View
    {
        return view('pages.contact', $this->shared());
    }

    /**
     * @return list<string>
     */
    private function clientNames(): array
    {
        $names = Client::published()->pluck('name')->all();

        return $names !== [] ? $names : config('frames.brands', []);
    }

    /**
     * @return list<array{name: string, photo: string|null}>
     */
    private function directorCards(): array
    {
        $directors = Director::published()->get()->map->toDisplayArray()->all();

        return $directors !== [] ? $directors : config('frames.directors', []);
    }

    /**
     * @return array<string, mixed>
     */
    private function shared(): array
    {
        return [
            'siteUrl' => config('frames.site_url'),
            'logo' => config('frames.logo'),
            'contact' => config('frames.contact'),
            'sampleImages' => config('frames.sample_images', []),
        ];
    }
}
