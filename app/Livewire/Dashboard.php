<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductShowcase;
use App\Models\Review;
use App\Models\Testimonial;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    #[Computed]
    public function stats(): array
    {
        return [
            'products' => [
                'total' => Product::count(),
                'active' => Product::where('is_active', true)->count(),
                'featured' => Product::where('is_featured', true)->count(),
            ],
            'categories' => [
                'total' => Category::count(),
            ],
            'reviews' => [
                'total' => Review::count(),
                'pending' => Review::where('status', 'pending')->count(),
                'approved' => Review::where('status', 'approved')->count(),
                'avg_rating' => round((float) Review::approved()->avg('rating'), 1),
            ],
            'testimonials' => [
                'total' => Testimonial::count(),
                'pending' => Testimonial::where('status', 'pending')->count(),
                'approved' => Testimonial::where('status', 'approved')->count(),
            ],
            'partners' => [
                'total' => Partner::count(),
                'active' => Partner::where('is_active', true)->count(),
            ],
            'showcases' => [
                'total' => ProductShowcase::count(),
                'active' => ProductShowcase::where('is_active', true)->count(),
            ],
            'users' => [
                'total' => User::count(),
            ],
        ];
    }

    #[Computed]
    public function recentReviews()
    {
        return Review::with('product')
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function recentTestimonials()
    {
        return Testimonial::where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}