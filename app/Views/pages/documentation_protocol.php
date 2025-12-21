<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Documentation | Rasa Priangan</title>
    
    <!-- Library Eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
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

        /* === 2. RESET & GLOBAL (FORCE REMOVE BULLETS) === */
        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        
        /* Menghilangkan titik list secara global */
        ul, li { 
            list-style: none !important; 
            list-style-type: none !important; 
            padding: 0 !important; 
            margin: 0; 
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-dark); 
            color: var(--accent-light); 
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Blueprint Grid Effect */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: radial-gradient(var(--bg-medium) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.2;
            z-index: -1;
        }

        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        /* === 3. PREMIUM NAVBAR === */
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

        /* Efek Underscore Hover */
        .nav-links a::after {
            content: "";
            position: absolute;
            bottom: 0; left: 50%;
            width: 0; height: 2px;
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
            font-size: 1.8rem;
        }

        /* === 4. PREMIUM MOBILE NAVIGATION (NO BULLETS) === */
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
            font-size: 2.2rem;
            color: var(--accent);
            cursor: pointer;
            transition: 0.3s;
        }

        .nav-overlay ul { 
            list-style: none !important; 
            text-align: center; 
            width: 100%; 
            padding: 0 !important; 
        }
        
        .nav-overlay li { 
            list-style: none !important;
            margin: 20px 0; 
            opacity: 0; 
            transform: translateY(20px);
            transition: 0.6s ease;
        }

        .nav-overlay.active li { opacity: 1; transform: translateY(0); }

        /* Animasi Staggered */
        .nav-overlay li:nth-child(1) { transition-delay: 0.1s; }
        .nav-overlay li:nth-child(2) { transition-delay: 0.2s; }
        .nav-overlay li:nth-child(3) { transition-delay: 0.3s; }
        .nav-overlay li:nth-child(4) { transition-delay: 0.4s; }
        .nav-overlay li:nth-child(5) { transition-delay: 0.5s; }

        .nav-overlay a {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--accent-light);
            text-decoration: none;
            display: inline-block;
        }
        .nav-overlay a:hover { color: var(--accent); letter-spacing: 2px; }

        .mobile-footer-info { position: absolute; bottom: 50px; text-align: center; }
        .mobile-socials { display: flex; justify-content: center; gap: 35px; color: var(--accent); font-size: 1.5rem; margin-bottom: 15px; }
        .mobile-socials a { color: var(--accent); text-decoration: none; transition: 0.3s; }

        /* === 5. DOCUMENTATION LAYOUT === */
        .doc-header-section {
            padding: 200px 8% 100px;
            background: linear-gradient(to bottom, rgba(13, 8, 5, 0.8), var(--bg-dark)),
                        url('https://images.unsplash.com/photo-1451187534963-11d7fcc04bb7?q=80&w=2000');
            background-size: cover; background-position: center; background-attachment: fixed; text-align: center;
        }

        .doc-header-section h1 { font-size: clamp(3rem, 10vw, 5.5rem); color: var(--white); margin-bottom: 20px; }
        .badge {
            display: inline-block; padding: 8px 25px; background: rgba(192, 160, 128, 0.1);
            color: var(--accent); border: 1px solid var(--accent); text-transform: uppercase;
            letter-spacing: 5px; font-size: 0.7rem; font-weight: 700; margin-bottom: 20px;
        }

        .main-doc-container {
            display: grid; grid-template-columns: 320px 1fr; gap: 100px; padding: 100px 8%;
            max-width: 1500px; margin: 0 auto;
        }

        .doc-nav-wrapper { position: sticky; top: 120px; height: fit-content; }
        .doc-nav-wrapper h4 { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 3px; color: var(--accent); margin-bottom: 30px; opacity: 0.6; }
        
        .doc-nav-list { border-left: 1px solid rgba(192, 160, 128, 0.1); }
        .doc-nav-list li { position: relative; padding: 12px 0 12px 30px; }
        .doc-nav-list a { text-decoration: none; color: var(--accent-light); font-size: 0.85rem; opacity: 0.4; transition: 0.4s; }
        
        .doc-nav-list li.active::before { 
            content: ''; position: absolute; left: -1px; top: 0; width: 2px; height: 100%; 
            background: var(--accent); box-shadow: 0 0 15px var(--accent); 
        }
        .doc-nav-list li.active a { opacity: 1; color: var(--accent); font-weight: 600; }

        .content-block { margin-bottom: 120px; }
        .content-block .num { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--accent); font-style: italic; display: block; margin-bottom: 10px; }
        .content-block h2 { font-size: 2.8rem; color: var(--white); margin-bottom: 30px; line-height: 1.2; }
        .content-block p { font-size: 1.05rem; line-height: 1.8; opacity: 0.7; font-weight: 300; margin-bottom: 25px; }

        .terminal-box {
            background: #050302; border: 1px solid rgba(192, 160, 128, 0.1); padding: 35px;
            position: relative; margin: 40px 0; box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .terminal-box code { font-family: 'JetBrains Mono', monospace; color: var(--text-gold); font-size: 0.9rem; display: block; line-height: 1.8; }

        .spec-table { width: 100%; border-collapse: collapse; margin: 30px 0; background: rgba(255,255,255,0.01); }
        .spec-table th { text-align: left; padding: 20px; background: rgba(192, 160, 128, 0.05); color: var(--accent); text-transform: uppercase; font-size: 0.7rem; border-bottom: 1px solid var(--accent); }
        .spec-table td { padding: 20px; border-bottom: 1px solid rgba(192, 160, 128, 0.1); font-size: 0.9rem; color: rgba(255,255,255,0.8); }

        /* === 6. PREMIUM FOOTER === */
        footer {
            padding: 100px 8% 60px;
            background: #050302;
            border-top: 1px solid rgba(197, 163, 104, 0.1);
        }

        .footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 80px; margin-bottom: 80px; }
        .footer-desc h2 { font-size: 2.2rem; color: var(--accent); margin-bottom: 25px; font-weight: 700; }
        .footer-desc p { opacity: 0.4; line-height: 2; font-size: 0.9rem; }

        .footer-links h4 { color: var(--accent); margin-bottom: 30px; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { text-decoration: none; color: var(--accent-light); opacity: 0.4; transition: 0.3s; font-size: 0.85rem; }
        .footer-links a:hover { opacity: 1; color: var(--accent); padding-left: 8px; }

        .footer-bottom {
            text-align: center; padding-top: 50px; border-top: 1px solid rgba(197, 163, 104, 0.05);
            font-size: 0.65rem; letter-spacing: 6px; opacity: 0.3; text-transform: uppercase;
        }

        /* === 7. RESPONSIVE === */
        @media (max-width: 1200px) {
            .main-doc-container { grid-template-columns: 1fr; gap: 60px; }
            .doc-nav-wrapper { display: none; }
            nav { padding: 20px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- [1. NAVIGATION] -->
    <nav id="navbar">
        <a href="<?= base_url('/') ?>" class="nav-logo">Rasa Priangan.</a>
        
        <ul class="nav-links">
            <li><a href="<?= base_url('/') ?>">Beranda</a></li>
            <li><a href="<?= base_url('/map') ?>">Eksplorasi Peta</a></li>
            <li><a href="<?= base_url('/katalog') ?>">Katalog Produk</a></li>
            <li><a href="<?= base_url('/tentang') ?>">Tentang Kami</a></li>
            <li><a href="<?= base_url('/login') ?>">Admin Portal</a></li>
        </ul>
        
        <div class="mobile-toggle" id="menuToggle">
            <i class="fa-solid fa-bars-staggered"></i>
        </div>
    </nav>

    <!-- [2. MOBILE OVERLAY] -->
    <div class="nav-overlay" id="navOverlay">
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

        <div class="mobile-footer-info">
            <div class="mobile-socials">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p style="font-size: 0.6rem; letter-spacing: 3px; opacity: 0.4; text-transform: uppercase;">Sukabumi, Jawa Barat</p>
        </div>
    </div>

    <!-- [3. HERO SECTION] -->
    <header class="doc-header-section">
        <div data-aos="fade-up">
            <span class="badge">Internal Protocol</span>
            <h1>Technical <br>Documentation</h1>
        </div>
    </header>

    <!-- [4. MAIN CONTENT] -->
    <div class="main-doc-container">
        <!-- Sidebar -->
        <aside class="doc-nav-wrapper" data-aos="fade-right">
            <h4>Chapters</h4>
            <ul class="doc-nav-list">
                <li class="active"><a href="#db-schema">01. Database Schema</a></li>
                <li><a href="#sig-coords">02. SIG Coordinates</a></li>
                <li><a href="#media-protocol">03. Media Assets</a></li>
            </ul>
        </aside>

        <!-- Body -->
        <main class="doc-body-content">
            <section id="db-schema" class="content-block" data-aos="fade-up">
                <span class="num">01.</span>
                <h2>Database Schema</h2>
                <p>Arsitektur database menggunakan sistem MySQL untuk integritas data lokasi dan produk secara realtime.</p>
                <table class="spec-table">
                    <thead>
                        <tr><th>Table Name</th><th>Primary Purpose</th><th>Integritas</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>`oleh_oleh`</td><td>Data pusat lokasi & produk</td><td>Main POI</td></tr>
                        <tr><td>`kategori`</td><td>Klasifikasi jenis usaha</td><td>Static Ref</td></tr>
                        <tr><td>`reviews`</td><td>Umpan balik pengunjung</td><td>Dynamic Data</td></tr>
                    </tbody>
                </table>
            </section>

            <section id="sig-coords" class="content-block" data-aos="fade-up">
                <span class="num">02.</span>
                <h2>SIG Coordinates</h2>
                <div class="terminal-box">
                    <code>
                        [VALIDATION_STREAM] <br>
                        LAT: -6.9214774 | LNG: 106.9261239 <br>
                        STATUS: Validated (WGS 84 Standar)
                    </code>
                </div>
            </section>
        </main>
    </div>

    <!-- [5. FOOTER] -->
    <footer>
        <div class="footer-main">
            <div class="footer-desc">
                <h2>Rasa Priangan.</h2>
                <p>Digitalisasi warisan lokal melalui sistem informasi geografis yang presisi, interaktif, dan berkelas.</p>
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
                    <li><a href="#"></i> Instagram</a></li>
                    <li><a href="#"></i> Facebook</a></li>
                    <li><a href="#"></i> Email Kami</a></li>
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
        // Animasi Inisialisasi
        AOS.init({ duration: 1200, once: true, easing: 'ease-in-out' });

        // Sticky Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // Mobile Menu Logic
        const menuToggle = document.getElementById('menuToggle'),
              closeMenu = document.getElementById('closeMenu'),
              navOverlay = document.getElementById('navOverlay');

        menuToggle.addEventListener('click', () => { 
            navOverlay.classList.add('active'); 
            document.body.style.overflow = 'hidden'; 
        });
        
        closeMenu.addEventListener('click', () => { 
            navOverlay.classList.remove('active'); 
            document.body.style.overflow = 'auto'; 
        });

        // Scroll Spy Sidebar
        const sections = document.querySelectorAll('.content-block');
        const navLinksSidebar = document.querySelectorAll('.doc-nav-list li');

        window.addEventListener('scroll', () => {
            let current = "";
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= (sectionTop - 250)) {
                    current = section.getAttribute('id');
                }
            });
            navLinksSidebar.forEach(li => {
                li.classList.remove('active');
                if (li.querySelector('a').getAttribute('href').includes(current)) {
                    li.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>