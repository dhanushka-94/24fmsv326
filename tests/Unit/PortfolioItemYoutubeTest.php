<?php

namespace Tests\Unit;

use App\Models\PortfolioItem;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PortfolioItemYoutubeTest extends TestCase
{
    #[DataProvider('youtubeUrlProvider')]
    public function test_youtube_id_is_extracted_from_common_urls(string $url, ?string $expected): void
    {
        $item = new PortfolioItem(['youtube_url' => $url]);

        $this->assertSame($expected, $item->youtubeId());
    }

    public static function youtubeUrlProvider(): array
    {
        return [
            ['https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://youtu.be/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://www.youtube.com/shorts/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://www.youtube.com/watch?v=dQw4w9WgXcQ&list=PLxxx', 'dQw4w9WgXcQ'],
            ['https://youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://www.youtube.com/embed/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://www.youtube.com/@24framessrilanka', null],
            ['www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://www.youtube.com/watch?feature=share&v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            ['https://youtu.be/dQw4w9WgXcQ?si=abc123', 'dQw4w9WgXcQ'],
        ];
    }
}
