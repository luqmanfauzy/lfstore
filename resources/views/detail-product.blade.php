<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="author" content="LF Store">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    @php
        $ogPath = $data->image_thumbnail ? 'storage/' . $data->image_thumbnail : null;
        $ogExists = $ogPath && file_exists(public_path($ogPath));
    @endphp

    <meta property="og:image" content="{{ $ogExists
    ? asset($ogPath)
    : asset('assets/images/no-image-available.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- tailwind / vite --}}
    @vite('resources/css/app.css')

    {{-- google font: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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

        /* Hide scrollbar for thumbnail scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Markdown prose styling overrides for description */
        .prose p {
            margin-bottom: 0.75rem;
            color: #4b5563;
            line-height: 1.6;
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 0.75rem;
            color: #4b5563;
        }

        .prose strong {
            color: #111827;
            font-weight: 600;
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
                    <input type="text" name="query" value="" placeholder="Cari produk..."
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
                <!-- Mobile Search -->
                <form action="{{ route('catalog') }}" method="GET" class="relative mb-6">
                    <input type="text" name="query" value=""
                        class="w-full pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Cari produk...">
                    <button type="submit"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                        <i class='bx bx-search text-xl'></i>
                    </button>
                </form>

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

    <!-- Main Product Detail Section -->
    <section class="min-h-screen pt-28 pb-16 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm w-full" aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center gap-y-2 gap-x-1 sm:gap-x-2 text-xs sm:text-sm">
                <li class="flex items-center">
                    <a href="{{ route('home') }}"
                        class="flex items-center text-gray-500 hover:text-blue-600 transition-colors">
                        <i class="bx bx-home mr-1 text-base"></i>Beranda
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="bx bx-chevron-right text-gray-400 text-base mx-0 sm:mx-1"></i>
                    <a href="{{ route('catalog') }}"
                        class="text-gray-500 hover:text-blue-600 transition-colors">Katalog</a>
                </li>
                @if($data->categories->isNotEmpty())
                    <li class="flex items-center">
                        <i class="bx bx-chevron-right text-gray-400 text-base mx-0 sm:mx-1"></i>
                        <a href="{{ route('category-product', $data->categories->first()->slug) }}"
                            class="text-gray-500 hover:text-blue-600 transition-colors">{{ $data->categories->first()->category_name }}</a>
                    </li>
                @endif
                <li class="flex items-center" aria-current="page">
                    <i class="bx bx-chevron-right text-gray-400 text-base mx-0 sm:mx-1"></i>
                    <span class="text-gray-900 font-medium truncate max-w-[120px] sm:max-w-xs">{{ $data->name }}</span>
                </li>
            </ol>
        </nav>

        <div
            class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 w-full overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-16">

                <!-- Left: Product Images -->
                <div class="w-full flex flex-col gap-4 lg:sticky lg:top-28 min-w-0">
                    @php
                        $imagesCount = 1 + count($data->images);
                    @endphp
                    <!-- Main Featured Image -->
                    <div id="mainImageContainer"
                        class="relative group w-full aspect-square overflow-hidden rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center p-4 sm:p-6">

                        @if($imagesCount > 1)
                            <!-- Left Arrow (Main) -->
                            <button type="button"
                                class="flex absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 items-center justify-center bg-white/90 backdrop-blur border border-gray-200 rounded-full shadow-sm text-gray-600 hover:text-blue-600 hover:border-blue-200 transition-all disabled:opacity-0 disabled:cursor-not-allowed"
                                onclick="prevImage()" id="main-left-btn">
                                <i class='bx bx-chevron-left text-2xl'></i>
                            </button>
                        @endif

                        @php
                            $mainPath = $data->image_thumbnail ? 'storage/' . $data->image_thumbnail : null;
                            $mainExists = $mainPath && file_exists(public_path($mainPath));
                        @endphp

                        <img id="currentImage"
                            src="{{ $mainExists ? asset($mainPath) : asset('assets/images/no-image-available.png') }}"
                            class="object-contain w-full h-full rounded-xl mix-blend-multiply transition-opacity duration-300"
                            onerror="this.src='{{ asset('assets/images/no-image-available.png') }}'; this.onerror=null;">

                        @if($imagesCount > 1)
                            <!-- Right Arrow (Main) -->
                            <button type="button"
                                class="flex absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 items-center justify-center bg-white/90 backdrop-blur border border-gray-200 rounded-full shadow-sm text-gray-600 hover:text-blue-600 hover:border-blue-200 transition-all disabled:opacity-0 disabled:cursor-not-allowed"
                                onclick="nextImage()" id="main-right-btn">
                                <i class='bx bx-chevron-right text-2xl'></i>
                            </button>
                        @endif
                    </div>

                    <!-- Image Thumbnails Carousel -->
                    @if($imagesCount > 1)
                        <div class="mt-4 w-full">
                            <div id="thumbnail-container"
                                class="flex flex-nowrap gap-3 sm:gap-4 overflow-x-auto pb-2 pt-1 px-1 scroll-smooth scrollbar-hide w-full items-center">
                                
                                <!-- Main Thumb -->
                                @php
                                    $thumbExists = $mainPath && file_exists(public_path($mainPath));
                                @endphp

                                <button type="button"
                                    onclick="changeImage('{{ $thumbExists ? asset($mainPath) : asset('assets/images/no-image-available.png') }}', this, 0)"
                                    class="thumbnail-btn flex-shrink-0 w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden border-2 border-blue-600 bg-gray-50 flex items-center justify-center transition-all duration-200 outline-none hover:shadow-md focus:border-blue-600">
                                    <img src="{{ $thumbExists ? asset($mainPath) : asset('assets/images/no-image-available.png') }}"
                                    class="w-full h-full object-contain p-2 mix-blend-multiply">
                                </button>
                                
                                <!-- Gallery Thumbs -->
                                @foreach ($data->images as $index => $image)
                                    @php
                                        $imgPath = $image->image_path ? 'storage/' . $image->image_path : null;
                                        $imgExists = $imgPath && file_exists(public_path($imgPath));
                                    @endphp

                                    <button type="button"
                                        onclick="changeImage('{{ $imgExists ? asset($imgPath) : asset('assets/images/no-image-available.png') }}', this, {{ $index + 1 }})"
                                        class="thumbnail-btn flex-shrink-0 w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden border-2 border-transparent bg-gray-50 flex items-center justify-center transition-all duration-200 outline-none hover:border-blue-300 hover:shadow-sm focus:border-blue-300">
                                        <img src="{{ $imgExists ? asset($imgPath) : asset('assets/images/no-image-available.png') }}"
                                        class="w-full h-full object-contain p-2 mix-blend-multiply">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right: Product Info -->
                <div class="flex flex-col h-full py-2 min-w-0">

                    <div class="mb-3">
                        @foreach($data->categories as $cat)
                            <a href="{{ route('category-product', $cat->slug) }}"
                                class="text-sm font-semibold tracking-wider text-blue-600 uppercase inline-block hover:underline">
                                {{ $cat->category_name }}
                            </a>@if(!$loop->last)<span class="text-gray-400 mx-1">,</span>@endif
                        @endforeach
                    </div>

                    <div x-data="{ copied: false }" class="flex items-start justify-between gap-4 mb-4">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight break-words">
                            {{ $data->name }}
                        </h1>
                        <button
                            @click="navigator.clipboard.writeText('{{ $data->name }}'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="flex-shrink-0 p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200"
                            title="Salin Nama Produk">
                            <i class='bx transition-all duration-200'
                                :class="copied ? 'bx-check text-green-500' : 'bx-copy-alt'"></i>
                        </button>
                    </div>

                    <div class="flex items-end gap-3 mb-8">
                        <span class="text-3xl font-extrabold tracking-tight text-gray-900">
                            Rp{{ number_format($data->price, 0, ',', '.') }}
                        </span>
                        @if($data->stock > 0)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mb-1.5 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                Tersedia
                            </span>
                        @endif
                    </div>

                    <div class="border-t border-b border-gray-100 py-6 mb-8">
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Detail Produk</h3>
                        <div class="prose prose-sm text-gray-600 text-base max-w-none break-words">
                            {!! $data->description !!}
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-auto">
                        @if ($data->stock == 0)
                            <div
                                class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                    <i class='bx bx-error-circle text-xl'></i>
                                </div>
                                <div>
                                    <p class="font-semibold">Stok Habis</p>
                                    <p class="text-sm text-red-600">Maaf, produk ini saat ini tidak tersedia.</p>
                                </div>
                            </div>
                        @else
                            <a href="https://wa.me/6289650710460?text=Halo%20LF%20Store%2C%20apakah%20produk%20*{{ $data->name }}*%20masih%20ada%3F%0A%0ATautan%3A%20{{ url()->current() }}"
                                target="_blank"
                                class="group flex items-center justify-center w-full gap-3 bg-gray-900 hover:bg-black text-white px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-300 shadow-[0_4px_14px_0_rgb(0,0,0,0.2)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.23)] hover:-translate-y-0.5">
                                <span>Pesan via WhatsApp</span>
                                <i class='bx bxl-whatsapp text-2xl group-hover:scale-110 transition-transform'></i>
                            </a>
                            <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-1">
                                <i class='bx bx-shield-quarter'></i> Pesan dengan aman melalui WhatsApp admin resmi
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Suggested Products Section -->
        @if ($suggestedProduct->isNotEmpty())
            <div class="mt-24 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-8">
                    Anda Mungkin Juga Suka
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($suggestedProduct as $suggested)
                        @php
                            $sPath = $suggested->image_thumbnail
                                ? 'storage/' . $suggested->image_thumbnail
                                : null;

                            $sExists = $sPath && file_exists(public_path($sPath));
                        @endphp

                        <div
                            class="group flex flex-col bg-white rounded-3xl border border-gray-100/60 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-blue-100 transition-all duration-300">

                            <a href="{{ route('detail', $suggested->slug) }}"
                                class="relative aspect-square overflow-hidden bg-gray-50/50 pt-2 px-2 flex items-center justify-center">

                                @if($sExists)
                                    <img src="{{ asset($sPath) }}" alt="{{ $suggested->name }}"
                                        class="object-cover w-full h-full rounded-2xl group-hover:scale-105 transition-transform duration-700 ease-in-out mix-blend-multiply">
                                @else
                                    <img src="{{ asset('assets/images/no-image-available.png') }}" alt="No Image"
                                        class="object-cover w-full h-full rounded-2xl opacity-80">
                                @endif

                            </a>

                            <div class="p-4 sm:p-5 flex flex-col flex-1">
                                <h3
                                    class="text-sm sm:text-[15px] font-medium text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-600 transition-colors mb-2">
                                    <a href="{{ route('detail', $suggested->slug) }}">
                                        {{ $suggested->name }}
                                    </a>
                                </h3>

                                <div class="mt-auto pt-3 items-center justify-between border-t border-gray-50">
                                    <p class="text-sm text-gray-500">Harga</p>
                                    <p class="text-base sm:text-[17px] font-bold text-gray-900 tracking-tight">
                                        Rp{{ number_format($suggested->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <!-- Clean Modern Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8 pt-16 pb-8 font-sans">
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

            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Thumbnail Image Slider & Switcher Logic
        const mainImage = document.getElementById('currentImage');
        const container = document.getElementById('thumbnail-container');
        let currentIndex = 0;
        let thumbnails = [];
        let totalImages = 0;

        function updateMainArrows() {
            const leftBtn = document.getElementById('main-left-btn');
            const rightBtn = document.getElementById('main-right-btn');

            if (leftBtn && rightBtn) {
                if (totalImages <= 1) {
                    leftBtn.style.display = 'none';
                    rightBtn.style.display = 'none';
                } else {
                    leftBtn.disabled = currentIndex === 0;
                    rightBtn.disabled = currentIndex === totalImages - 1;
                }
            }
        }

        function changeImage(src, btnElement, index) {
            if (index !== undefined) {
                currentIndex = index;
            }

            // Fade effect for main image
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = '1';
            }, 150);

            // Update active state on thumbnails
            if (thumbnails.length === 0) {
                thumbnails = document.querySelectorAll('.thumbnail-btn');
            }

            thumbnails.forEach(btn => {
                btn.classList.remove('border-blue-600');
                btn.classList.add('border-transparent');
            });
            btnElement.classList.add('border-blue-600');
            btnElement.classList.remove('border-transparent');

            // Scroll thumbnail into view
            btnElement.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });

            updateMainArrows();
        }

        function prevImage() {
            if (thumbnails.length === 0) {
                thumbnails = document.querySelectorAll('.thumbnail-btn');
            }
            if (currentIndex > 0) {
                const prevThumb = thumbnails[currentIndex - 1];
                const src = prevThumb.querySelector('img').src;
                changeImage(src, prevThumb, currentIndex - 1);
            }
        }

        function nextImage() {
            if (thumbnails.length === 0) {
                thumbnails = document.querySelectorAll('.thumbnail-btn');
            }
            if (currentIndex < totalImages - 1) {
                const nextThumb = thumbnails[currentIndex + 1];
                const src = nextThumb.querySelector('img').src;
                changeImage(src, nextThumb, currentIndex + 1);
            }
        }

        window.addEventListener('load', () => {
            thumbnails = document.querySelectorAll('.thumbnail-btn');
            totalImages = thumbnails.length;
            updateMainArrows();
        });
    </script>
</body>

</html>