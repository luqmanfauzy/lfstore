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
    <meta property="og:image" content="{{ asset('storage/' . $data->image_thumbnail) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    {{-- tailwind --}}
    @vite('resources/css/app.css')
    {{-- google font poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- tailwind css --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- boxicon --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .bordered {
            border: 1px solid black;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Poppins", serif;
        }
    </style>
</head>

<body class="pt-5">
    <!-- Navigation -->
    <nav class="bg-black shadow fixed top-0 left-0 w-full z-50">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4 py-2">
            <div class="flex items-center ms-2">
                <a href="{{ route('home') }}">
                    <h3 class="text-2xl lg:text-3xl font-bold text-custom-light-gray drop-shadow-lg">
                        LF Store
                    </h3>
                </a>
            </div>

            <div class="hidden md:flex space-x-4">
                <a href="{{ route('home') }}" class="text-white hover:text-gray-500">Beranda</a>
                <a href="{{ route('catalog') }}" class="text-white hover:text-gray-500">Katalog</a>
                {{-- dropdown category --}}
                <div class="dropdown">
                    <a class="dropdown-toggle text-white text-decoration-none" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                           <li><a class="dropdown-item" href="{{ route('category-product', $category->slug) }}">{{ $category->category_name }}</a></li> 
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('home') }}" class="text-white hover:text-gray-500">Tentang Kami</a>
            </div>

            <button id="menu-button"
                class="md:hidden p-2 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="md:hidden hidden">
            <div class="flex flex-col p-4 space-y-2 bg-white border-t border-gray-200">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-black">Beranda</a>
                <a href="{{ route('catalog') }}" class="text-gray-700 hover:text-black">Katalog</a>
                {{-- dropdown category --}}
                <div class="dropdown">
                    <a class="dropdown-toggle text-gray-700 text-decoration-none" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                           <li><a class="dropdown-item" href="{{ route('category-product', $category->slug) }}">{{ $category->category_name }}</a></li> 
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-black">Tentang Kami</a>
            </div>
        </div>
    </nav>

    <div class="lg:grid grid-cols-3 gap-2">
        <div class="col-span-2 ">
            <div class="flex justify-center items-center mb-8 mt-12">
                <h2 class="text-3xl font-semibold">Detail Produk</h2>
            </div>
            <section class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md border-2 mt-2">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Image Carousel Section -->
                    <div class="relative">
                        <!-- Main Image -->
                        <div id="mainImage" class="w-full aspect-square overflow-hidden">
                            <img id="currentImage" src="{{ asset('storage/' . $data->image_thumbnail) }}"
                                class="w-full h-full object-cover" alt="{{ $data->name }}">
                        </div>

                        @php
                            $images = $data->images;
                            $imageCount = 1 + count($images);
                        @endphp

                        @if($imageCount < 6)
                            <script>
                                window.addEventListener('DOMContentLoaded', function () {
                                    hideButtonNavigation();
                                });
                            </script>
                        @endif

                        <!-- Thumbnail Navigation with Carousel Buttons -->
                        <div class="relative mt-4 w-full">
                            <!-- Left Button -->
                            <button type="button"
                                class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-black hover:text-white text-gray-900 rounded-full shadow p-2 transition disabled:opacity-50"
                                onclick="scrollThumbnails(-1)" id="thumb-left-btn" aria-label="Scroll left">
                                <!-- SVG Arrow Left -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <!-- Thumbnails Wrapper -->
                            <div id="thumbnail-container" class="overflow-x-auto pb-2 scroll-smooth">
                                <div class="flex flex-nowrap space-x-2">
                                    <!-- Main Thumbnail -->
                                    <div class="carousel-thumb flex-shrink-0 cursor-pointer border-2 border-transparent hover:border-black rounded-lg"
                                        onclick="changeImage('{{ asset('storage/' . $data->image_thumbnail) }}')">
                                        <img src="{{ asset('storage/' . $data->image_thumbnail) }}"
                                            class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 object-cover rounded-lg">
                                    </div>
                                    <!-- Additional Images -->
                                    @foreach ($data->images as $image)
                                        <div class="carousel-thumb flex-shrink-0 cursor-pointer border-2 border-transparent hover:border-black rounded-lg"
                                            onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 object-cover rounded-lg">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right Button -->
                            <button type="button"
                                class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-black hover:text-white text-gray-900 rounded-full shadow p-2 transition disabled:opacity-50"
                                onclick="scrollThumbnails(1)" id="thumb-right-btn" aria-label="Scroll right">
                                <!-- SVG Arrow Right -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Product Details Section -->
                    <div class="space-y-4 h-100">
                        <!-- Product Name -->
                        <h1 class="text-2xl sm:text-3xl font-semibold" title="{{ $data->name }}">
                            {{ $data->name }}
                        </h1>

                        <hr>

                        <!-- Category -->
                        <p class="text-sm sm:text-lg text-gray-600 flex items-center">
                            <i class="fa-solid fa-tags me-1"></i>
                            <a href="{{ route('category-product', $data->category->slug) }}">
                                : {{ $data->category->category_name }}
                            </a>
                        </p>

                        <!-- Price -->
                        <p class="text-2xl font-semibold text-black">
                            Rp {{ number_format($data->price, 0, ',', '.') }}
                        </p>

                        {{-- description --}}
                        <div class="prose max-w-none text-sm">
                            <h3 class="text-xl font-semibold mb-2">Deskripsi Produk</h3>
                            <hr class="mb-2">
                            {!! $data->description !!}
                        </div>

                        <!-- check if the product is out of stock -->
                        @if ($data->stock == 0)
                            <div
                                class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md flex items-center space-x-2 animate-pulse">
                                <i class="fa-solid fa-triangle-exclamation text-red-500 text-xl"></i>
                                <span class="font-semibold text-md sm:text-lg">Maaf, produk ini sedang
                                    <strong>HABIS</strong> 😢</span>
                            </div>
                        @endif

                        {{-- order va whatsapp --}}
                        @if ($data->stock > 0)
                            <a href="https://wa.me/6289650710460?text=Halo%20apakah%20{{ $data->name }}%20masih%20ada?%0A%0ALihat%20produk%20di:%20{{ url()->current() }}/"
                                class="bg-green-600 text-white block px-6 py-3 rounded-lg shadow hover:bg-green-700 text-center mt-3"
                                target="_blank">
                                Pesan via Whatsapp
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>

                </div>
            </section>
        </div>

        <div class="hidden lg:block w-full mx-auto ">
            <div class="flex justify-center items-center mt-12">
                <h2 class="text-3xl font-semibold">Kategori</h2>
            </div>

            {{-- category --}}
            <section class="mx-auto bg-white p-6 rounded-lg mt-2 ">
                <div class="w-full mx-auto">

                    @foreach ($categories as $category)
                        <div x-data="{ open: false }" class="mb-2">
                            <!-- Tombol kategori -->
                            <button @click="open = !open"
                                class="w-full bg-black text-white px-4 py-2 flex justify-between items-center">
                                <span>{{ $category->category_name }}</span>
                                <span :class="open ? 'rotate-180' : ''" class="transition-transform">
                                    &#9660;
                                </span>
                            </button>

                            <!-- Daftar produk -->
                            <ul x-show="open" x-collapse class="bg-gray-100 px-4 py-2">
                                @forelse ($category->products as $product)
                                    <a href="{{ route('detail', $product->slug) }}">
                                        <li class="py-1 border-b whitespace-nowrap overflow-hidden text-ellipsis">
                                            {{ $product->name }}
                                        </li>
                                    </a>
                                @empty
                                    <li class="py-1 text-gray-500">Tidak ada produk</li>
                                @endforelse
                            </ul>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    @if ($suggestedProduct->isNotEmpty())
        <div class="flex justify-center items-center mb-8 mt-12">
            <h2 class="text-3xl font-semibold">Suggested Product</h2>
        </div>

        {{-- suggested products --}}
        <section class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md border-2 mt-2 mb-16">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($suggestedProduct as $data)
                    {{-- card product --}}
                    <a href="{{ route('detail', $data->slug) }}">
                        <div
                            class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 cursor-pointer h-[350px] flex flex-col">
                            <!-- Gambar Produk -->
                            <img src="{{ asset('storage/' . $data->image_thumbnail) }}" alt="{{ $data->name }}"
                                class="w-full h-40 object-cover">

                            <!-- Konten Produk -->
                            <div class="p-3 flex-grow flex flex-col justify-between">
                                <div>
                                    <p class="font-semibold text-md md:text-lg mb-2 line-clamp-2" title="{{ $data->name }}">
                                        {{ $data->name }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap justify-between items-center">
                                    <span class="text-lg font-bold text-black mb-2 sm:mt-2">
                                        Rp{{ number_format($data->price, 0, ',', '.') }}
                                    </span>
                                    <span
                                        class="text-xs text-white rounded-full bg-black p-2 px-4 w-full sm:w-auto text-center">
                                        detail <i class="fa-solid fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <div class="lg:hidden my-20">
        <div class="flex justify-center items-center">
            <h2 class="text-3xl font-semibold">Kategori</h2>
        </div>

        {{-- category --}}
        <section class="max-w-6xl mx-auto bg-white p-6 rounded-lg mt-2">
            <div class="w-full max-w-2xl mx-auto">

                @foreach ($categories as $category)
                    <div x-data="{ open: false }" class="mb-2">
                        <!-- Tombol kategori -->
                        <button @click="open = !open"
                            class="w-full bg-black text-white px-4 py-2 flex justify-between items-center">
                            <span>{{ $category->category_name }}</span>
                            <span :class="open ? 'rotate-180' : ''" class="transition-transform">
                                &#9660;
                            </span>
                        </button>

                        <!-- Daftar produk -->
                        <ul x-show="open" x-collapse class="bg-gray-100 px-4 py-2">
                            @forelse ($category->products as $product)
                                <a href="{{ route('detail', $product->slug) }}">
                                    <li class="py-1 border-b whitespace-nowrap overflow-hidden text-ellipsis">
                                        {{ $product->name }}
                                    </li>
                                </a>
                            @empty
                                <li class="py-1 text-gray-500">Tidak ada produk</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <footer class="bg-black text-white p-6">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-4 items-start">
            <!-- Logo & Nama -->
            <div>
                <p class="text-3xl font-bold mb-2">LF Store</p>
                <span class="text-gray-300">Tampil stylish, hidup lebih percaya diri.</span>
            </div>

            <!-- Navigasi -->
            <div class="flex flex-col md:flex-row md:justify-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="hover:text-gray-300">Home</a>
                <a href="{{ route('home') }}" class="hover:text-gray-300">About</a>
                <a href="{{ route('catalog') }}" class="hover:text-gray-300">Products</a>
            </div>

            <!-- Ikon Sosial -->
            <div class="flex justify-start md:justify-end space-x-4 text-2xl">
                <a href="mailto:luqmannfauzy46@gmail.com" title="Email">
                    <i class='bx bxl-gmail'></i>
                </a>
                <a href="https://wa.me/6289650710460" target="_blank" title="WhatsApp">
                    <i class='bx bxl-whatsapp'></i>
                </a>
                <a href="https://maps.app.goo.gl/EWj82GEcHddkXy3V7" target="_blank" title="Lokasi">
                    <i class='bx bx-map'></i>
                </a>
            </div>
        </div>

        <!-- Bawah -->
        <div class="mt-6 border-t border-gray-700 pt-4 text-center text-sm text-gray-400">
            Made with ❤️ by LF Store © <span id="currentYear"></span>. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        lucide.createIcons();

        //navigation image product
        function changeImage(src) {
            document.getElementById('currentImage').src = src;
        }

        function scrollThumbnails(direction) {
            const container = document.getElementById('thumbnail-container');
            const thumb = container.querySelector('.carousel-thumb');
            const scrollAmount = thumb ? thumb.offsetWidth + 8 : 100; // 8px = space-x-2
            container.scrollBy({ left: direction * scrollAmount * 2, behavior: 'smooth' });
        }

        function updateNavButtons() {
            const container = document.getElementById('thumbnail-container');
            const leftBtn = document.getElementById('thumb-left-btn');
            const rightBtn = document.getElementById('thumb-right-btn');
            leftBtn.disabled = container.scrollLeft <= 0;
            rightBtn.disabled = container.scrollLeft + container.clientWidth >= container.scrollWidth - 1;
        }

        function hideButtonNavigation() {
            const leftBtn = document.getElementById('thumb-left-btn');
            const rightBtn = document.getElementById('thumb-right-btn');
            leftBtn.style.display = 'none';
            rightBtn.style.display = 'none';
        }

        document.getElementById('thumbnail-container').addEventListener('scroll', updateNavButtons);
        window.addEventListener('load', updateNavButtons);
    </script>

</body>

</html>