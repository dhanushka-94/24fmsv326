<?php

namespace Tests\Unit;

use App\Support\AccentText;
use PHPUnit\Framework\TestCase;

class AccentTextTest extends TestCase
{
    public function test_highlights_configured_words(): void
    {
        $result = AccentText::highlight('Big range. Small footprint. Shoot-ready.', ['Big', 'Small', 'Shoot-ready.']);

        $this->assertStringContainsString('<span class="hero-quote-accent">Big</span>', $result);
        $this->assertStringContainsString('<span class="hero-quote-accent">Small</span>', $result);
        $this->assertStringContainsString('<span class="hero-quote-accent">Shoot-ready.</span>', $result);
    }

    public function test_highlights_each_word_once(): void
    {
        $result = AccentText::highlight('Driven by precision. Meet precision experts.', ['precision']);

        $this->assertSame(1, substr_count($result, 'hero-quote-accent'));
    }
}
