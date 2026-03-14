<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Mainan Semarang 88</title>
    @vite('resources/css/app.css')

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- tailwind css --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
    <nav class="bg-blue-500 shadow fixed top-0 left-0 w-full z-50">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4 py-2">
            <div class="flex items-center ms-2">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo/Toy Store Semarang 88.png') }}" alt="Logo" height="100"
                    width="80">
                </a>
            </div>

            <div class="hidden md:flex space-x-4">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-500">Beranda</a>
                <a href="{{ route('catalog') }}" class="text-white hover:text-blue-500">Katalog</a>
                <a href="#category" class="text-white hover:text-blue-500">Kategori Produk</a>
                <a href="#tentang" class="text-white hover:text-blue-500">Tentang Kami</a>
                <a href="#kontak" class="text-white hover:text-blue-500">Kontak</a>
            </div>

            <button id="menu-button"
                class="md:hidden p-2 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="md:hidden hidden">
            <div class="flex flex-col p-4 space-y-2 bg-white border-t border-gray-200">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500">Beranda</a>
                <a href="{{ route('catalog') }}" class="text-gray-700 hover:text-blue-500">Katalog</a>
                <a href="#category" class="text-gray-700 hover:text-blue-500">Kategori Produk</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-500">Tentang Kami</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-500">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div id="carouselExampleInterval" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
                <img src="{{ asset('assets/images/1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="{{ asset('assets/images/3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- banner --}}
    <div class="w-full p-6 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-center shadow-lg">
        <h1 class="text-4xl font-bold animate-bounce">Selamat Datang di Toko Mainan Semarang 88😊</h1>
        <p class="mt-4 text-lg">Temukan berbagai mainan berkualitas dengan harga terbaik!</p>
    </div>

    <!-- Keunggulan Toko -->
    <section class="py-8 bg-gray-50 mt-3">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div
                    class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-hand-holding-dollar text-4xl text-blue-500 mb-2"></i>
                    <p class="text-center text-gray-700">Harga Terjangkau</p>
                </div>
                <div
                    class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-award text-4xl text-blue-500 mb-2"></i>
                    <p class="text-center text-gray-700">Produk Berkualitas</p>
                </div>
                <div
                    class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-boxes-stacked text-4xl text-blue-500 mb-2"></i>
                    <p class="text-center text-gray-700">Beragam Pilihan</p>
                </div>
                <div
                    class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-star text-4xl text-blue-500 mb-2"></i>
                    <p class="text-center text-gray-700">Layanan Terbaik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Toys -->
    <section id="category" class="py-8 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Kategori Mainan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ route('category-product', 2) }}"
                    class="bg-blue-100 p-4 rounded-lg text-center hover:shadow-lg transition duration-300">
                    <div class="bg-blue-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-car text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Mainan Kendaraan</h3>
                </a>
                <a href="{{ route('category-product', 3) }}"
                    class="bg-pink-100 p-4 rounded-lg text-center hover:shadow-lg transition duration-300">
                    <div class="bg-pink-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                        👩‍🦰
                    </div>
                    <h3 class="font-semibold text-lg">Perempuan</h3>
                </a>
                <a href="{{ route('category-product', 1) }}"
                    class="bg-green-100 p-4 rounded-lg text-center hover:shadow-lg transition duration-300">
                    <div class="bg-green-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-brain text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Mainan Edukatif</h3>
                </a>
                <a href="{{ route('category-product', 6) }}"
                    class="bg-purple-100 p-4 rounded-lg text-center hover:shadow-lg transition duration-300">
                    <div class="bg-purple-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-baby text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Bayi</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Category Aksesoris -->
    <section class="py-8 bg-teal-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Kategori Aksesoris</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ route('category-product', 4) }}"
                    class="bg-lime-100 p-4 rounded-lg text-center hover:shadow-lg transition duration-300">
                    <div class="bg-lime-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                        😎
                    </div>
                    <h3 class="font-semibold text-lg">Kacamata</h3>
                </a>
                <a href="{{ route('category-product', 5) }}"
                    class="bg-gray-100 p-4 rounded-lg text-center hover:shadow-lg transition duration-300">
                    <div class="bg-gray-200 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-socks text-gray-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Kaos Kaki</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="katalog" class="py-12 bg-white border">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Produk Unggulan</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($produkUnggulan as $data)
                    <a href="{{ route('detail', $data->id) }}">
                        <div
                            class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 cursor-pointer">
                            <img src="{{ asset('storage/' . $data->image_thumbnail) }}" height="100"
                                alt="Robot Pintar" class="w-full h-88 object-cover">
                            <div class="p-2">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-lg">{{ $data->name }}</h3>
                                    <span
                                        class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">{{ $data->category->category_name }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="text-lg font-bold text-indigo-600">Rp{{ number_format($data->price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-white rounded-pill bg-indigo-800 p-2 px-4">
                                        detail
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>  
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Informasi Toko -->
    <section id="tentang" class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/2 bg-indigo-50 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-4 text-indigo-700">Tentang Kami</h3>
                    <p class="mb-4">toko semarang 88 adalah toko yang berdiri sejak tahun 2011 yang menjual 
                        berbagai macam mainan dengan harga terjangkau dan memiliki mainan yg cukup 
                        lengkap
                    </p>
                </div>
                <div id="kontak" class="md:w-1/2 bg-indigo-50 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-4 text-indigo-700" id="kontak">Informasi Kontak</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-indigo-600 mt-1 mr-3"></i>
                            <p>Jl Indrakila RT 3 no 3 Gn. Samarinda, baru, Kec. Balikpapan Utara, Kota Balikpapan, Kalimantan Timur 76114</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-brands fa-whatsapp text-indigo-600 mr-3"></i>
                            <p>089650710460</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-brands fa-instagram text-indigo-600 mr-3"></i>
                            <p>mainanbalikpapan</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-indigo-600 mr-3"></i>
                            <p>Buka Setiap Hari: 10.00 - 21.30 WIB (tutup jika waktu solat)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
