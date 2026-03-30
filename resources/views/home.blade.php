<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ogTitle }}</title>
    {{-- meta deskripsi --}}
    <meta name="description" content="{{ $description }}">
    {{-- meta keywords --}}
    <meta name="keywords" content="{{ $keywords }}">
    {{-- meta author --}}
    <meta name="author" content="{{ $ogTitle }}">
    {{-- open graph --}}
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('assets/images/openGraphBanner.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    {{-- favicon --}}
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    {{-- tailwind css --}}
    @vite('resources/css/app.css')
    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- boxicon --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Custom Button */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--dark);
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid var(--dark);
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--dark);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 25s infinite ease-in-out reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, 30px) rotate(180deg); }
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            animation: fadeInDown 0.8s ease;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 2vw, 1.3rem);
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.6s both;
        }

        .hero-image-wrapper {
            position: relative;
            animation: fadeInRight 1s ease 0.4s both;
        }

        .hero-image {
            width: 100%;
            max-width: 500px;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: perspective(1000px) rotateY(-15deg) rotateX(5deg);
            transition: transform 0.5s ease;
        }

        .hero-image:hover {
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 12px 24px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            animation: floatCard 3s ease-in-out infinite;
        }

        .floating-card-1 {
            top: 10%;
            left: -20px;
            animation-delay: 0s;
        }

        .floating-card-2 {
            bottom: 20%;
            right: -20px;
            animation-delay: 1.5s;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Marquee */
        .marquee-container {
            background: var(--dark);
            padding: 20px 0;
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        
        .marquee-wrapper {
            display: flex;
            width: fit-content;
            animation: marquee 25s linear infinite;
        }
        
        /* Animasi lebih cepat untuk mobile */
        @media (max-width: 768px) {
            .marquee-wrapper {
                animation: marquee 15s linear infinite;
            }
        }
        
        @media (max-width: 480px) {
            .marquee-wrapper {
                animation: marquee 10s linear infinite;
            }
        }
        
        .marquee-content {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }
        
        .marquee-item {
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            white-space: nowrap;
        }
        
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Section Styles */
        section {
            padding: 100px 0;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .section-label {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            margin-bottom: 16px;
            color: var(--dark);
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
        }

        /* About Section */
        .about-section {
            background: white;
        }

        .about-image {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .about-image::before {
            content: '';
            position: absolute;
            inset: -10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 32px;
            z-index: -1;
            opacity: 0.3;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 40px;
        }

        .stat-item {
            text-align: center;
            padding: 24px;
            background: var(--light);
            border-radius: 16px;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            color: var(--gray);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Product Cards */
        .product-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
        }

        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: var(--secondary);
            color: white;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }

        .product-info {
            padding: 24px;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .product-btn {
            width: 100%;
            padding: 12px;
            background: var(--dark);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .product-btn:hover {
            background: var(--primary);
            transform: scale(1.02);
        }

        /* Category Section */
        .category-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-overlay {
            background: linear-gradient(to top, rgba(99, 102, 241, 0.9) 0%, transparent 80%);
        }

        .category-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .category-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-bottom: 16px;
        }

        .category-link {
            color: white;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .category-card:hover .category-link {
            opacity: 1;
            transform: translateY(0);
        }

        /* Features */
        .feature-card {
            background: white;
            padding: 40px 32px;
            border-radius: 24px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(99, 102, 241, 0.3);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 32px;
            color: white;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .feature-desc {
            color: var(--gray);
            font-size: 15px;
            line-height: 1.6;
        }

        /* Testimonials */
        .testimonial-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .testimonial-card {
            background: white;
            padding: 32px;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .testimonial-text {
            font-size: 16px;
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
        }

        .author-info h4 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .author-info p {
            font-size: 14px;
            color: var(--gray);
        }

        .stars {
            color: #fbbf24;
            margin-bottom: 16px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .cta-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
        }

        .cta-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            margin-bottom: 16px;
        }

        .cta-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-white {
            background: white;
            color: var(--primary);
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 80px 0 40px;
        }

        .footer-brand {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-desc {
            color: #94a3b8;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .social-links {
            display: flex;
            gap: 16px;
        }

        .social-links a {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-links h4 {
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .footer-links a {
            display: block;
            color: #94a3b8;
            text-decoration: none;
            margin-bottom: 12px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 60px;
            padding-top: 30px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        /* Floating WhatsApp */
        .wa-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25d366;
            color: white;
            padding: 16px 24px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .wa-float:hover {
            transform: translateY(-5px) scale(1.05);
            color: white;
            box-shadow: 0 15px 40px rgba(37, 211, 102, 0.5);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-section {
                padding: 120px 0 80px;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image-wrapper {
                margin-top: 60px;
            }

            .floating-card {
                display: none;
            }

            .about-stats {
                grid-template-columns: 1fr;
            }
        }

        /* Smooth scroll offset for fixed header if needed */
        :target {
            scroll-margin-top: 80px;
        }
    </style>
</head>

<body id="home">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <div class="hero-badge">
                        <i class='bx bxs-hot'></i>
                        Best Seller di Balikpapan
                    </div>
                    <h1 class="hero-title font-display">
                        Frame Bervariasi,<br>
                        <span class="text-warning">Harga</span> Bersahabat
                    </h1>
                    <p class="hero-subtitle">
                        Upgrade gaya lo tanpa bikin dompet nangis! Koleksi kacamata kece mulai dari 15ribuan. 
                        Dari yang anti radiasi sampe photocromic—semua ada di sini!
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('catalog') }}" class="btn-primary-custom text-decoration-none">
                            <i class='bx bx-shopping-bag'></i>
                            Lihat Koleksi
                        </a>
                        <a href="https://wa.me/6289650710460" target="_blank" class="btn-outline-custom text-decoration-none bg-white text-dark">
                            <i class='bx bxl-whatsapp'></i>
                            Chat Admin
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-wrapper text-center">
                    <img src="{{ asset('assets/images/kacamata1.jpg') }}" alt="Kacamata Stylish" class="hero-image">
                    <div class="floating-card floating-card-1">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success rounded-circle p-2 text-white">
                                <i class='bx bx-check'></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">1000+ Terjual</div>
                                <!--<small class="text-muted">Bulan ini</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="floating-card floating-card-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning rounded-circle p-2 text-white">
                                <i class='bx bxs-star'></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Kualitas Terpercaya</div>
                                <!--<small class="text-muted">Dari 500+ review</small>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marquee -->
    <div class="marquee-container">
        <div class="marquee-wrapper">
            <!-- Set pertama -->
            <div class="marquee-content">
                <div class="marquee-item"><i class='bx bxs-purchase-tag-alt'></i> Harga Bersahabat</div>
                <div class="marquee-item"><i class='bx bxs-check-shield'></i> Kualitas terjamin</div>
                <div class="marquee-item"><i class='bx bxs-chat'></i> Fast Response</div>
                <div class="marquee-item"><i class='bx bxs-truck'></i> COD Available</div>
                <div class="marquee-item"><i class='bx bxs-heart'></i> Model Kekinian</div>
            </div>
            <!-- Set kedua - duplikat exact sama untuk seamless loop -->
            <div class="marquee-content">
                <div class="marquee-item"><i class='bx bxs-purchase-tag-alt'></i> Harga Bersahabat</div>
                <div class="marquee-item"><i class='bx bxs-check-shield'></i> Kualitas terjamin</div>
                <div class="marquee-item"><i class='bx bxs-chat'></i> Fast Response</div>
                <div class="marquee-item"><i class='bx bxs-truck'></i> COD Available</div>
                <div class="marquee-item"><i class='bx bxs-heart'></i> Model Kekinian</div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{ asset('assets/images/kacamata banner.png') }}" alt="LF Store">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-header text-lg-start">
                        <span class="section-label">Tentang Kami</span>
                        <h2 class="section-title font-display">Yang Asik,<br>Yang Asli,<br>Yang di Balikpapan</h2>
                        <p class="section-subtitle">
                            LF Store hadir buat kamu yang pengen tampil beda tanpa perlu keluarin duit gede. 
                            Kita percaya gaya itu nggak harus mahal—yang penting cocok sama vibes lo!
                        </p>
                    </div>
                    <p class="text-muted mb-4">
                        Dari mulai kacamata anti radiasi buat yang kerja di depan laptop seharian, 
                        sampe kacamata photocromic yang otomatis gelap pas kena matahari. 
                        Semua frame dirancang nyaman dipakai seharian, cocok buat aktivitas apapun.
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Varian Frame</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">5K+</div>
                            <div class="stat-label">Customer Happy</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">4.9</div>
                            <div class="stat-label">Rating Review</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Best Seller</span>
            <h2 class="section-title font-display">Yang Lagi Rame Dibeli</h2>
            <p class="section-subtitle">
                Produk-produk ini paling banyak dicari sama customer kita. 
                Buruan check out sebelum kehabisan!
            </p>
        </div>
        
        <!-- Featured Products - 3 Andalan -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h3 class="h5 mb-4 text-center text-md-start" style="color: var(--gray); font-weight: 600;">
                    <i class='bx bxs-crown text-warning me-2'></i>Produk Andalan
                </h3>
            </div>
            
            <!-- Produk 1 -->
            <div class="col-12 col-md-4">
                <div class="product-card featured-card">
                    <div class="product-image-wrapper">
                        <img src="https://lfstore.online/assets/images/products/kacamata-anti-radiasi-kotak-frame-hitam-003.jpg" 
                             alt="Kacamata Photocromic 2 in 1" 
                             class="product-image"
                             onerror="this.src='{{ asset('assets/images/favorit1.webp') }}'">
                        <span class="product-badge badge-hot">
                            <i class='bx bxs-fire'></i> Best Seller
                        </span>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Kacamata Photocromic 2 in 1 Anti Radiasi</h3>
                        <p class="product-desc">Frame kotak silver hitam, unisex, lensa photocromic + anti radiasi</p>
                        <div class="product-price">Rp35.000</div>
                        <div class="product-actions">
                            <a href="https://lfstore.online/detail-product/kacamata-photocromic-2-in-1-anti-radiasi-frame-kotak-silver-hitam-unisex-pc-10" 
                               class="product-btn btn-primary-custom text-decoration-none w-100">
                                <i class='bx bx-shopping-bag'></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk 2 -->
            <div class="col-12 col-md-4">
                <div class="product-card featured-card">
                    <div class="product-image-wrapper">
                        <img src="https://lfstore.online/assets/images/products/kacamata-anti-radiasi-kotak-frame-hitam-003.jpg" 
                             alt="Kacamata Anti Radiasi Kotak" 
                             class="product-image"
                             onerror="this.src='{{ asset('assets/images/favorit2.jpg') }}'">
                        <span class="product-badge badge-popular">
                            <i class='bx bxs-star'></i> Populer
                        </span>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Kacamata Anti Radiasi Kotak Frame Hitam</h3>
                        <p class="product-desc">Classic black frame, anti radiasi blue light, nyaman untuk kerja seharian</p>
                        <div class="product-price">Rp15.000</div>
                        <div class="product-actions">
                            <a href="https://lfstore.online/detail-product/kacamata-anti-radiasi-kotak-frame-hitam-003" 
                               class="product-btn btn-primary-custom text-decoration-none w-100">
                                <i class='bx bx-shopping-bag'></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk 3 -->
            <div class="col-12 col-md-4">
                <div class="product-card featured-card">
                    <div class="product-image-wrapper">
                        <img src="https://lfstore.online/assets/images/products/kacamata-style-coklat-kcs-003.jpg" 
                             alt="Kacamata Style Coklat" 
                             class="product-image"
                             onerror="this.src='{{ asset('assets/images/favorit3.jpg') }}'">
                        <span class="product-badge badge-new">
                            <i class='bx bxs-zap'></i> New Style
                        </span>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Kacamata Style Coklat KCS-003</h3>
                        <p class="product-desc">Frame coklat trendy, desain modern, cocok untuk daily wear</p>
                        <div class="product-price">Rp15.000</div>
                        <div class="product-actions">
                            <a href="https://lfstore.online/detail-product/kacamata-style-coklat-kcs-003" 
                               class="product-btn btn-primary-custom text-decoration-none w-100">
                                <i class='bx bx-shopping-bag'></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex align-items-center gap-3">
                    <div class="flex-grow-1" style="height: 1px; background: linear-gradient(90deg, transparent, var(--gray), transparent);"></div>
                    <span class="text-muted small">Atau pilih dari koleksi lainnya</span>
                    <div class="flex-grow-1" style="height: 1px; background: linear-gradient(90deg, transparent, var(--gray), transparent);"></div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('catalog') }}" class="btn-primary-custom text-decoration-none">
                Lihat Semua Produk
                <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>
    </div>
</section>

    <!-- Categories Section -->
    <section id="category">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Koleksi</span>
                <h2 class="section-title font-display">Pilih Sesuai Kebutuhan Lo</h2>
                <p class="section-subtitle">
                    Setiap kategori dirancang buat kebutuhan spesifik. 
                    Pilih yang paling cocok sama lifestyle lo!
                </p>
            </div>
            <div class="row g-4">
                <!-- Anti Radiasi -->
                <div class="col-md-4">
                    <div class="category-card" onclick="window.location.href='{{ route('category-product', 'kacamata-anti-radiasi') }}'">
                        <img src="{{ asset('assets/images/kacamata-anti-radiasi.jpg') }}" alt="Anti Radiasi">
                        <div class="category-overlay">
                            <h3 class="category-title">Anti Radiasi</h3>
                            <p class="category-desc">Lindungi mata dari blue light gadget. Cocok buat yang WFH atau main game.</p>
                            <span class="category-link">
                                Lihat Koleksi <i class='bx bx-right-arrow-alt'></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Photocromic -->
                <div class="col-md-4">
                    <div class="category-card" onclick="window.location.href='{{ route('category-product', 'kacamata-photocromic') }}'">
                        <img src="{{ asset('assets/images/kacamata-photocromic.jpg') }}" alt="Photocromic">
                        <div class="category-overlay">
                            <h3 class="category-title">Photocromic</h3>
                            <p class="category-desc">Otomatis gelap di luar ruangan, jernih di dalam. Praktis banget!</p>
                            <span class="category-link">
                                Lihat Koleksi <i class='bx bx-right-arrow-alt'></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Life style -->
                <div class="col-md-4">
                    <div class="category-card" onclick="window.location.href='{{ route('category-product', 'kacamata-style') }}'">
                        <img src="{{ asset('assets/images/kacamata style.jpeg') }}" alt="style">
                        <div class="category-overlay">
                            <h3 class="category-title">Life Style</h3>
                            <p class="category-desc">Upgrade penampilanmu dalam satu sentuhan. Simple tapi langsung beda!</p>
                            <span class="category-link">
                                Lihat Koleksi <i class='bx bx-right-arrow-alt'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Kenapa Kita?</span>
                <h2 class="section-title font-display">Bedanya Belanja di LF Store</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-glasses'></i>
                        </div>
                        <h3 class="feature-title">Pilihan Gila-gilaan</h3>
                        <p class="feature-desc">
                            Dari yang vintage sampe yang futuristic, kita punya semua. 
                            Update model tiap bulan biar lo nggak ketinggalan trend!
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <h3 class="feature-title">Harga Pelajar & Mahasiswa</h3>
                        <p class="feature-desc">
                            Mulai dari 15ribuan udah dapet frame kece. 
                            Nggak perlu nabung berbulan-bulan buat tampil stylish!
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-chat'></i>
                        </div>
                        <h3 class="feature-title">Fast Response</h3>
                        <p class="feature-desc">
                            Admin standby buat bantu pilihin model yang cocok buat lo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonial-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Testimoni</span>
                <h2 class="section-title font-display">Apa Kata Mereka?</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <p class="testimonial-text">
                            "Asli ini kacamata paling nyaman yang pernah gue pake! 
                            Udah gitu harganya murah banget. Temen-temen pada nanyain beli dimana 😂"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">R</div>
                            <div class="author-info">
                                <h4>Rina</h4>
                                <p>Mahasiswa Unmul</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star-half'></i>
                        </div>
                        <p class="testimonial-text">
                            "Beli yang anti radiasi buat kerja. Mata gue yang biasanya cepet capek, 
                            sekarang jadi lebih nyaman. Worth it banget sih!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">D</div>
                            <div class="author-info">
                                <h4>Dwi</h4>
                                <p>Freelancer Designer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <p class="testimonial-text">
                            "Anak gue suka banget sama frame yang lucu-lucu. 
                            Harganya affordable jadi bisa beli beberapa buat ganti-ganti. Adminnya juga ramah!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">Y</div>
                            <div class="author-info">
                                <h4>Yuni</h4>
                                <p>Ibu Rumah Tangga</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title font-display">Masih Ragu? Chat Dulu Aja!</h2>
                <p class="cta-subtitle">
                    Tanya-tanya dulu juga boleh kok. Admin kita standby buat bantu lo pilih frame yang paling cocok. 
                    Gratis konsultasi!
                </p>
                <a href="https://wa.me/6289650710460" target="_blank" class="btn-white text-decoration-none">
                    <i class='bx bxl-whatsapp'></i>
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-brand font-display">LF Store</div>
                    <p class="footer-desc">
                        Tempatnya cari kacamata kece di Balikpapan. 
                        Harga bersahabat, kualitas nggak kalah sama yang mahal!
                    </p>
                    <div class="social-links">
                        <a href="mailto:luqmannfauzy46@gmail.com"><i class='bx bxl-gmail'></i></a>
                        <a href="https://wa.me/6289650710460" target="_blank"><i class='bx bxl-whatsapp'></i></a>
                        <a href="https://maps.app.goo.gl/EWj82GEcHddkXy3V7" target="_blank"><i class='bx bx-map'></i></a>
                        <a href="#"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="footer-links">
                        <h4>Menu</h4>
                        <a href="#home">Home</a>
                        <a href="#about">Tentang</a>
                        <a href="#products">Produk</a>
                        <a href="#category">Kategori</a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="footer-links">
                        <h4>Koleksi</h4>
                        <a href="{{ route('category-product', 7) }}">Anti Radiasi</a>
                        <a href="{{ route('category-product', 10) }}">Photocromic</a>
                        <a href="{{ route('category-product', 11) }}">Anak-anak</a>
                        <a href="{{ route('catalog') }}">Semua Produk</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-links">
                        <h4>Kontak</h4>
                        <a href="https://maps.app.goo.gl/EWj82GEcHddkXy3V7" target="_blank">
                            <i class='bx bx-map-pin me-2'></i>Balikpapan, Kalimantan Timur
                        </a>
                        <a href="https://wa.me/6289650710460" target="_blank">
                            <i class='bx bxl-whatsapp me-2'></i>+62 896-5071-0460
                        </a>
                        <a href="mailto:luqmannfauzy46@gmail.com">
                            <i class='bx bx-envelope me-2'></i>luqmannfauzy46@gmail.com
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Made with <i class='bx bxs-heart text-danger'></i> by LF Store &copy; <span id="currentYear"></span>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp -->
    <a href="https://wa.me/6289650710460" target="_blank" class="wa-float text-decoration-none">
        <i class='bx bxl-whatsapp text-2xl'></i>
        <span>Chat Admin</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById("currentYear").textContent = new Date().getFullYear();
    </script>

</body>

</html>