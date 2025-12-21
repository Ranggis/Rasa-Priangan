<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Warisan | Rasa Priangan</title>
    
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
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

        /* === 3. CATALOG CONTENT AREA === */
        .catalog-hero {
            height: 60vh;
            background: linear-gradient(to bottom, rgba(13, 8, 5, 0.7), var(--bg-dark)),
                        url('https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=2000');
            background-size: cover; background-position: center;
            background-attachment: fixed;
            display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
            padding: 0 8%;
        }
        .catalog-hero h1 { font-size: clamp(3rem, 10vw, 5.5rem); color: var(--white); margin-bottom: 15px; }
        .catalog-hero p { color: var(--accent); text-transform: uppercase; letter-spacing: 12px; font-size: 0.8rem; font-weight: 600; }

        .filter-section {
            padding: 40px 0;
            background: var(--bg-dark);
            position: sticky;
            top: 80px;
            z-index: 900;
            border-bottom: 1px solid rgba(192, 160, 128, 0.05);
        }
        .filter-wrapper { display: flex; gap: 15px; overflow-x: auto; padding: 0 8% 10px; scrollbar-width: none; }
        .filter-wrapper::-webkit-scrollbar { display: none; }

        .filter-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(192, 160, 128, 0.1);
            color: var(--accent-light);
            padding: 12px 30px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.4s;
            white-space: nowrap;
        }
        .filter-btn.active { 
            background: var(--accent); 
            color: var(--bg-dark); 
            border-color: var(--accent); 
            box-shadow: 0 0 20px rgba(192, 160, 128, 0.4);
        }

        .catalog-container { padding: 60px 8% 120px; background: var(--bg-dark); }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 50px;
        }

        .gallery-card {
            position: relative;
            background: var(--bg-medium);
            border: 1px solid rgba(192, 160, 128, 0.05);
            transition: var(--transition);
            overflow: hidden;
            cursor: pointer;
        }
        
        /* LOGIKA FILTER */
        .gallery-card.hidden {
            display: none;
        }

        .gallery-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: var(--accent);
        }

        .img-container { width: 100%; height: 480px; overflow: hidden; position: relative; }
        .img-container img {
            width: 100%; height: 100%; object-fit: cover;
            filter: saturate(0.7) brightness(0.8);
            transition: 2s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .gallery-card:hover .img-container img { transform: scale(1.15); filter: saturate(1.1) brightness(1); }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(13, 8, 5, 1) 0%, rgba(13, 8, 5, 0.4) 40%, transparent 80%);
            display: flex; flex-direction: column; justify-content: flex-end;
            padding: 45px; z-index: 2;
        }

        .card-overlay span { 
            color: var(--accent); text-transform: uppercase; letter-spacing: 5px; 
            font-size: 0.65rem; margin-bottom: 12px; transform: translateY(10px); opacity: 0; transition: 0.5s;
        }

        .card-overlay h3 { 
            font-size: 2rem; color: var(--white); margin-bottom: 25px; line-height: 1.1;
            transform: translateY(20px); opacity: 0; transition: 0.7s;
        }

        .gallery-card:hover .card-overlay span,
        .gallery-card:hover .card-overlay h3 { transform: translateY(0); opacity: 1; }

        .btn-discover {
            width: fit-content; color: var(--accent-light); text-decoration: none;
            font-size: 0.75rem; text-transform: uppercase; letter-spacing: 4px;
            border-bottom: 1px solid var(--accent); padding-bottom: 8px; transition: 0.4s;
        }
        .gallery-card:hover .btn-discover { color: var(--accent); padding-left: 10px; }

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

        /* === 5. RESPONSIVE REFINEMENT === */
        @media (max-width: 1150px) {
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .gallery-grid { grid-template-columns: 1fr; gap: 30px; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .img-container { height: 400px; }
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

    <!-- [3. CATALOG HERO] -->
    <section class="catalog-hero">
        <div data-aos="fade-down">
            <p>The Living Gallery</p>
            <h1>Warisan Rasa</h1>
        </div>
    </section>

    <!-- [4. DYNAMIC FILTER SECTION] -->
    <section class="filter-section">
        <div class="filter-wrapper" data-aos="fade-right">
            <!-- Tombol Utama -->
            <button class="filter-btn active" onclick="filterGallery('all', this)">Semua Warisan</button>
            
            <!-- Looping Kategori dari Database -->
            <?php if(!empty($kategori)): foreach($kategori as $kat): ?>
                <button class="filter-btn" onclick="filterGallery('<?= $kat['kategori_slug'] ?>', this)">
                    <?= $kat['nama_kategori'] ?>
                </button>
            <?php endforeach; endif; ?>
        </div>
    </section>

    <!-- [5. DYNAMIC CATALOG GRID] -->
    <main class="catalog-container">
        <div class="gallery-grid" id="heritageGallery">
            
            <?php if(!empty($toko)): $i = 1; foreach($toko as $row): ?>
            <!-- Card Produk Dinamis -->
            <div class="gallery-card item-<?= $row['kategori_slug'] ?>" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                <div class="img-container">
                    <?php 
                        $fotoPath = $row['foto'];
                        // Cek apakah foto diawali dengan http (berarti link internet)
                        if (strpos($fotoPath, 'http') === 0) {
                            $src = $fotoPath; // Gunakan link langsung
                        } else {
                            // Jika bukan http, berarti ambil dari folder lokal
                            $src = base_url('assets/image/' . ($fotoPath ?: 'default.jpg'));
                        }
                    ?>
                    <img src="<?= $src ?>" alt="<?= $row['nama_toko'] ?>">
                </div>
                <div class="card-overlay">
                    <span><?= $row['nama_kategori'] ?></span>
                    <h3><?= $row['nama_toko'] ?></h3>
                    <a href="<?= base_url('/map') ?>" class="btn-discover">Eksplorasi Rasa</a>
                </div>
            </div>
            <?php $i++; endforeach; else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 100px; opacity: 0.5;">
                    <h3>Belum ada data warisan di database.</h3>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <!-- [6. PREMIUM FOOTER] -->
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

        // === LOGIKA FILTER DINAMIS ===
        function filterGallery(category, btn) {
            // 1. Atur Button Active
            const filterBtns = document.querySelectorAll('.filter-btn');
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // 2. Filter Card Berdasarkan Kategori
            const cards = document.querySelectorAll('.gallery-card');
            cards.forEach(card => {
                if (category === 'all') {
                    card.classList.remove('hidden');
                } else {
                    if (card.classList.contains('item-' + category)) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                }
            });

            // Refresh AOS untuk trigger animasi ulang
            AOS.refresh();
        }
    </script>
</body>
</html>