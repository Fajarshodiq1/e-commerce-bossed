<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 font-admin">
    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Platform')" class="grid">
                <!-- Dashboard -->
                <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>

                <!-- Artikel -->
                <flux:sidebar.item icon="document-text" :href="route('admin.artikel.index')"
                    :current="request()->routeIs('admin.artikel*')" wire:navigate>
                    {{ __('Artikel') }}
                </flux:sidebar.item>

                <!-- Kategori -->
                <flux:sidebar.item icon="tag" :href="route('admin.categories')"
                    :current="request()->routeIs('admin.categories*')" wire:navigate>
                    {{ __('Kategori') }}
                </flux:sidebar.item>

                <!-- Produk -->
                <flux:sidebar.item icon="cube" :href="route('admin.products')"
                    :current="request()->routeIs('admin.products*')" wire:navigate>
                    {{ __('Produk') }}
                </flux:sidebar.item>

                <!-- Product Showcase -->
                <flux:sidebar.item icon="presentation-chart-line" :href="route('product-showcases.index')"
                    :current="request()->routeIs('product-showcases*')" wire:navigate>
                    {{ __('Showcase Produk') }}
                </flux:sidebar.item>

                <!-- Partner / Brand -->
                <flux:sidebar.item icon="building-office-2" :href="route('admin.partners')"
                    :current="request()->routeIs('admin.partners*')" wire:navigate>
                    {{ __('Partner / Brand') }}
                </flux:sidebar.item>

                <!-- Lineup Produk -->
                <flux:sidebar.item icon="squares-2x2" :href="route('admin.product-lineup')"
                    :current="request()->routeIs('admin.product-lineup*')" wire:navigate>
                    {{ __('Lineup Produk') }}
                </flux:sidebar.item>

                <!-- Moderasi Testimonial -->
                <flux:sidebar.item icon="chat-bubble-bottom-center-text" :href="route('admin.testimonials')"
                    :current="request()->routeIs('admin.testimonials*')" wire:navigate>
                    {{ __('Testimonial') }}
                </flux:sidebar.item>

                <!-- Review Produk -->
                <flux:sidebar.item icon="star" :href="route('admin.reviews')"
                    :current="request()->routeIs('admin.reviews*')" wire:navigate>
                    {{ __('Review Produk') }}
                </flux:sidebar.item>

                <!-- Pengaturan Web & WhatsApp -->
                <flux:sidebar.item icon="cog-6-tooth" :href="route('admin.settings')"
                    :current="request()->routeIs('admin.settings*')" wire:navigate>
                    {{ __('Pengaturan') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
    </flux:sidebar>

    <!-- Mobile Header Navigation -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
