<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\WebSetting;
use Illuminate\View\View;

class PublicLayoutComposer
{
    public function compose(View $view)
    {
        $view->with([
            'storeName' => WebSetting::getByKey('store_name', 'Bossed'),
            'tagline' => WebSetting::getByKey('tagline', ''),
            'storeLogo' => WebSetting::getByKey('store_logo', null),
            'email' => WebSetting::getByKey('email', null), // <-- Ditambahkan di sini
            'description' => WebSetting::getByKey('description', 'Corporate Merchandise & Leather Specialist. Menghadirkan produk berbahan kulit berkualitas untuk memperkuat identitas brand perusahaan Anda.'),
            'address' => WebSetting::getByKey('address', null),

            // WhatsApp Settings
            'whatsappNumber' => WebSetting::getByKey('whatsapp_number', '6281234567890'),
            'whatsappTemplate' => WebSetting::getByKey('whatsapp_template', ''),

            // Social Media Links
            'instagramUrl' => WebSetting::getByKey('instagram_url', null),
            'facebookUrl' => WebSetting::getByKey('facebook_url', null),
            'twitterUrl' => WebSetting::getByKey('twitter_url', null),
            'youtubeUrl' => WebSetting::getByKey('youtube_url', null),
            'tiktokUrl' => WebSetting::getByKey('tiktok_url', null),

            // SEO
            'metaTitleGlobal' => WebSetting::getByKey('meta_title_global', null),
            'metaDescriptionGlobal' => WebSetting::getByKey('meta_description_global', null),

            // Categories
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}