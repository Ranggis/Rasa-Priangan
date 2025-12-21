<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical Support Protocol | Rasa Priangan</title>
    
    <!-- Library Eksternal (IDENTIK) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* === 1. DESIGN SYSTEM === */
        :root {
            --bg-dark: #0d0805;
            --bg-medium: #1b110b;
            --accent: #c0a080;
            --accent-light: #f4ece2;
            --text-gold: #d4b996;
            --white: #ffffff;
            --glass: rgba(13, 8, 5, 0.94);
            --transition: all 0.6s cubic-bezier(0.77, 0, 0.175, 1);
        }

        /* === 2. RESET & GLOBAL (FORCE REMOVE BULLETS) === */
        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        
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
            position: fixed; top: 0; width: 100%; padding: 30px 8%;
            display: flex; justify-content: space-between; align-items: center;
            z-index: 1000; transition: var(--transition);
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

        /* === 4. PREMIUM MOBILE OVERLAY (NO BULLETS) === */
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

        .nav-overlay ul { list-style: none !important; text-align: center; width: 100%; padding: 0 !important; }
        
        .nav-overlay li { 
            margin: 20px 0; 
            opacity: 0; 
            transform: translateY(20px);
            transition: 0.6s ease;
            list-style: none !important;
        }

        .nav-overlay.active li { opacity: 1; transform: translateY(0); }

        /* Staggered Delay */
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

        /* === 5. SUPPORT HERO === */
        .support-hero {
            padding: 200px 8% 100px;
            text-align: center;
            background: linear-gradient(to bottom, #2d1b10, var(--bg-dark)),
                        url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .support-hero h1 { font-size: clamp(2.5rem, 8vw, 5rem); color: var(--white); margin-bottom: 15px; }
        .support-hero p { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 6px; color: var(--accent); font-weight: 600; }

        /* === 6. PROTOCOL GRID === */
        .protocol-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            padding: 100px 8%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .protocol-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(192, 160, 128, 0.08);
            padding: 60px 40px;
            transition: 0.5s;
            text-align: center;
        }

        .protocol-card:hover {
            border-color: var(--accent);
            background: rgba(192, 160, 128, 0.05);
            transform: translateY(-10px);
        }

        .protocol-card i { font-size: 3rem; color: var(--accent); margin-bottom: 30px; }
        .protocol-card h3 { font-size: 1.6rem; color: var(--white); margin-bottom: 20px; }
        .protocol-card p { font-size: 0.95rem; line-height: 1.8; opacity: 0.5; margin-bottom: 25px; }

        .status-badge {
            display: inline-block;
            padding: 6px 18px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: rgba(0, 255, 127, 0.1);
            color: #00ff7f;
            border: 1px solid #00ff7f;
            font-weight: 700;
        }

        /* === 7. REPORT FORM === */
        .report-section {
            padding: 120px 8%;
            background: var(--bg-medium);
            display: flex;
            justify-content: center;
        }

        .report-box {
            width: 100%;
            max-width: 900px;
            background: var(--bg-dark);
            border: 1px solid rgba(192, 160, 128, 0.1);
            padding: 80px;
        }

        .report-box h2 { font-size: 2.8rem; color: var(--accent); margin-bottom: 50px; text-align: center; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .report-input {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(192, 160, 128, 0.2);
            padding: 15px 0;
            color: var(--white);
            font-family: inherit;
            outline: none;
            transition: 0.4s;
            font-size: 0.95rem;
        }

        .report-input:focus { border-color: var(--accent); }

        textarea.report-input { height: 150px; resize: none; margin-top: 20px; }

        .btn-report {
            width: 100%;
            background: var(--accent);
            color: var(--bg-dark);
            padding: 22px;
            border: none;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 4px;
            cursor: pointer;
            margin-top: 50px;
            transition: 0.4s;
            font-size: 0.85rem;
        }

        .btn-report:hover { background: var(--white); transform: translateY(-3px); }

        /* === 8. PREMIUM FOOTER === */
        footer {
            padding: 120px 8% 60px;
            background: #050302;
            border-top: 1px solid rgba(197, 163, 104, 0.1);
        }

        .footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 100px; margin-bottom: 80px; }
        .footer-desc h2 { font-size: 2.2rem; color: var(--accent); margin-bottom: 25px; font-weight: 700; }
        .footer-desc p { opacity: 0.4; line-height: 2; font-size: 0.9rem; }

        .footer-links h4 { color: var(--accent); margin-bottom: 30px; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px; }
        .footer-links ul { list-style: none !important; padding: 0 !important; }
        .footer-links li { margin-bottom: 18px; list-style: none !important; }
        .footer-links a { text-decoration: none; color: var(--accent-light); opacity: 0.4; transition: 0.3s; font-size: 0.85rem; }
        .footer-links a:hover { opacity: 1; color: var(--accent); padding-left: 8px; }

        .footer-bottom {
            text-align: center; padding-top: 50px; border-top: 1px solid rgba(197, 163, 104, 0.05);
            font-size: 0.65rem; letter-spacing: 6px; opacity: 0.3; text-transform: uppercase;
        }

        /* === 9. RESPONSIVE === */
        @media (max-width: 1200px) {
            .protocol-grid { grid-template-columns: 1fr; gap: 30px; }
            .form-row { grid-template-columns: 1fr; }
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .report-box { padding: 50px 30px; }
        }
    </style>
</head>
<body>

    <!-- 1. NAVIGATION -->
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

    <!-- 2. MOBILE OVERLAY -->
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

    <!-- 3. HERO SECTION -->
    <header class="support-hero">
        <div data-aos="fade-down">
            <p>Admin Operations Center</p>
            <h1>Technical Support Protocol</h1>
        </div>
    </header>

    <!-- 4. PROTOCOL CARDS -->
    <main class="protocol-grid">
        <div class="protocol-card" data-aos="fade-up" data-aos-delay="100">
            <i class="fa-solid fa-shield-halved"></i>
            <h3>System Status</h3>
            <p>Memantau integritas data SIG dan performa server secara realtime untuk memastikan layanan tanpa gangguan.</p>
            <div class="status-badge">All Systems Operational</div>
        </div>

        <div class="protocol-card" data-aos="fade-up" data-aos-delay="200">
            <i class="fa-solid fa-key"></i>
            <h3>Account Recovery</h3>
            <p>Prosedur pemulihan kunci akses melalui otentikasi dua faktor atau verifikasi manual oleh Lead Developer.</p>
            <a href="<?= base_url('/recovery-protocol') ?>" style="color: var(--accent); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; border-bottom: 1px solid var(--accent);">Initiate Recovery</a>
        </div>

        <div class="protocol-card" data-aos="fade-up" data-aos-delay="300">
            <i class="fa-solid fa-database"></i>
            <h3>Database Protocol</h3>
            <p>Panduan sinkronisasi titik koordinat baru dan manajemen foto katalog agar tetap sesuai standar kualitas visual.</p>
            <a href="<?= base_url('/documentation-protocol') ?>" style="color: var(--accent); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; border-bottom: 1px solid var(--accent);">View Documentation</a>
        </div>
    </main>

    <!-- 5. REPORT FORM SECTION -->
    <section class="report-section">
        <div class="report-box" data-aos="zoom-in">
            <h2>Incident Report Form</h2>
            <form action="#">
                <div class="form-row">
                    <input type="text" class="report-input" placeholder="Staff Name" required>
                    <input type="email" class="report-input" placeholder="Authorized Email" required>
                </div>
                <div class="form-row">
                    <select class="report-input" style="background: var(--bg-dark); color: gray; border-radius: 0;">
                        <option>Issue Category</option>
                        <option>SIG Mapping Error</option>
                        <option>Credential Issue</option>
                        <option>Data Correction</option>
                        <option>Other Technical Bug</option>
                    </select>
                    <input type="text" class="report-input" placeholder="Subject / Store ID">
                </div>
                <textarea class="report-input" placeholder="Describe the technical issue in detail..."></textarea>
                
                <button type="submit" class="btn-report">Submit Formal Report</button>
            </form>
        </div>
    </section>

    <!-- 6. FOOTER (JANGAN DIUBAH) -->
    <footer>
        <div class="footer-main">
            <div class="footer-desc">
                <h2>Rasa Priangan.</h2>
                <p>Sebuah dedikasi digital untuk memperkenalkan kekayaan budaya lokal melalui integrasi data geografis yang interaktif, edukatif, dan berkelas.</p>
            </div>
            <div class="footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="<?= base_url('/map') ?>">Peta Interaktif</a></li>
                    <li><a href="<?= base_url('/katalog') ?>">Katalog Toko</a></li>
                    <li><a href="<?= base_url('/tentang') ?>">Tentang Kami</a></li>
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
        // Animasi AOS
        AOS.init({ duration: 1200, once: true, easing: 'ease-in-out' });

        // Sticky Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
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
    </script>
</body>
</html>