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
    {{-- tailwind --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- google font --}}
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
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-500">Beranda</a>
                <a href="{{ route('catalog') }}" class="text-gray-700 hover:text-gray-500">Katalog</a>
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
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-500">Tentang Kami</a>
            </div>
        </div>
    </nav>

    <!-- Featured Products -->
    <section id="katalog" class="py-12 bg-white">
        <div class="container mx-auto px-4">

            <!-- Form Pencarian(Search) -->
            <div class="mb-14 max-w-xl mx-auto">
                <form action="{{ route('catalog') }}" method="GET" class="flex items-center">
                    <input type="text" name="query" placeholder="Cari produk..." value="{{ request('query') }}"
                        class="border border-gray-300 rounded-l-md p-2 w-full">
                    <button type="submit" class="bg-black text-white rounded-r-md px-4 py-2">Cari</button>
                </form>
            </div>

            <div class="flex justify-center items-center mb-8">
                <h2 class="text-3xl font-semibold">Katalog Produk</h2>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($allProduct as $data)

                    {{-- card product --}}
                    <a href="{{ route('detail', $data->slug) }}">
                        <div
                            class="bg-white  rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 cursor-pointer h-full flex flex-col">
                            <!-- Gambar Produk -->
                            <img src="{{ asset('storage/' . $data->image_thumbnail) }}" alt="{{ $data->name }}"
                                class="object-cover">

                            <!-- Konten Produk -->
                            <div class="p-3 flex-grow flex flex-col justify-between">
                                <div class="">
                                    <p class="font-semibold text-md md:text-lg line-clamp-3"
                                        title="{{ $data->name }}">
                                        {{ $data->name }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap justify-between items-center mt-6">
                                    <span class="text-lg font-bold black mb-2 sm:mt-2">
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

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $allProduct->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </section>

    {{-- Category --}}

    <div class="flex justify-center items-center mt-5">
        <h2 class="text-3xl font-semibold">Kategori</h2>
    </div>

    <section class="max-w-6xl mx-auto bg-white p-6 rounded-lg mt-2 mb-10">
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
    </script>
</body>

</html>
