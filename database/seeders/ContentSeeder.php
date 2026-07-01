<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\Client;
use App\Models\Director;
use App\Models\PortfolioItem;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $team = [
            [
                'department' => 'direction',
                'role' => 'Film Director',
                'name' => 'Priyantha Kaluarachchi',
                'imdb' => 'https://www.imdb.com/name/nm7441944/',
                'photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&h=750&fit=crop&q=80',
                'bio' => 'Award-winning director with two decades of commercial and feature work across South Asia.',
            ],
            [
                'department' => 'production',
                'role' => 'Line Producer',
                'name' => 'Yudeesha Sathmini',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&h=750&fit=crop&q=80',
                'bio' => 'Leads budgets, schedules, and on-set logistics for local and international crews.',
            ],
            [
                'department' => 'production',
                'role' => 'Finance Manager',
                'name' => 'Nilmini Weerasinghe',
                'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&h=750&fit=crop&q=80',
                'bio' => 'Oversees production finance, reporting, and budget control across all scales of work.',
            ],
            [
                'department' => 'production',
                'role' => 'Agency Relations Manager',
                'name' => 'Malmi Tennakoon',
                'photo' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=600&h=750&fit=crop&q=80',
                'bio' => 'Builds trusted partnerships with agencies and brand stakeholders.',
            ],
            [
                'department' => 'production',
                'role' => 'Production Manager',
                'name' => 'Harsha Karunarathne',
                'imdb' => 'https://www.imdb.com/name/nm10108512/',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=600&h=750&fit=crop&q=80',
                'bio' => 'Experienced producer managing complex shoots from prep through wrap.',
            ],
            [
                'department' => 'production',
                'role' => 'Casting Directors',
                'name' => 'Nuwan Indrajith & Pasindu Dilmin',
                'photo' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=600&h=750&fit=crop&q=80',
                'bio' => 'Talent scouting and casting for screen, stage, and brand campaigns.',
            ],
            [
                'department' => 'post',
                'role' => 'Editor',
                'name' => 'Thilina Rajapaksha',
                'imdb' => 'https://www.imdb.com/name/nm10303974/',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=750&fit=crop&q=80',
                'bio' => 'Picture and sound editor delivering polished cuts for broadcast and cinema.',
            ],
            [
                'department' => 'post',
                'role' => 'VFX Artist',
                'name' => 'Nipuna Vidharshana',
                'photo' => 'https://images.unsplash.com/photo-1519085368733-0210214a053b?w=600&h=750&fit=crop&q=80',
                'bio' => 'Visual effects and compositing for commercials, films, and digital campaigns.',
            ],
        ];

        foreach ($team as $index => $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'role' => $member['role']],
                [
                    'department' => $member['department'],
                    'imdb' => $member['imdb'] ?? null,
                    'photo' => $member['photo'] ?? null,
                    'bio' => $member['bio'] ?? null,
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }

        $portfolio = [
            [
                'title' => 'Commercial Reel Highlights',
                'category' => 'Commercial',
                'description' => 'Selected brand films and TVCs produced across Sri Lanka.',
                'youtube_url' => 'https://www.youtube.com/@24framessrilanka',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=1200&h=800&fit=crop&q=80',
                'sort_order' => 0,
            ],
            [
                'title' => 'Documentary Production',
                'category' => 'Documentary',
                'description' => 'Long-form storytelling with international production standards.',
                'youtube_url' => 'https://www.youtube.com/@24framessrilanka',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1533750348718-4d2f7dce0f80?w=1200&h=800&fit=crop&q=80',
                'sort_order' => 1,
            ],
            [
                'title' => 'Feature Film Work',
                'category' => 'Film',
                'description' => 'Motion picture production from pre-production through final cut.',
                'youtube_url' => 'https://www.youtube.com/@24framessrilanka',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1200&h=800&fit=crop&q=80',
                'sort_order' => 2,
            ],
            [
                'title' => 'Television & Digital Content',
                'category' => 'Television',
                'description' => 'Series, episodic, and platform-native content for regional broadcasters.',
                'youtube_url' => 'https://www.youtube.com/@24framessrilanka',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1598890437839-09b54a0a2c8a?w=1200&h=800&fit=crop&q=80',
                'sort_order' => 3,
            ],
        ];

        foreach ($portfolio as $item) {
            PortfolioItem::updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, ['is_published' => true])
            );
        }

        $gallery = [
            [
                'title' => 'On set — camera crew',
                'media_type' => 'image',
                'media_url' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=800&h=600&fit=crop&q=80',
                'sort_order' => 0,
            ],
            [
                'title' => 'Production lighting',
                'media_type' => 'image',
                'media_url' => 'https://images.unsplash.com/photo-1478720568477-152d9b164e63?w=800&h=600&fit=crop&q=80',
                'sort_order' => 1,
            ],
            [
                'title' => 'Director at work',
                'media_type' => 'image',
                'media_url' => 'https://images.unsplash.com/photo-1574267432647-0817fcfc8913?w=800&h=600&fit=crop&q=80',
                'sort_order' => 2,
            ],
        ];

        foreach ($gallery as $item) {
            GalleryItem::updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, ['is_published' => true])
            );
        }

        foreach (config('frames.brands', []) as $index => $name) {
            Client::updateOrCreate(
                ['name' => $name],
                ['sort_order' => $index, 'is_published' => true]
            );
        }

        foreach (config('frames.directors', []) as $index => $director) {
            Director::updateOrCreate(
                ['name' => $director['name']],
                [
                    'photo' => $director['photo'] ?? null,
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }

        foreach ([
            'logo_white' => '/images/24frames-logo-white.png',
            'logo_red' => '/images/24frames-logo-red.png',
            'favicon' => '/images/24frames-logo-red.png',
        ] as $key => $path) {
            SiteSetting::set($key, SiteSetting::get($key) ?: $path);
        }

        SiteSetting::ensureBrandingDefaults();

        User::updateOrCreate(
            ['email' => 'admin@24frames.lk'],
            [
                'name' => '24 Frames Admin',
                'password' => 'password',
            ]
        );
    }
}
