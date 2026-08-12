<?php

use App\Livewire\Admin\CategoryForm;
use App\Livewire\Admin\CategoryIndex;
use App\Livewire\Admin\PartnerForm;
use App\Livewire\Admin\PartnerIndex;
use App\Livewire\Admin\ProductForm;
use App\Livewire\Admin\ProductIndex;
use App\Livewire\Admin\ProductLineupIndex;
use App\Livewire\Admin\ProductShowcaseIndex;
use App\Livewire\Admin\ReviewIndex;
use App\Livewire\Admin\TestimonialIndex as AdminTestimonialIndex;
use App\Livewire\Admin\WebSettingIndex;
use App\Livewire\Public\AboutIndex;
use App\Livewire\Public\CategoryDetail;
use App\Livewire\Public\HomeIndex;
use App\Livewire\Public\ProductDetail;
use App\Livewire\Public\TestimonialIndex as PublicTestimonialIndex;
use App\Livewire\Admin\Artikel\Index as AdminArtikelIndex;
use App\Livewire\Admin\Artikel\Form as AdminArtikelForm;
use App\Livewire\Public\Artikel\Show as PublicArtikelShow;
use App\Livewire\Public\Artikel\Index as PublicArtikelIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', HomeIndex::class)->name('home');
Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');
Route::get('/testimonials', PublicTestimonialIndex::class)->name('testimonials'); 
Route::get('/category/{slug}', CategoryDetail::class)->name('category.detail');
Route::get('/about-us', AboutIndex::class)->name('public.about');
/*
|--------------------------------------------------------------------------
| Authenticated / Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/product-lineup', ProductLineupIndex::class)->name('admin.product-lineup');
    Route::get('/categories', CategoryIndex::class)->name('admin.categories');
    Route::get('/categories/create', CategoryForm::class)->name('admin.categories.create');
    Route::get('/categories/{id}/edit', CategoryForm::class)->name('admin.categories.edit');

    Route::get('/products', ProductIndex::class)->name('admin.products');
    Route::get('/products/create', ProductForm::class)->name('admin.products.create');
    Route::get('/products/{id}/edit', ProductForm::class)->name('admin.products.edit');
    Route::get('/product-showcases', ProductShowcaseIndex::class)->name('product-showcases.index');
    Route::get('/web-settings', WebSettingIndex::class)->name('admin.settings');

    Route::get('/partners', PartnerIndex::class)->name('admin.partners');
    Route::get('/partners/create', PartnerForm::class)->name('admin.partners.create');
    Route::get('/partners/{id}/edit', PartnerForm::class)->name('admin.partners.edit');

    Route::get('/admin/testimonials', AdminTestimonialIndex::class)->name('admin.testimonials');


    Route::get('/admin/reviews', ReviewIndex::class)->name('admin.reviews');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/artikel', AdminArtikelIndex::class)->name('artikel.index');
        Route::get('/artikel/create', AdminArtikelForm::class)->name('artikel.create');
        Route::get('/artikel/{article}/edit', AdminArtikelForm::class)->name('artikel.edit');
    });

    Route::get('/artikel', PublicArtikelIndex::class)->name('artikel.index');
    Route::get('/artikel/{slug}', PublicArtikelShow::class)->name('artikel.show');
});

require __DIR__ . '/settings.php';