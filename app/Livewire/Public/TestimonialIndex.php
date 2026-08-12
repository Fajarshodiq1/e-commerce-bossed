<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonial;
use App\Models\ProductShowcase;
use App\Models\Partner; // <-- Import model Partner
use App\Models\WebSetting;

class TestimonialIndex extends Component
{
    use WithPagination;

    // Form inputs
    public $name = '';
    public $role_or_company = '';
    public $rating = 5;
    public $message = '';

    // Notifikasi sukses
    public $successMessage = false;

    protected $rules = [
        'name' => 'required|min:3|max:100',
        'role_or_company' => 'nullable|max:100',
        'rating' => 'required|integer|min:1|max:5',
        'message' => 'required|min:10|max:500',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'rating.required' => 'Silakan pilih rating bintang.',
        'message.required' => 'Ulasan wajib diisi.',
        'message.min' => 'Ulasan minimal 10 karakter.',
        'message.max' => 'Ulasan maksimal 500 karakter.',
    ];

    public function setRating($value)
    {
        $this->rating = $value;
    }

    public function submit()
    {
        $this->validate();

        Testimonial::create([
            'name' => $this->name,
            'role_or_company' => $this->role_or_company ?: null,
            'rating' => $this->rating,
            'message' => $this->message,
            'status' => 'pending',
        ]);

        $this->reset(['name', 'role_or_company', 'message']);
        $this->rating = 5;

        $this->successMessage = true;
    }

    public function render()
    {
        $storeName = WebSetting::getByKey('store_name', config('app.name', 'Toko Online'));
        $imgGalleryHeader = WebSetting::getByKey('img_gallery_header');

        $testimonials = Testimonial::approved()
            ->latest()
            ->paginate(9);

        $productShowcases = ProductShowcase::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        // Query Partner Aktif
        $partners = Partner::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        $totalTestimonials = Testimonial::approved()->count();
        $averageRating = Testimonial::approved()->avg('rating') ?: 5;

        return view('livewire.public.testimonial-index', [
            'testimonials' => $testimonials,
            'productShowcases' => $productShowcases,
            'partners' => $partners, // <-- Passing data $partners ke view
            'totalTestimonials' => $totalTestimonials,
            'averageRating' => round($averageRating, 1),
            'storeName' => $storeName,
            'imgGalleryHeader' => $imgGalleryHeader,
        ])->layout('layouts.public', [
                    'metaTitle' => 'Ulasan Pelanggan - ' . $storeName,
                    'metaDescription' => 'Baca ulasan jujur dari pembeli toko kami dan lihat mitra perusahaan yang telah mempercayai kami.',
                ]);
    }
}