<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class PartnerForm extends Component
{
    use WithFileUploads;

    public $partnerId;
    public $name;
    public $logo;
    public $oldLogo;
    public $url;
    public $sort_order = 0;
    public $is_active = true;

    public function mount($id = null)
    {
        if ($id) {
            $partner = Partner::findOrFail($id);
            $this->partnerId = $partner->id;
            $this->name = $partner->name;
            $this->oldLogo = $partner->logo;
            $this->url = $partner->url;
            $this->sort_order = $partner->sort_order;
            $this->is_active = $partner->is_active;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => $this->partnerId ? 'nullable|image|max:1024' : 'required|image|max:1024', // Max 1MB
            'url' => 'nullable|url|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        $logoPath = $this->oldLogo;
        if ($this->logo) {
            if ($this->oldLogo) {
                Storage::disk('public')->delete($this->oldLogo);
            }
            $logoPath = $this->logo->store('partners', 'public');
        }

        Partner::updateOrCreate(
            ['id' => $this->partnerId],
            [
                'name' => $this->name,
                'logo' => $logoPath,
                'url' => $this->url,
                'sort_order' => $this->sort_order,
                'is_active' => $this->is_active,
            ]
        );

        session()->flash('message', $this->partnerId ? 'Partner berhasil diperbarui.' : 'Partner berhasil ditambahkan.');

        return redirect()->route('admin.partners');
    }

    public function render()
    {
        return view('livewire.admin.partner-form')
            ->layout('layouts.app');
    }
}