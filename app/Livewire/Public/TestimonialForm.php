<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Testimonial;

class TestimonialForm extends Component
{
    use WithFileUploads;

    public $name;
    public $role_or_company;
    public $rating = 5;
    public $message;
    public $avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'role_or_company' => 'nullable|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'message' => 'required|string|min:10|max:1000',
        'avatar' => 'nullable|image|max:1024', // max 1MB
    ];

    public function submit()
    {
        $this->validate();

        $avatarPath = null;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('testimonials', 'public');
        }

        Testimonial::create([
            'name' => $this->name,
            'role_or_company' => $this->role_or_company,
            'rating' => $this->rating,
            'message' => $this->message,
            'avatar' => $avatarPath,
            'status' => 'pending', // Wajib pending dulu agar perlu dimoderasi oleh admin
        ]);

        $this->reset(['name', 'role_or_company', 'rating', 'message', 'avatar']);

        session()->flash('success_testimonial', 'Terima kasih! Ulasan Anda telah kami terima dan sedang dalam proses peninjauan.');
    }

    public function render()
    {
        return view('livewire.public.testimonial-form');
    }
}