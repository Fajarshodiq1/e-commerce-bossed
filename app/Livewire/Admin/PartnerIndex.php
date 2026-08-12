<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class PartnerIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleActive($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update(['is_active' => !$partner->is_active]);

        session()->flash('message', 'Status partner berhasil diperbarui.');
    }

    public function delete($id)
    {
        $partner = Partner::findOrFail($id);
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();

        session()->flash('message', 'Partner berhasil dihapus.');
    }

    public function render()
    {
        $partners = Partner::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.partner-index', compact('partners'))
            ->layout('layouts.app');
    }
}