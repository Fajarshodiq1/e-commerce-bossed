<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TocParser
{
    public static function process(?string $content): array
    {
        if (empty($content)) {
            return [
                'toc' => [],
                'content' => '',
            ];
        }

        $toc = [];

        // Regex untuk menangkap tag <h2> dan <h3>
        $pattern = '/<h([2-3])([^>]*)>(.*?)<\/h[2-3]>/i';

        $processedContent = preg_replace_callback($pattern, function ($matches) use (&$toc) {
            $level = 'h' . $matches[1];
            $attributes = $matches[2];
            $text = strip_tags($matches[3]);

            // Buat ID slug unik dari teks judul
            $id = Str::slug($text);

            // Tambahkan data ke struktur TOC
            $toc[] = [
                'id' => $id,
                'text' => $text,
                'level' => $level,
            ];

            // Masukkan id ke dalam tag HTML jika belum ada id
            if (!str_contains($attributes, 'id=')) {
                return "<h{$matches[1]} id=\"{$id}\"{$attributes}>{$matches[3]}</h{$matches[1]}>";
            }

            return $matches[0];
        }, $content);

        return [
            'toc' => $toc,
            'content' => $processedContent,
        ];
    }
}