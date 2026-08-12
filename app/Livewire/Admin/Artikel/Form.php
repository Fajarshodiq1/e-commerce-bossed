<?php

namespace App\Livewire\Admin\Artikel;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Article $article = null;

    // Form Utama
    public $title = '';
    public $content = '';
    public $has_toc = true;

    // Form SEO
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $featured_image;
    public $existing_featured_image = '';

    public function mount(Article $article = null)
    {
        if ($article && $article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->content = $article->content;
            $this->has_toc = $article->has_toc;

            $this->meta_title = $article->meta_title ?? $article->title;
            $this->meta_description = $article->meta_description;
            $this->meta_keywords = $article->meta_keywords;
            $this->existing_featured_image = $article->featured_image;
        }
    }

    public function updatedTitle($value)
    {
        if (empty($this->meta_title)) {
            $this->meta_title = $value;
        }
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'has_toc' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->existing_featured_image;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'has_toc' => $this->has_toc,
            'meta_title' => $this->meta_title ?: $this->title,
            'meta_description' => $this->meta_description ?: Str::limit(strip_tags($this->content), 150),
            'meta_keywords' => $this->meta_keywords,
            'featured_image' => $imagePath,
        ];

        if ($this->article && $this->article->exists) {
            $this->article->update($data);
            session()->flash('success', 'Artikel berhasil diperbarui.');
        } else {
            Article::create($data);
            session()->flash('success', 'Artikel berhasil dibuat.');
        }

        return redirect()->route('admin.artikel.index');
    }

    public function render()
    {
        return view('livewire.admin.artikel.form');
    }
}