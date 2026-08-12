<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $filterStatus = 'all';
    public $search = '';

    // === State untuk Modal Form ===
    public $showModal = false;
    public $editingId = null; // null = mode tambah, terisi = mode edit

    public $name = '';
    public $role_or_company = '';
    public $message = '';
    public $rating = 5;
    public $status = 'approved'; // default approved karena diinput admin sendiri
    public $avatar; // file baru (temporary upload)
    public $currentAvatar = null; // path avatar lama saat edit

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'role_or_company' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:pending,approved,rejected',
            'avatar' => 'nullable|image|max:2048',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'message.required' => 'Pesan testimonial wajib diisi.',
        'message.min' => 'Pesan testimonial minimal 10 karakter.',
        'avatar.image' => 'File harus berupa gambar.',
        'avatar.max' => 'Ukuran foto maksimal 2MB.',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function setRating($value)
    {
        $this->rating = $value;
    }

    /**
     * Buka modal dalam mode tambah baru
     */
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Buka modal dalam mode edit, isi form dengan data existing
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $this->editingId = $testimonial->id;
        $this->name = $testimonial->name;
        $this->role_or_company = $testimonial->role_or_company;
        $this->message = $testimonial->message;
        $this->rating = $testimonial->rating;
        $this->status = $testimonial->status;
        $this->currentAvatar = $testimonial->avatar;
        $this->avatar = null;

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'editingId',
            'name',
            'role_or_company',
            'message',
            'avatar',
            'currentAvatar'
        ]);
        $this->rating = 5;
        $this->status = 'approved';
        $this->resetErrorBag();
    }

    /**
     * Simpan data (create atau update tergantung editingId)
     */
    public function save()
    {
        $validated = $this->validate();

        // Jika ada file avatar baru diunggah
        if ($this->avatar) {
            // Hapus avatar lama jika sedang mode edit
            if ($this->editingId && $this->currentAvatar) {
                Storage::disk('public')->delete($this->currentAvatar);
            }
            $validated['avatar'] = $this->avatar->store('testimonials', 'public');
        } else {
            // Pertahankan avatar lama kalau tidak upload baru
            $validated['avatar'] = $this->currentAvatar;
        }

        if ($this->editingId) {
            $testimonial = Testimonial::findOrFail($this->editingId);
            $testimonial->update($validated);
            session()->flash('message', 'Testimonial dari ' . $validated['name'] . ' berhasil diperbarui.');
        } else {
            Testimonial::create($validated);
            session()->flash('message', 'Testimonial dari ' . $validated['name'] . ' berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function updateStatus($id, $status)
    {
        $allowedStatuses = ['pending', 'approved', 'rejected'];

        if (!in_array($status, $allowedStatuses)) {
            return;
        }

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => $status]);

        $statusText = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'pending' => 'dikembalikan ke pending'
        ];

        session()->flash('message', 'Testimonial dari ' . $testimonial->name . ' berhasil ' . ($statusText[$status] ?? $status) . '.');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        session()->flash('message', 'Testimonial berhasil dihapus.');
    }

    public function render()
    {
        $query = Testimonial::query();

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . trim($this->search) . '%')
                    ->orWhere('message', 'like', '%' . trim($this->search) . '%')
                    ->orWhere('role_or_company', 'like', '%' . trim($this->search) . '%');
            });
        }

        $testimonials = $query->latest()->paginate(10);

        return view('livewire.admin.testimonial-index', [
            'testimonials' => $testimonials,
        ])->layout('layouts.app');
    }
}