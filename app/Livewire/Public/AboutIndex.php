<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Partner;
use App\Models\WebSetting;

class AboutIndex extends Component
{
    public function render()
    {
        // 1. Ambil Data Partner
        $partners = Partner::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // 2. Ambil Setting Nama Toko & Asset Gambar dari Database
        $storeName = WebSetting::getByKey('store_name', config('app.name', 'Bossed'));
        $imgAboutHeader = WebSetting::getByKey('img_about_header');
        $imgAboutStory = WebSetting::getByKey('img_about_story');
        $imgAboutPhilosophy = WebSetting::getByKey('img_about_philosophy');

        // 3. Meta Data SEO
        $metaTitle = 'Tentang Kami - ' . $storeName;
        $metaDescription = WebSetting::getByKey(
            'meta_description_about',
            'Pelajari lebih lanjut tentang ' . $storeName . ' sebagai penyedia corporate merchandise custom berbahan kulit berkualitas.'
        );

        return view('livewire.public.about-index', compact(
            'partners',
            'storeName',
            'imgAboutHeader',
            'imgAboutStory',
            'imgAboutPhilosophy'
        ))->layout('layouts.public', [
                    'metaTitle' => $metaTitle,
                    'metaDescription' => $metaDescription,
                ]);
    }
}