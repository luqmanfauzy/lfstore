<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    {{-- meta deskripsi --}}
    <meta name="description" content="{{ $description }}">
    {{-- meta keywords --}}
    <meta name="keywords" content="{{ $keywords }}">
    {{-- meta author --}}
    <meta name="author" content="LF Store - Katalog">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('assets/images/openGraphBanner.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- tailwind / vite --}}
    @vite('resources/css/app.css')

    {{-- google font: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- tailwind css CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Alpine.js for dropdowns & mobile menu --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: #FAFAFA;
        }

        /* Hide scrollbar for category mobile wrapper */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="text-gray-800 antialiased font-sans overflow-x-hidden">

    <!-- Navigation (Sticky & Glassmorphism) -->
    <nav x-data="{ mobileMenuOpen: false }"
        class="bg-white/80 backdrop-blur-lg border-b border-gray-100 fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6 py-4 lg:px-8">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-extrabold tracking-tight text-gray-900">LF<span
                            class="text-blue-600">Store</span></span>
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">Beranda</a>
                <a href="{{ route('catalog') }}" class="text-sm font-medium text-blue-600 transition-colors">Katalog</a>

                {{-- Dropdown Kategori (Alpine Action) --}}
                <div x-data="{ open: false }" class="relative" @click.away="open = false" @mouseleave="open = false"
                    @mouseover="open = true">
                    <button @click="open = !open"
                        class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-1">
                        Kategori <i class='bx bx-chevron-down text-lg'></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition.opacity.duration.200ms style="display: none;"
                        class="absolute top-full left-0 mt-2 w-56 bg-white border border-gray-100 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] py-2 z-50">
                        @foreach ($categories as $category)
                            <a href="{{ route('category-product', $category->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                {{ $category->category_name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('home') }}#about"
                    class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">Tentang Kami</a>
            </div>

            <!-- Header Search Bar -->
            <div class="hidden md:flex items-center space-x-5">
                <form action="{{ route('catalog') }}" method="GET" class="relative">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari produk..."
                        class="w-48 lg:w-64 pl-4 pr-10 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                    <button type="submit"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors">
                        <i class='bx bx-search text-lg'></i>
                    </button>
                </form>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 text-gray-500 hover:text-blue-600 transition-colors focus:outline-none rounded-lg focus:ring-2 focus:ring-gray-100">
                <i class='bx bx-menu text-3xl' x-show="!mobileMenuOpen"></i>
                <i class='bx bx-x text-3xl' x-show="mobileMenuOpen" style="display: none;"></i>
            </button>
        </div>

        <!-- Mobile Menu (AlpineJS) -->
        <div x-show="mobileMenuOpen" x-transition.opacity style="display: none;"
            class="md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg h-screen overflow-y-auto pb-24">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('home') }}"
                    class="block text-base font-medium text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="{{ route('catalog') }}" class="block text-base font-medium text-blue-600">Katalog</a>

                {{-- Mobile Dropdown Kategori --}}
                <div x-data="{ subOpen: false }" class="border-y border-gray-100 py-4 my-2">
                    <button @click="subOpen = !subOpen"
                        class="w-full text-left text-base font-medium text-gray-700 hover:text-blue-600 flex justify-between items-center focus:outline-none">
                        Kategori <i class='bx bx-chevron-down text-xl transition-transform duration-300'
                            :class="{'rotate-180': subOpen}"></i>
                    </button>
                    <div x-show="subOpen" x-transition.opacity style="display: none;" class="mt-4 pl-4 space-y-4">
                        @foreach ($categories as $category)
                            <a href="{{ route('category-product', $category->slug) }}"
                                class="block text-sm text-gray-500 hover:text-blue-600 transition-colors">
                                {{ $category->category_name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('home') }}#about"
                    class="block text-base font-medium text-gray-700 hover:text-blue-600 pb-2">Tentang Kami</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <section class="min-h-screen pt-28 pb-16 font-sans max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row gap-8 lg:gap-12">

            <!-- Sidebar: Categories & Filters (Desktop) -->
            <aside class="hidden md:block w-64 flex-shrink-0">
                <div class="sticky top-28">
                    <h3 class="text-base font-semibold text-gray-900 mb-5 tracking-tight uppercase">Filter Kategori</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('catalog') }}"
                                class="{{ url()->current() == route('catalog') && !request()->has('query') ? 'bg-blue-50 text-blue-600 font-semibold border-l-4 border-blue-600 pl-3' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50 border-l-4 border-transparent pl-3' }} flex items-center py-2 transition-all text-sm rounded-r-lg">
                                Semua Produk
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('category-product', $category->slug) }}"
                                    class="{{ url()->current() == route('category-product', $category->slug) ? 'bg-blue-50 text-blue-600 font-semibold border-l-4 border-blue-600 pl-3' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50 border-l-4 border-transparent pl-3' }} flex items-center py-2 transition-all text-sm rounded-r-lg">
                                    {{ $category->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Product Display Area -->
            <main class="w-full">

                <!-- Mobile Search (Visible only on mobile) -->
                <div class="md:hidden mb-6">
                    <form action="{{ route('catalog') }}" method="GET" class="relative">
                        <input type="text" name="query" value="{{ request('query') }}"
                            class="w-full pl-5 pr-12 py-3 bg-white border border-gray-200/80 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm"
                            placeholder="Cari produk...">
                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-blue-600 hover:bg-blue-700 rounded-full w-9 h-9 flex items-center justify-center transition-colors shadow-md shadow-blue-500/20">
                            <i class='bx bx-search text-lg'></i>
                        </button>
                    </form>
                </div>

                <!-- Category Pills (Mobile Only) -->
                <div class="md:hidden flex overflow-x-auto gap-3 pb-2 mb-6 scrollbar-hide -mx-4 px-4">
                    <a href="{{ route('catalog') }}"
                        class="{{ url()->current() == route('catalog') && !request()->has('query') ? 'bg-blue-600 text-white border-blue-600' : 'bg-white border-gray-200 text-gray-700 hover:border-gray-300' }} border px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors shadow-sm">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('category-product', $category->slug) }}"
                            class="{{ url()->current() == route('category-product', $category->slug) ? 'bg-blue-600 text-white border-blue-600' : 'bg-white border-gray-200 text-gray-700 hover:border-gray-300' }} border px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors shadow-sm">
                            {{ $category->category_name }}
                        </a>
                    @endforeach
                </div>

                <!-- Section Header -->
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-4 border-b border-gray-100">
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                        @if(request('query'))
                            Pencarian: "{{ request('query') }}"
                        @else
                            Katalog Produk
                        @endif
                    </h1>

                    <div
                        class="text-sm font-medium text-gray-500 mt-2 sm:mt-0 px-3 py-1 bg-gray-50 rounded-full border border-gray-100">
                        {{ $allProduct->total() }} Produk Ditemukan
                    </div>
                </div>

                <!-- Product Grid -->
                @if($allProduct->count() > 0)
                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
                        @foreach ($allProduct as $data)
                            <div
                                class="group flex flex-col bg-white rounded-3xl border border-gray-100/50 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-blue-100 transition-all duration-300">

                                <!-- Product Image Container -->
                                <a href="{{ route('detail', $data->slug) }}"
                                    class="relative aspect-square overflow-hidden bg-gray-50/50 pt-2 px-2 flex items-center justify-center group">

                                    @php
                                        $imagePath = $data->image_thumbnail ? 'storage/' . $data->image_thumbnail : null;
                                        $fullPath = $imagePath ? public_path($imagePath) : null;
                                        $imageExists = $fullPath && file_exists($fullPath);
                                    @endphp

                                    <img src="{{ $imageExists ? asset($imagePath) : asset('assets/images/no-image-available.png') }}"
                                        alt="{{ $data->name }}"
                                        class="object-cover w-full h-full rounded-2xl group-hover:scale-105 transition-transform duration-700 ease-in-out {{ !$imageExists ? 'opacity-80' : '' }}"
                                        onerror="this.src='{{ asset('assets/images/no-image-available.png') }}'; this.onerror=null;">

                                    <!-- Fast View Badge (visible on hover) -->
                                    <div
                                        class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl">
                                    </div>
                                </a>

                                <!-- Product Info -->
                                <div class="p-5 sm:p-6 flex flex-col flex-1">
                                    <h3
                                        class="text-[15px] sm:text-base font-medium text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-600 transition-colors mb-2">
                                        <a href="{{ route('detail', $data->slug) }}">
                                            {{ $data->name }}
                                        </a>
                                    </h3>

                                    <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                        <div>
                                            <p class="text-xs text-gray-400 mb-0.5">Mulai dari</p>
                                            <p class="text-base sm:text-lg font-bold text-gray-900 tracking-tight">
                                                Rp{{ number_format($data->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <a href="{{ route('detail', $data->slug) }}"
                                            class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gray-50 text-gray-400 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300"
                                            aria-label="Lihat Detail Produk">
                                            <i class="fa-solid fa-arrow-right text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State / No Products Found -->
                    <div
                        class="py-24 text-center flex flex-col items-center justify-center rounded-3xl bg-gray-50 border border-dashed border-gray-200">
                        <div
                            class="w-20 h-20 bg-white rounded-full flex items-center justify-center mb-6 shadow-sm text-gray-400">
                            <i class='bx bx-package text-4xl'></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
                        <p class="text-gray-500 max-w-sm mx-auto mb-8 text-sm">Maaf, kami tidak dapat menemukan produk yang
                            sesuai dengan pencarian Anda.</p>
                        <a href="{{ route('catalog') }}"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-medium transition-colors text-sm shadow-md shadow-blue-500/20">
                            Kembali ke Katalog
                        </a>
                    </div>
                @endif

                <!-- Pagination Area -->
                <div class="mt-12 overflow-x-auto">
                    {{ $allProduct->appends(request()->except('page'))->links() }}
                </div>

            </main>
        </div>
    </section>

    <!-- Clean Modern Footer -->
    <footer class="bg-white border-t border-gray-200 pt-16 pb-8 font-sans">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8 mb-12">

                <!-- Brand Info Section -->
                <div class="md:col-span-5 lg:col-span-4">
                    <a href="{{ route('home') }}" class="inline-block mb-6">
                        <span class="text-2xl font-extrabold tracking-tight text-gray-900">LF<span
                                class="text-blue-600">Store</span></span>
                    </a>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-8">
                        Tampil stylish, hidup lebih percaya diri. Katalog fashion dan aksesori terpercaya untuk gaya
                        hidup modern Anda.
                    </p>
                    <div class="flex space-x-3">
                        <a href="mailto:luqmannfauzy46@gmail.com"
                            class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition-colors shadow-sm border border-gray-100">
                            <i class='bx bx-envelope text-lg'></i>
                        </a>
                        <a href="https://wa.me/6289650710460" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition-colors shadow-sm border border-gray-100">
                            <i class='bx bxl-whatsapp text-lg'></i>
                        </a>
                        <a href="https://maps.app.goo.gl/EWj82GEcHddkXy3V7" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition-colors shadow-sm border border-gray-100">
                            <i class='bx bx-map text-lg'></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="md:col-span-3 lg:col-span-2 lg:col-start-7">
                    <h4 class="text-gray-900 font-semibold mb-6 tracking-tight">Navigasi</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}"
                                class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}"
                                class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Katalog Produk</a>
                        </li>
                        <li><a href="{{ route('home') }}#about"
                                class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Tentang Kami</a>
                        </li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="md:col-span-4 lg:col-span-3 lg:col-start-10">
                    <h4 class="text-gray-900 font-semibold mb-6 tracking-tight">Kategori Utama</h4>
                    <ul class="space-y-4">
                        @foreach(collect($categories)->take(4) as $cat_footer)
                            <li>
                                <a href="{{ route('category-product', $cat_footer->slug) }}"
                                    class="text-sm text-gray-500 hover:text-blue-600 transition-colors">
                                    {{ $cat_footer->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400">
                    Made with <i class='bx bxs-heart text-red-500 mx-1'></i> by <span
                        class="font-medium text-gray-600">LF Store</span> &copy; <span id="currentYear"></span>. All
                    rights reserved.
                </p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Kebijakan Privasi</a>
                    <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Script -->
    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
</body>

</html>