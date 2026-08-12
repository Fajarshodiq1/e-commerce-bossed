<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\WebSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class WebSettingIndex extends Component
{
    use WithFileUploads;

    public $store_name;

    // Properti Upload Gambar Baru
    public $imgHeroHome;
    public $imgAboutHome;
    public $imgAboutHeader;
    public $imgAboutStory;
    public $imgAboutPhilosophy;
    public $imgGalleryHeader;

    // Properti Gambar Lama (Penampung Path di Database)
    public $oldImgHeroHome;
    public $oldImgAboutHome;
    public $oldImgAboutHeader;
    public $oldImgAboutStory;
    public $oldImgAboutPhilosophy;
    public $oldImgGalleryHeader;

    public $tagline;
    public $store_logo;
    public $oldStoreLogo;
    public $email;

    public $instagram_url;
    public $facebook_url;
    public $twitter_url;
    public $youtube_url;
    public $tiktok_url;

    public $address;
    public $description;
    public $whatsapp_number;
    public $whatsapp_template;
    public $meta_title_global;
    public $meta_description_global;

    public function mount()
    {
        $this->store_name = WebSetting::getByKey('store_name', '');
        $this->tagline = WebSetting::getByKey('tagline', '');
        $this->oldStoreLogo = WebSetting::getByKey('store_logo', '');

        // Load Path Gambar Lama
        $this->oldImgHeroHome = WebSetting::getByKey('img_hero_home', '');
        $this->oldImgAboutHome = WebSetting::getByKey('img_about_home', '');
        $this->oldImgAboutHeader = WebSetting::getByKey('img_about_header', '');
        $this->oldImgAboutStory = WebSetting::getByKey('img_about_story', '');
        $this->oldImgAboutPhilosophy = WebSetting::getByKey('img_about_philosophy', '');
        $this->oldImgGalleryHeader = WebSetting::getByKey('img_gallery_header', '');

        $this->email = WebSetting::getByKey('email', '');
        $this->instagram_url = WebSetting::getByKey('instagram_url', '');
        $this->facebook_url = WebSetting::getByKey('facebook_url', '');
        $this->twitter_url = WebSetting::getByKey('twitter_url', '');
        $this->youtube_url = WebSetting::getByKey('youtube_url', '');
        $this->tiktok_url = WebSetting::getByKey('tiktok_url', '');
        $this->address = WebSetting::getByKey('address', '');
        $this->description = WebSetting::getByKey('description', '');
        $this->whatsapp_number = WebSetting::getByKey('whatsapp_number', '');
        $this->whatsapp_template = WebSetting::getByKey('whatsapp_template', '');
        $this->meta_title_global = WebSetting::getByKey('meta_title_global', '');
        $this->meta_description_global = WebSetting::getByKey('meta_description_global', '');
    }

    /**
     * Map Konfigurasi Field Gambar untuk kemudahan Reusability
     */
    private function getImageMapping(): array
    {
        return [
            'storeLogo' => ['key' => 'store_logo', 'old' => 'oldStoreLogo', 'folder' => 'logo'],
            'imgHeroHome' => ['key' => 'img_hero_home', 'old' => 'oldImgHeroHome', 'folder' => 'settings/hero'],
            'imgAboutHome' => ['key' => 'img_about_home', 'old' => 'oldImgAboutHome', 'folder' => 'settings/about'],
            'imgAboutHeader' => ['key' => 'img_about_header', 'old' => 'oldImgAboutHeader', 'folder' => 'settings/about'],
            'imgAboutStory' => ['key' => 'img_about_story', 'old' => 'oldImgAboutStory', 'folder' => 'settings/about'],
            'imgAboutPhilosophy' => ['key' => 'img_about_philosophy', 'old' => 'oldImgAboutPhilosophy', 'folder' => 'settings/about'],
            'imgGalleryHeader' => ['key' => 'img_gallery_header', 'old' => 'oldImgGalleryHeader', 'folder' => 'settings/gallery'],
        ];
    }

    /**
     * Menghapus gambar fisik dan memperbarui record di Database secara spesifik
     */
    public function removeImage(string $field): void
    {
        $mapping = $this->getImageMapping();

        if (array_key_exists($field, $mapping)) {
            $config = $mapping[$field];
            $oldProperty = $config['old'];
            $dbKey = $config['key'];

            if ($this->{$oldProperty}) {
                // 1. Hapus dari Storage
                if (Storage::disk('public')->exists($this->{$oldProperty})) {
                    Storage::disk('public')->delete($this->{$oldProperty});
                }

                // 2. Kosongkan di Properti
                $this->{$oldProperty} = null;

                // 3. Update Database langsung tanpa perlu memicu validasi $this->save()
                WebSetting::updateOrCreate(
                    ['key' => $dbKey],
                    ['value' => null]
                );

                session()->flash('message', 'Gambar berhasil dihapus.');
            }
        }
    }

    protected $rules = [
        'store_name' => 'required|string|max:255',
        'tagline' => 'nullable|string|max:255',
        'store_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',

        // Validasi Gambar Baru
        'imgHeroHome' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        'imgAboutHome' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        'imgAboutHeader' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        'imgAboutStory' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        'imgAboutPhilosophy' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        'imgGalleryHeader' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',

        'email' => 'nullable|email',
        'instagram_url' => 'nullable|url',
        'facebook_url' => 'nullable|url',
        'twitter_url' => 'nullable|url',
        'youtube_url' => 'nullable|url',
        'tiktok_url' => 'nullable|url',
        'address' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'whatsapp_number' => 'required|numeric|digits_between:10,15',
        'whatsapp_template' => 'required|string',
        'meta_title_global' => 'nullable|string|max:255',
        'meta_description_global' => 'nullable|string',
    ];

    protected $messages = [
        'whatsapp_number.required' => 'Nomor WhatsApp admin wajib diisi.',
        'whatsapp_number.digits_between' => 'Nomor WhatsApp harus 10-15 digit, contoh: 6281234567890.',
    ];

    public function save()
    {
        $this->validate();

        $settings = [
            'store_name' => $this->store_name,
            'tagline' => $this->tagline,
            'email' => $this->email,
            'instagram_url' => $this->instagram_url,
            'facebook_url' => $this->facebook_url,
            'twitter_url' => $this->twitter_url,
            'youtube_url' => $this->youtube_url,
            'tiktok_url' => $this->tiktok_url,
            'address' => $this->address,
            'description' => $this->description,
            'whatsapp_number' => $this->whatsapp_number,
            'whatsapp_template' => $this->whatsapp_template,
            'meta_title_global' => $this->meta_title_global,
            'meta_description_global' => $this->meta_description_global,
        ];

        // Process Store Logo
        if ($this->store_logo) {
            if ($this->oldStoreLogo && Storage::disk('public')->exists($this->oldStoreLogo)) {
                Storage::disk('public')->delete($this->oldStoreLogo);
            }
            $path = $this->store_logo->store('logo', 'public');
            $settings['store_logo'] = $path;
            $this->oldStoreLogo = $path;
            $this->store_logo = null;
        }

        // Process File Gambar Latar & Banner
        $imageFields = [
            'imgHeroHome' => ['key' => 'img_hero_home', 'old' => 'oldImgHeroHome', 'folder' => 'settings/hero'],
            'imgAboutHome' => ['key' => 'img_about_home', 'old' => 'oldImgAboutHome', 'folder' => 'settings/about'],
            'imgAboutHeader' => ['key' => 'img_about_header', 'old' => 'oldImgAboutHeader', 'folder' => 'settings/about'],
            'imgAboutStory' => ['key' => 'img_about_story', 'old' => 'oldImgAboutStory', 'folder' => 'settings/about'],
            'imgAboutPhilosophy' => ['key' => 'img_about_philosophy', 'old' => 'oldImgAboutPhilosophy', 'folder' => 'settings/about'],
            'imgGalleryHeader' => ['key' => 'img_gallery_header', 'old' => 'oldImgGalleryHeader', 'folder' => 'settings/gallery'],
        ];

        foreach ($imageFields as $prop => $config) {
            if ($this->$prop) {
                $oldPath = $this->{$config['old']};
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $this->$prop->store($config['folder'], 'public');
                $settings[$config['key']] = $path;
                $this->{$config['old']} = $path;
                $this->$prop = null; // Reset input file
            }
        }

        // Batch Update/Create ke Table WebSetting
        foreach ($settings as $key => $value) {
            WebSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Auto regenerate sitemap
        Artisan::call('sitemap:generate');

        session()->flash('message', 'Pengaturan web berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.web-setting-index')
            ->layout('layouts.app');
    }
}