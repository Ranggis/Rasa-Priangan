<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credential Recovery | Rasa Priangan</title>
    
    <!-- Library Eksternal -->
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

        /* === 5. ULTRA-PREMIUM RECOVERY AREA === */
        .recovery-wrapper {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 140px 8% 80px;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(192, 160, 128, 0.05) 0%, transparent 70%);
            z-index: 0;
            filter: blur(80px);
        }
        .orb-1 { top: -10%; left: -10%; }
        .orb-2 { bottom: -10%; right: -10%; }

        .recovery-box {
            position: relative;
            width: 100%;
            max-width: 650px;
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(192, 160, 128, 0.08);
            backdrop-filter: blur(25px);
            padding: 80px 60px;
            z-index: 10;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
        }

        .recovery-box::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            animation: scan 4s linear infinite;
        }

        @keyframes scan {
            0% { top: 0; opacity: 0; }
            50% { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }

        .recovery-header { text-align: center; margin-bottom: 50px; }
        .recovery-header i { font-size: 3rem; color: var(--accent); margin-bottom: 25px; display: block; opacity: 0.9; }
        .recovery-header h2 { font-size: 2.5rem; color: var(--white); margin-bottom: 10px; }
        .recovery-header p { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 5px; color: var(--accent); opacity: 0.6; }

        .step-progress { display: flex; align-items: center; justify-content: center; gap: 20px; margin-bottom: 50px; }
        .step-unit { width: 35px; height: 35px; border: 1px solid rgba(192, 160, 128, 0.3); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 600; color: var(--accent-light); }
        .step-unit.active { background: var(--accent); color: var(--bg-dark); border-color: var(--accent); box-shadow: 0 0 20px rgba(192, 160, 128, 0.3); }
        .step-line { width: 40px; height: 1px; background: rgba(192, 160, 128, 0.2); }

        .field-group { position: relative; margin-bottom: 45px; }
        .field-group input { width: 100%; background: transparent; border: none; border-bottom: 1px solid rgba(192, 160, 128, 0.2); padding: 12px 0; color: var(--white); font-size: 1rem; outline: none; transition: 0.4s; }
        .field-group label { position: absolute; top: 12px; left: 0; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 3px; color: rgba(244, 236, 226, 0.4); pointer-events: none; transition: 0.4s; }
        .field-group input:focus ~ label, .field-group input:valid ~ label { top: -20px; color: var(--accent); font-size: 0.6rem; font-weight: 700; }
        .field-group input:focus { border-bottom: 1px solid var(--accent); }

        .btn-verify { width: 100%; background: var(--accent); color: var(--bg-dark); padding: 22px; border: none; font-weight: 800; text-transform: uppercase; letter-spacing: 5px; font-size: 0.75rem; cursor: pointer; transition: 0.4s; }
        .btn-verify:hover { background: var(--white); transform: translateY(-5px); }

        .recovery-options { margin-top: 40px; text-align: center; border-top: 1px solid rgba(192, 160, 128, 0.1); padding-top: 30px; }
        .recovery-options a { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent-light); opacity: 0.4; text-decoration: none; transition: 0.3s; }
        .recovery-options a:hover { opacity: 1; color: var(--accent); }

        /* === 6. PREMIUM FOOTER === */
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

        .footer-desc h2 { font-size: 2.2rem; color: var(--accent); margin-bottom: 25px; font-weight: 700; }
        .footer-desc p { opacity: 0.4; line-height: 2; font-size: 0.9rem; }

        .footer-links h4 { color: var(--accent); margin-bottom: 30px; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px; }
        .footer-links ul { list-style: none !important; padding: 0 !important; }
        .footer-links li { margin-bottom: 15px; list-style: none !important; }
        .footer-links a { text-decoration: none; color: var(--accent-light); opacity: 0.4; transition: 0.3s; font-size: 0.85rem; }
        .footer-links a:hover { opacity: 1; color: var(--accent); padding-left: 8px; }

        .footer-bottom {
            text-align: center;
            padding-top: 50px;
            border-top: 1px solid rgba(197, 163, 104, 0.05);
            font-size: 0.65rem;
            letter-spacing: 6px;
            opacity: 0.3;
            text-transform: uppercase;
        }

        /* === 7. RESPONSIVE === */
        @media (max-width: 1000px) {
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .recovery-box { padding: 60px 30px; }
            .recovery-header h2 { font-size: 2rem; }
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
        <div class="mobile-toggle" id="menuToggle"><i class="fa-solid fa-bars-staggered"></i></div>
    </nav>

    <!-- [2. PREMIUM MOBILE OVERLAY] -->
    <div class="nav-overlay" id="navOverlay">
        <div class="close-menu" id="closeMenu"><i class="fa-solid fa-xmark"></i></div>
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

    <!-- [3. RECOVERY CONTENT] -->
    <main class="recovery-wrapper">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="recovery-box" data-aos="fade-up">
            <div class="recovery-header">
                <i class="fa-solid fa-fingerprint"></i>
                <h2>Security Portal</h2>
                <p>Identity Verification Protocol</p>
            </div>

            <div class="step-progress">
                <div class="step-unit active">01</div>
                <div class="step-line"></div>
                <div class="step-unit">02</div>
                <div class="step-line"></div>
                <div class="step-unit">03</div>
            </div>

            <form class="recovery-form" action="#" method="POST">
                <div class="field-group">
                    <input type="text" name="personnel_id" required>
                    <label>Personnel ID / Login Username</label>
                </div>

                <div class="field-group">
                    <input type="email" name="secure_email" required>
                    <label>Registered Security Email</label>
                </div>

                <button type="submit" class="btn-verify">Initiate Verification</button>
            </form>

            <div class="recovery-options">
                <a href="<?= base_url('/support-protocol') ?>">Request Manual Clearance (Technical Support)</a>
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
        // AOS Animation
        AOS.init({ duration: 1200, once: true, easing: 'ease-in-out' });

        // Sticky Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // Mobile Menu
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