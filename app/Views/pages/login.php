<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Rasa Priangan</title>
    
    <!-- Library Eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* === 1. DESIGN SYSTEM (Premium Merged) === */
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

        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-dark); 
            color: var(--accent-light); 
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        /* === 2. PREMIUM NAVIGATION STYLES === */
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

        /* EFEK UNDERSCORE HOVER */
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
            font-size: 1.8rem;
            padding: 5px;
        }

        /* PREMIUM MOBILE NAV OVERLAY */
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

        /* Staggered Delay Mobile */
        .nav-overlay li:nth-child(1) { transition-delay: 0.2s; }
        .nav-overlay li:nth-child(2) { transition-delay: 0.3s; }
        .nav-overlay li:nth-child(3) { transition-delay: 0.4s; }
        .nav-overlay li:nth-child(4) { transition-delay: 0.5s; }
        .nav-overlay li:nth-child(5) { transition-delay: 0.6s; }

        .nav-overlay a {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--accent-light);
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }
        .nav-overlay a:hover { color: var(--accent); letter-spacing: 2px; }

        .mobile-footer-info { position: absolute; bottom: 50px; text-align: center; }
        .mobile-socials { display: flex; justify-content: center; gap: 35px; color: var(--accent); font-size: 1.5rem; margin-bottom: 15px; }

        /* === 3. AUTH PAGE STYLING (Original Logic Kept) === */
        .auth-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 140px 8% 100px;
            background: var(--bg-dark);
            overflow: hidden;
        }

        .ambient-orb {
            position: absolute; width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(192, 160, 128, 0.06) 0%, transparent 70%);
            border-radius: 50%; filter: blur(60px);
            animation: orbFloat 20s infinite alternate ease-in-out;
        }
        .orb-1 { top: -10%; right: -10%; }
        .orb-2 { bottom: -10%; left: -10%; animation-delay: -5s; }
        @keyframes orbFloat { from { transform: translate(0, 0); } to { transform: translate(-100px, 100px); } }

        .auth-container {
            display: flex; width: 100%; max-width: 1100px; min-height: 680px;
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(192, 160, 128, 0.08);
            backdrop-filter: blur(20px);
            position: relative; z-index: 10;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6);
        }

        .auth-visual {
            flex: 1.2; position: relative;
            background: url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200') center/cover no-repeat;
            display: flex; align-items: center; justify-content: center; padding: 60px;
        }
        .auth-visual::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to right, rgba(13, 8, 5, 0.7), rgba(13, 8, 5, 0.95)); }
        
        .visual-frame {
            position: relative; z-index: 2;
            padding: 40px; border: 1px solid rgba(192, 160, 128, 0.2);
            text-align: center; background: rgba(13, 8, 5, 0.4);
            backdrop-filter: blur(10px);
        }
        .visual-frame h3 { font-size: 2.2rem; color: var(--accent); font-style: italic; margin-bottom: 10px; }
        .visual-frame p { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 6px; opacity: 0.5; }

        .auth-form-side {
            flex: 1; background: rgba(13, 8, 5, 0.8);
            padding: 80px 60px; display: flex; flex-direction: column;
            justify-content: center; border-left: 1px solid rgba(192, 160, 128, 0.1);
        }

        .auth-header { margin-bottom: 50px; }
        .auth-header h2 { font-size: 2.5rem; color: var(--white); margin-bottom: 5px; }
        .auth-header p { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 4px; color: var(--accent); opacity: 0.7; }

        .error-alert {
            background: rgba(255, 77, 77, 0.05); color: #ff4d4d; border: 1px solid rgba(255, 77, 77, 0.2);
            padding: 15px; font-size: 0.7rem; letter-spacing: 1px; margin-bottom: 30px;
            text-transform: uppercase; text-align: center; animation: shake 0.4s ease-in-out;
        }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }

        .input-wrapper { position: relative; margin-bottom: 45px; }
        .input-wrapper input {
            width: 100%; background: transparent; border: none;
            border-bottom: 1px solid rgba(192, 160, 128, 0.2);
            padding: 12px 0; color: var(--white); font-size: 1rem; transition: 0.4s;
        }
        .input-wrapper label {
            position: absolute; top: 12px; left: 0;
            font-size: 0.7rem; text-transform: uppercase; letter-spacing: 3px;
            color: rgba(244, 236, 226, 0.4); pointer-events: none; transition: 0.4s;
        }
        .input-wrapper input:focus ~ label, .input-wrapper input:valid ~ label {
            top: -20px; color: var(--accent); font-weight: 700; font-size: 0.6rem;
        }
        .input-wrapper input:focus { border-bottom: 1px solid var(--accent); }

        .btn-vault {
            position: relative; width: 100%; background: var(--accent); color: var(--bg-dark);
            padding: 22px; border: none; font-weight: 800; text-transform: uppercase;
            letter-spacing: 5px; font-size: 0.75rem; cursor: pointer; overflow: hidden; transition: 0.4s;
        }
        .btn-vault:hover { background: var(--white); transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .btn-vault::after {
            content: ''; position: absolute; top: -50%; left: -60%; width: 20%; height: 200%;
            background: rgba(255, 255, 255, 0.4); transform: rotate(30deg);
            transition: 0.6s cubic-bezier(0.19, 1, 0.22, 1);
        }
        .btn-vault:hover::after { left: 130%; }

        .auth-footer { text-align: center; margin-top: 40px; }
        .auth-footer a {
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 2px;
            color: var(--accent-light); opacity: 0.4; text-decoration: none; transition: 0.3s;
        }
        .auth-footer a:hover { opacity: 1; color: var(--accent); }

        /* === 4. PREMIUM FOOTER STYLES === */
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

        /* === RESPONSIVE REFINEMENT === */
        @media (max-width: 1000px) {
            .auth-visual { display: none; }
            .auth-container { max-width: 500px; }
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .auth-form-side { padding: 60px 40px; }
        }
    </style>
</head>
<body>

    <!-- [1. PREMIUM NAVIGATION] -->
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

    <!-- [2. PREMIUM MOBILE OVERLAY] -->
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

    <!-- [3. AUTHENTICATION SECTION] -->
    <main class="auth-hero">
        <div class="ambient-orb orb-1"></div>
        <div class="ambient-orb orb-2"></div>

        <div class="auth-container" data-aos="zoom-in">
            <div class="auth-visual">
                <div class="visual-frame">
                    <p>Security Clearance</p>
                    <h3>Protected Area</h3>
                    <p>Authorized Admin Only</p>
                </div>
            </div>

            <div class="auth-form-side">
                <div class="auth-header">
                    <h2>Administrator</h2>
                    <p>Verified Access Entry</p>
                </div>

                <!-- ALERT PESAN ERROR (CodeIgniter Flashdata) -->
                <?php if(session()->getFlashdata('msg')): ?>
                    <div class="error-alert">
                        <i class="fa-solid fa-triangle-exclamation"></i> <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login/auth') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="input-wrapper">
                        <input type="text" name="user_identity" required>
                        <label>Identity Username</label>
                    </div>

                    <div class="input-wrapper">
                        <input type="password" name="user_secret" required>
                        <label>Secret Access Key</label>
                    </div>

                    <button type="submit" class="btn-vault">Verify & Authenticate</button>
                    
                    <div class="auth-footer">
                        <a href="<?= base_url('/support-protocol') ?>">Protocol & Support Documentation</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- [4. PREMIUM FOOTER] -->
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
        AOS.init({ duration: 1200, once: true });

        // Navbar Scroll Effect
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
    </script>
</body>
</html>