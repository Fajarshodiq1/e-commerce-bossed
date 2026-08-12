<?php

namespace App\Livewire\Admin\Artikel;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        session()->flash('success', 'Artikel berhasil dihapus.');
    }

    public function render()
    {
        $articles = Article::where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.artikel.index', compact('articles'));
    }
}