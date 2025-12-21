<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Beranda | Rasa Priangan </title>
    
    <!-- Library Eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* === 1. DESIGN SYSTEM === */
        :root {
            --bg-dark: #0d0805;       /* Obsidian Brown */
            --bg-medium: #1b110b;     /* Espresso Base */
            --accent: #c0a080;        /* Gold Bronze */
            --accent-light: #f4ece2;  /* Silk Latte */
            --text-gold: #d4b996;
            --white: #ffffff;
            --glass: rgba(13, 8, 5, 0.94);
            --transition: all 0.6s cubic-bezier(0.77, 0, 0.175, 1);
        }

        /* === 2. RESET & GLOBAL === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-dark); 
            color: var(--accent-light); 
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        /* === 3. MOBILE-OPTIMIZED LOADING SCREEN === */
        #preloader {
            position: fixed;
            inset: 0;
            background: var(--bg-dark);
            z-index: 10000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .typewriter-box h1 {
            color: var(--accent);
            /* Ukuran sedang-besar yang pas di HP dan Laptop */
            font-size: clamp(2rem, 10vw, 3.5rem);
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid var(--accent);
            width: 0;
            animation: typing 2.5s steps(15, end) forwards, blink 0.5s step-end infinite;
            text-align: center;
        }

        .loader-subtext {
            margin-top: 20px;
            letter-spacing: clamp(5px, 2vw, 10px);
            font-size: clamp(0.6rem, 2vw, 0.75rem);
            text-transform: uppercase;
            color: var(--text-gold);
            opacity: 0;
            animation: fadeInUp 1s ease forwards 2.5s;
            text-align: center;
        }

        @keyframes typing { from { width: 0 } to { width: 100% } }
        @keyframes blink { 50% { border-color: transparent } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* === 4. PREMIUM NAVBAR & UNDERSCORE EFFECT === */
        nav {
            position: fixed;
            top: 0; width: 100%;
            padding: 30px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            transition: var(--transition);
        }

        nav.scrolled {
            background: var(--glass);
            padding: 18px 8%;
            backdrop-filter: blur(30px);
            border-bottom: 1px solid rgba(192, 160, 128, 0.1);
        }

        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            z-index: 1001;
        }

        .nav-links { display: flex; gap: 35px; list-style: none; align-items: center; }
        
        .nav-links a {
            text-decoration: none;
            color: var(--accent-light);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            transition: 0.3s;
            position: relative;
            padding: 8px 0;
        }

        /* EFEK TANDA _ (UNDERSCORE) HOVER GLOBAL */
        .nav-links a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            transform: translateX(-50%);
        }

        .nav-links a:hover::after { width: 100%; }
        .nav-links a:hover { color: var(--accent); }

        .mobile-toggle {
            display: none;
            cursor: pointer;
            z-index: 1001;
            color: var(--accent);
            font-size: 1.8rem; /* Ukuran ikon sedang-besar */
            padding: 5px;
        }

        /* === 5. CLEAN MOBILE NAVIGATION OVERLAY === */
        .nav-overlay {
            position: fixed;
            top: 0; right: -100%;
            width: 100%; height: 100vh;
            background: var(--bg-dark);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: var(--transition);
            z-index: 2000;
        }

        .nav-overlay.active { right: 0; }

        .close-menu {
            position: absolute;
            top: 35px; right: 8%;
            font-size: 2.2rem; /* Ikon close yang besar & mudah diklik */
            color: var(--accent);
            cursor: pointer;
            transition: 0.3s;
            padding: 10px;
        }
        .close-menu:hover { transform: rotate(90deg); color: var(--white); }

        .nav-overlay ul { list-style: none; text-align: center; width: 100%; }
        
        .nav-overlay li { 
            margin: 20px 0; 
            opacity: 0; 
            transform: translateY(20px);
            transition: 0.6s ease;
        }

        .nav-overlay.active li { opacity: 1; transform: translateY(0); }

        /* Staggered Delay */
        .nav-overlay li:nth-child(1) { transition-delay: 0.2s; }
        .nav-overlay li:nth-child(2) { transition-delay: 0.3s; }
        .nav-overlay li:nth-child(3) { transition-delay: 0.4s; }
        .nav-overlay li:nth-child(4) { transition-delay: 0.5s; }
        .nav-overlay li:nth-child(5) { transition-delay: 0.6s; }

        .nav-overlay a {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; /* Ukuran sedang di mobile */
            color: var(--accent-light);
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            padding: 10px;
        }
        
        .nav-overlay a:hover { color: var(--accent); letter-spacing: 2px; }

        .mobile-footer-info {
            position: absolute;
            bottom: 50px;
            text-align: center;
        }

        .mobile-socials {
            display: flex;
            justify-content: center;
            gap: 35px;
            color: var(--accent);
            font-size: 1.5rem; /* Ikon sosial media sedang */
            margin-bottom: 15px;
        }

        /* === 6. HERO SECTION === */
        .hero {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            padding: 0 8%;
            background: radial-gradient(circle at center, rgba(27, 17, 11, 0.2), var(--bg-dark)),
                        url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, var(--bg-dark) 25%, transparent);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
        }

        .hero-tagline {
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 8px;
            font-size: 0.75rem;
            margin-bottom: 25px;
            display: block;
            font-weight: 600;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 10vw, 6.5rem);
            line-height: 0.95;
            margin-bottom: 35px;
            color: var(--white);
        }

        .hero h1 span { color: var(--accent); font-style: italic; }

        .hero p {
            font-size: 1.1rem;
            max-width: 550px;
            line-height: 1.8;
            color: var(--accent-light);
            margin-bottom: 45px;
            opacity: 0.8;
            font-weight: 300;
        }

        .btn-primary {
            display: inline-block;
            background: var(--accent);
            color: var(--bg-dark);
            padding: 20px 45px;
            text-decoration: none;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-size: 0.8rem;
            transition: 0.4s;
            border: 1px solid var(--accent);
        }

        .btn-primary:hover { 
            background: transparent; 
            color: var(--accent); 
            transform: translateY(-5px);
        }

        /* === 7. CONTENT SECTION === */
        .content-section {
            padding: 120px 8%;
            background: linear-gradient(to bottom, var(--bg-dark), #0a0604);
        }

        .section-header {
            text-align: center;
            margin-bottom: 100px;
        }

        .section-header h2 { font-size: clamp(2rem, 5vw, 3rem); color: var(--accent); margin-bottom: 25px; }
        .section-header .line { width: 80px; height: 1px; background: var(--accent); margin: 0 auto; opacity: 0.4; }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.02);
            padding: 80px 45px;
            border: 1px solid rgba(192, 160, 128, 0.08);
            text-align: center;
            transition: 0.5s ease;
        }

        .feature-card:hover {
            background: rgba(192, 160, 128, 0.05);
            border-color: var(--accent);
            transform: translateY(-10px);
        }

        .feature-card i { font-size: 40px; color: var(--accent); margin-bottom: 30px; }
        .feature-card h3 { font-size: 1.5rem; color: var(--white); margin-bottom: 25px; }
        .feature-card p { font-size: 0.95rem; line-height: 1.8; opacity: 0.5; }

        /* === 8. FOOTER === */
        footer {
            padding: 100px 8% 60px;
            background: #050302;
            border-top: 1px solid rgba(197, 163, 104, 0.1);
        }

        .footer-main {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 120px;
            margin-bottom: 80px;
        }

        .footer-desc h2 { font-size: 2.2rem; color: var(--accent); margin-bottom: 25px; }
        .footer-desc p { opacity: 0.4; line-height: 2; font-size: 0.9rem; }

        .footer-links h4 { color: var(--accent); margin-bottom: 30px; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px; }
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { text-decoration: none; color: var(--accent-light); opacity: 0.4; transition: 0.3s; font-size: 0.85rem; }
        .footer-links a:hover { opacity: 1; color: var(--accent); padding-left: 8px; }

        .footer-bottom {
            text-align: center;
            padding-top: 50px;
            border-top: 1px solid rgba(197, 163, 104, 0.05);
            font-size: 0.65rem;
            letter-spacing: 5px;
            opacity: 0.3;
            text-transform: uppercase;
        }

        /* === 9. RESPONSIVE REFINEMENT === */
        @media (max-width: 1150px) {
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .feature-grid { grid-template-columns: 1fr; gap: 30px; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .hero h1 { font-size: clamp(2.8rem, 10vw, 4rem); }
            .hero { background-attachment: scroll; }
            .content-section { padding: 80px 8%; }
        }

        /* Exit Animation Loader */
        .loader-exit {
            transform: translateY(-100%);
            transition: var(--transition);
        }
    </style>
</head>
<body>

    <!-- 1. PREMIUM LOADING SCREEN -->
    <div id="preloader">
        <div class="typewriter-box">
            <h1>Rasa Priangan</h1>
        </div>
        <p class="loader-subtext">The Digital Heritage of Spasial</p>
    </div>

    <!-- 2. NAVIGATION -->
    <nav id="navbar">
        <a href="#" class="nav-logo">Rasa Priangan.</a>
        
        <!-- Desktop Links -->
        <ul class="nav-links">
            <li><a href="<?= base_url('/') ?>">Beranda</a></li>
            <li><a href="<?= base_url('/map') ?>">Eksplorasi Peta</a></li>
            <li><a href="<?= base_url('/katalog') ?>">Katalog Produk</a></li>
            <li><a href="<?= base_url('/tentang') ?>">Tentang Kami</a></li>
            <li><a href="<?= base_url('/login') ?>">Admin Portal</a></li>
        </ul>
        
        <!-- Mobile Hamburger Icon -->
        <div class="mobile-toggle" id="menuToggle">
            <i class="fa-solid fa-bars-staggered"></i>
        </div>
    </nav>

    <!-- 3. RAPI MOBILE NAVIGATION OVERLAY -->
    <div class="nav-overlay" id="navOverlay">
        <!-- Close Button (X) -->
        <div class="close-menu" id="closeMenu">
            <i class="fa-solid fa-xmark"></i>
        </div>

        <ul>
            <li><a href="<?= base_url('/') ?>">Beranda</a></li>
            <li><a href="<?= base_url('/map') ?>">Eksplorasi Peta</a></li>
            <li><a href="<?= base_url('/katalog') ?>">Katalog Produk</a></li>
            <li><a href="<?= base_url('/tentang') ?>">Tentang Kami</a></li>
            <li><a href="<?= base_url('/login') ?>">Admin Portal</a></li>
        </ul>

        <!-- Mobile Footer Section -->
        <div class="mobile-footer-info">
            <div class="mobile-socials">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p style="font-size: 0.6rem; letter-spacing: 3px; opacity: 0.4; text-transform: uppercase;">Sukabumi, Jawa Barat</p>
        </div>
    </div>

    <!-- 4. HERO SECTION -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tagline" data-aos="fade-right">Heritage Information System</span>
            <h1 data-aos="fade-up" data-aos-delay="200">Warisan <span>Rasa</span> Dalam Peta.</h1>
            <p data-aos="fade-up" data-aos-delay="400">
                Menemukan kelezatan mochi legendaris dan cinderamata autentik melalui platform pemetaan digital paling presisi di Kota Sukabumi.
            </p>
            <div data-aos="fade-up" data-aos-delay="600">
                <a href="<?= base_url('/map') ?>" class="btn-primary">Mulai Penjelajahan</a>
            </div>
        </div>
    </section>

    <!-- 5. FEATURES SECTION -->
    <section class="content-section">
        <div class="section-header" data-aos="fade-up">
            <h2>Visi Spasial Digital</h2>
            <div class="line"></div>
        </div>

        <div class="feature-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fa-solid fa-map-location-dot"></i>
                <h3>Geo-Intelligence</h3>
                <p>Visualisasi data geografis yang presisi untuk memandu perjalanan kuliner Anda ke titik lokasi yang tepat.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <i class="fa-solid fa-satellite"></i>
                <h3>Spatial Analytics</h3>
                <p>Fitur analisis radius spasial cerdas untuk memindai setiap pusat oleh-oleh di sekitar posisi koordinat Anda.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fa-solid fa-award"></i>
                <h3>Cultural Assets</h3>
                <p>Digitalisasi warisan rasa lokal yang terstruktur untuk menjaga keberlanjutan identitas budaya Kota Sukabumi.</p>
            </div>
        </div>
    </section>

    <!-- 6. FOOTER -->
    <footer>
        <div class="footer-main">
            <div class="footer-desc">
                <h2>Rasa Priangan.</h2>
                <p>Sebuah dedikasi digital untuk memperkenalkan kekayaan budaya lokal melalui integrasi data geografis yang interaktif, edukatif, dan berkelas.</p>
            </div>
            <div class="footer-links">
                <h4>Direktori</h4>
                <ul>
                    <li><a href="<?= base_url('/map') ?>">Peta Interaktif</a></li>
                    <li><a href="<?= base_url('/katalog') ?>">Katalog Toko</a></li>
                    <li><a href="<?= base_url('/about') ?>">Tentang Projek</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Koneksi</h4>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Email Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 RASA PRIANGAN — SIG OLEH-OLEH KOTA SUKABUMI.
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // AOS Animation
        AOS.init({
            duration: 1200,
            once: true,
            easing: 'ease-in-out'
        });

        // Preloader Logic
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            // Menunggu animasi typewriter (total 4 detik untuk keamanan)
            setTimeout(() => {
                preloader.classList.add('loader-exit');
                document.body.style.overflow = 'auto';
            }, 4000); 
        });

        // Sticky Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const closeMenu = document.getElementById('closeMenu');
        const navOverlay = document.getElementById('navOverlay');

        menuToggle.addEventListener('click', () => {
            navOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; 
        });

        closeMenu.addEventListener('click', () => {
            navOverlay.classList.remove('active');
            document.body.style.overflow = 'auto'; 
        });

        // Close menu when links are clicked
        const navLinks = navOverlay.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });
    </script>
</body>
</html>