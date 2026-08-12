<?php

namespace App\Livewire\Public\Artikel;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $articles = Article::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('meta_description', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(9);

        return view('livewire.public.artikel.index', compact('articles'))
            ->layout('layouts.public', [
                'metaTitle' => 'Artikel & Wawasan Corporate Merchandise Kulit | Bossed',
                'metaDescription' => 'Baca artikel, tips, dan panduan terbaru seputar corporate gift set, seminar kit, hampers perusahaan, dan kerajinan kulit premium.',
                'metaKeywords' => 'artikel souvenir kulit, blog gift set, tips seminar kit, hampers perusahaan',
                'metaImage' => asset('assets/BOOSED_LOGO.png'),
                'metaType' => 'website',
            ]);
    }
}