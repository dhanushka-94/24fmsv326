<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\PortfolioItem;
use App\Models\TeamMember;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', $this->shared());
    }

    public function about(): View
    {
        return view('pages.about', array_merge($this->shared(), [
            'aboutCopy' => config('frames.about', []),
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
        $departmentLabels = config('frames.team.departments', []);
        $departmentOrder = array_keys($departmentLabels);

        $teamByDepartment = $teamMembers
            ->groupBy('department')
            ->sortKeysUsing(function (string $a, string $b) use ($departmentOrder): int {
                $posA = array_search($a, $departmentOrder, true);
                $posB = array_search($b, $departmentOrder, true);

                if ($posA === false && $posB === false) {
                    return strcmp($a, $b);
                }

                if ($posA === false) {
                    return 1;
                }

                if ($posB === false) {
                    return -1;
                }

                return $posA <=> $posB;
            });

        return view('pages.team', array_merge($this->shared(), [
            'teamMembers' => $teamMembers,
            'teamByDepartment' => $teamByDepartment,
            'departmentLabels' => $departmentLabels,
        ]));
    }

    public function portfolio(): View
    {
        $portfolio = PortfolioItem::published()->orderBy('sort_order')->get();
        $featured = PortfolioItem::query()
            ->where('is_published', true)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->first();
        $gridItems = $featured
            ? $portfolio->where('id', '!=', $featured->id)->values()
            : $portfolio;

        return view('pages.portfolio', array_merge($this->shared(), [
            'portfolio' => $gridItems,
            'featuredPortfolio' => $featured,
        ]));
    }

    public function contact(): View
    {
        return view('pages.contact', $this->shared());
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
