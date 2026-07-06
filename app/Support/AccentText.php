<?php

namespace App\Support;

class AccentText
{
    /**
     * Wrap specific words in the hero accent span (Allura + red).
     *
     * @param  list<string>  $words
     */
    public static function highlight(string $text, array $words): string
    {
        $sorted = $words;
        usort($sorted, fn (string $a, string $b): int => strlen($b) <=> strlen($a));

        $result = $text;

        foreach ($sorted as $word) {
            if ($word === '') {
                continue;
            }

            $position = mb_strpos($result, $word);

            if ($position === false) {
                continue;
            }

            $accent = '<span class="hero-quote-accent">'.$word.'</span>';
            $result = mb_substr($result, 0, $position).$accent.mb_substr($result, $position + mb_strlen($word));
        }

        return $result;
    }
}
