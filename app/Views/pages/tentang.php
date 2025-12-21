<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | Rasa Priangan</title>
    
    <!-- Library Eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
            --transition-smooth: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
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

        /* === 3. PREMIUM NAVBAR & UNDERSCORE EFFECT === */
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

        /* EFEK TANDA _ (UNDERSCORE) HOVER */
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

        /* === 4. MOBILE NAVIGATION OVERLAY === */
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

        /* Staggered Delay */
        .nav-overlay li:nth-child(1) { transition-delay: 0.1s; }
        .nav-overlay li:nth-child(2) { transition-delay: 0.2s; }
        .nav-overlay li:nth-child(3) { transition-delay: 0.3s; }
        .nav-overlay li:nth-child(4) { transition-delay: 0.4s; }
        .nav-overlay li:nth-child(5) { transition-delay: 0.5s; }

        .nav-overlay a {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
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
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* === 5. CONTENT STYLING === */
        .about-hero {
            height: 60vh;
            background: radial-gradient(circle at center, rgba(13, 8, 5, 0.4), var(--bg-dark)),
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2000');
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center; text-align: center; padding: 0 8%;
        }
        .about-hero h1 { font-size: clamp(3rem, 10vw, 5rem); color: var(--white); margin-bottom: 10px; }
        .about-hero p { color: var(--accent); text-transform: uppercase; letter-spacing: 10px; font-size: 0.8rem; font-weight: 600; }

        .story-section { padding: 120px 8%; display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
        .story-image { position: relative; border: 1px solid rgba(192, 160, 128, 0.2); padding: 15px; }
        .story-image img { width: 100%; height: auto; display: block; filter: sepia(0.2); }
        .story-text h2 { font-size: clamp(2rem, 5vw, 3rem); color: var(--accent); margin-bottom: 30px; line-height: 1.1; }
        .story-text p { font-size: 1.1rem; line-height: 1.8; opacity: 0.7; margin-bottom: 25px; font-weight: 300; }

        /* TEAM SLIDER */
        .team-section { 
            padding: 140px 0; 
            background: linear-gradient(to bottom, var(--bg-dark), #050302);
            overflow: hidden;
        }
        .section-header { text-align: center; margin-bottom: 60px; padding: 0 8%; }
        .section-header h2 { font-size: 3rem; color: var(--accent); margin-bottom: 20px; }
        .section-header .line { width: 80px; height: 1px; background: var(--accent); margin: 0 auto; opacity: 0.4; }

        .swiper { width: 100%; padding-top: 80px; padding-bottom: 100px; }
        .swiper-slide {
            width: 320px;
            height: auto;
            transition: 1s cubic-bezier(0.4, 0, 0.2, 1);
            filter: blur(4px) brightness(0.5);
            transform: scale(0.85);
        }
        .swiper-slide-active { 
            filter: blur(0) brightness(1); 
            transform: scale(1.05); 
        }

        .team-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(197, 163, 104, 0.1);
            padding: 60px 40px;
            text-align: center;
            backdrop-filter: blur(15px);
            border-radius: 4px;
        }
        .member-img {
            width: 140px; height: 140px;
            border-radius: 50%;
            margin: 0 auto 30px;
            border: 2px solid var(--accent);
            padding: 6px;
            overflow: hidden;
        }
        .member-img img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
        .team-card h4 { font-size: 1.7rem; color: var(--white); margin-bottom: 10px; letter-spacing: 1px; }
        .team-card span { font-size: 0.7rem; color: var(--accent); text-transform: uppercase; letter-spacing: 4px; font-weight: 600; display: block; margin-bottom: 25px; }
        
        .member-socials { display: flex; justify-content: center; gap: 20px; }
        .member-socials a { color: var(--accent-light); opacity: 0.4; transition: 0.3s; font-size: 1.1rem; }
        .member-socials a:hover { color: var(--accent); opacity: 1; transform: translateY(-3px); }

        .swiper-pagination-bullet { background: var(--accent) !important; opacity: 0.3; }
        .swiper-pagination-bullet-active { opacity: 1; width: 30px; border-radius: 10px; }

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
        .footer-desc p { opacity: 0.4; line-height: 2; font-size: 0.95rem; }

        .footer-links h4 { color: var(--accent); margin-bottom: 35px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 4px; }
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { text-decoration: none; color: var(--accent-light); opacity: 0.5; transition: 0.3s; font-size: 0.9rem; }
        .footer-links a:hover { opacity: 1; color: var(--accent); padding-left: 10px; }

        .footer-bottom {
            text-align: center;
            padding-top: 50px;
            border-top: 1px solid rgba(197, 163, 104, 0.05);
            font-size: 0.65rem;
            letter-spacing: 5px;
            opacity: 0.3;
            text-transform: uppercase;
        }

        /* === 7. RESPONSIVE === */
        @media (max-width: 1150px) {
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .story-section { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .swiper-slide { width: 280px; }
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

    <!-- [2. PREMIUM MOBILE NAVIGATION OVERLAY] -->
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

    <!-- [3. ABOUT HERO] -->
    <section class="about-hero">
        <div data-aos="fade-up">
            <p>Our Legacy & Vision</p>
            <h1>Esensi Priangan</h1>
        </div>
    </section>

    <!-- [4. STORY SECTION] -->
    <section class="story-section">
        <div class="story-image" data-aos="fade-right">
            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1000" alt="Sukabumi Heritage">
        </div>
        <div class="story-text" data-aos="fade-left">
            <h2>Digitalisasi Warisan Rasa Sukabumi.</h2>
            <p>Rasa Priangan adalah perpaduan antara inovasi spasial dan pelestarian budaya. Kami menghadirkan kemudahan bagi setiap petualang rasa untuk menemukan permata kuliner yang tersembunyi di Kota Sukabumi.</p>
            <p>Setiap titik dalam peta kami bukan sekadar koordinat, melainkan cerita tentang dedikasi UMKM lokal dalam menjaga warisan resep turun-temurun.</p>
            <p>Misi kami jelas: memastikan kekayaan cita rasa Priangan tetap relevan dan mudah dijangkau melalui ekosistem digital yang modern dan elegan.</p>
        </div>
    </section>

    <!-- [5. TEAM SLIDER SECTION] -->
    <section class="team-section">
        <div class="section-header" data-aos="fade-up">
            <h2>Tim Pengembang</h2>
            <div class="line"></div>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="team-card">
                        <div class="member-img">
                            <img src="https://raw.githubusercontent.com/Ranggis/Api-Image/main/ranggis.png" alt="Team">
                        </div>
                        <h4>Ranggis</h4>
                        <span>Project Lead</span>
                        <div class="member-socials">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="team-card">
                        <div class="member-img">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Anya" alt="Team">
                        </div>
                        <h4>Salwa</h4>
                        <span>GIS Analyst</span>
                        <div class="member-socials">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="team-card">
                        <div class="member-img">
                            <img src="https://raw.githubusercontent.com/Ranggis/Api-Image/main/faishal.png" alt="Team">
                        </div>
                        <h4>Faishal</h4>
                        <span>Lead Developer</span>
                        <div class="member-socials">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="team-card">
                        <div class="member-img">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah" alt="Team">
                        </div>
                        <h4>Kayla</h4>
                        <span>Creative Designer</span>
                        <div class="member-socials">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide">
                    <div class="team-card">
                        <div class="member-img">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Leo" alt="Team">
                        </div>
                        <h4>Rizzi</h4>
                        <span>Data Specialist</span>
                        <div class="member-socials">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // AOS Animation
        AOS.init({ duration: 1200, once: true, easing: 'ease-in-out' });

        // Sticky Navbar
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // Mobile Menu Toggle
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

        // Swiper Slider Logic
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            speed: 1500,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            coverflowEffect: {
                rotate: 5,
                stretch: 0,
                depth: 150,
                modifier: 1.5,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
        });
    </script>
</body>
</html>