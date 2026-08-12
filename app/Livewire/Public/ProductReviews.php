<?php

namespace App\Livewire\Public;

use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ProductReviews extends Component
{
    use WithPagination;

    public Product $product;

    // Form fields
    public string $name = '';
    public string $email = '';
    public int $rating = 5;
    public string $comment = '';

    public bool $submitted = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'comment.required' => 'Ulasan wajib diisi.',
        'comment.min' => 'Ulasan minimal 10 karakter.',
    ];

    public function setRating(int $value): void
    {
        $this->rating = $value;
    }

    public function submit(): void
    {
        $this->validate();

        Review::create([
            'product_id' => $this->product->id,
            'name' => $this->name,
            'email' => $this->email,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'status' => 'pending',
        ]);

        $this->reset(['name', 'email', 'comment']);
        $this->rating = 5;
        $this->submitted = true;
    }

    #[Computed]
    public function approvedReviews()
    {
        return $this->product->reviews()
            ->approved()
            ->latest()
            ->paginate(5);
    }

    #[Computed]
    public function reviewCount(): int
    {
        return $this->product->reviews()->approved()->count();
    }

    #[Computed]
    public function averageRating(): float
    {
        return round((float) $this->product->reviews()->approved()->avg('rating'), 1);
    }

    #[Computed]
    public function ratingBreakdown(): array
    {
        $total = $this->reviewCount ?: 1;
        $breakdown = [];

        for ($star = 5; $star >= 1; $star--) {
            $count = $this->product->reviews()->approved()->where('rating', $star)->count();
            $breakdown[$star] = [
                'count' => $count,
                'percent' => round(($count / $total) * 100),
            ];
        }

        return $breakdown;
    }

    public function render()
    {
        return view('livewire.public.product-reviews');
    }
}