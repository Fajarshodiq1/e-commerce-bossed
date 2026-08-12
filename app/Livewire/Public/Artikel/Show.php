<?php

namespace App\Livewire\Public\Artikel;

use App\Models\Article;
use App\Helpers\TocParser;
use Livewire\Component;

class Show extends Component
{
    public Article $article;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        // Parsing TOC langsung dari Component Class
        $parsed = TocParser::process($this->article->content);

        // Ambil maksimal 4 artikel lainnya (kecuali artikel yang sedang tampil)
        $relatedArticles = Article::where('id', '!=', $this->article->id)
            ->latest()
            ->take(4)
            ->get();

        return view('livewire.public.artikel.show', [
            'parsed' => $parsed,
            'relatedArticles' => $relatedArticles,
        ])->layout('layouts.public', [
                    'metaTitle' => $this->article->meta_title ?: $this->article->title,
                    'metaDescription' => $this->article->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($this->article->content), 150),
                    'metaKeywords' => $this->article->meta_keywords,
                    'metaImage' => $this->article->featured_image ? asset('storage/' . $this->article->featured_image) : asset('assets/BOOSED_LOGO.png'),
                    'metaType' => 'article',
                ]);
    }
}