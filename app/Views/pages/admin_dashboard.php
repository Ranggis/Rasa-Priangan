<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Master Control Panel</title>
    
    <!-- Library Eksternal (IDENTIK) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* === 1. DESIGN SYSTEM === */
        :root {
            --bg-dark: #0d0805;
            --bg-medium: #1b110b;
            --accent: #c0a080;
            --accent-dim: rgba(192, 160, 128, 0.1);
            --accent-light: #f4ece2;
            --text-gold: #d4b996;
            --white: #ffffff;
            --glass: rgba(13, 8, 5, 0.94);
            --transition: all 0.6s cubic-bezier(0.77, 0, 0.175, 1);
            --error: #ff4d4d;
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

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-dark); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }

        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        /* === 3. PREMIUM NAVBAR (IDENTIK) === */
        nav {
            position: fixed; top: 0; width: 100%; padding: 30px 8%;
            display: flex; justify-content: space-between; align-items: center;
            z-index: 1000; transition: var(--transition);
        }
        nav.scrolled { background: var(--glass); padding: 18px 8%; backdrop-filter: blur(30px); border-bottom: 1px solid rgba(192, 160, 128, 0.1); }
        
        .nav-logo { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--accent); text-decoration: none; font-weight: 700; z-index: 1001; }
        
        .nav-links { display: flex; gap: 35px; list-style: none; align-items: center; }
        .nav-links a {
            text-decoration: none; color: var(--accent-light); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 500; position: relative; padding: 8px 0;
            transition: 0.3s;
        }

        .nav-links a::after {
            content: ""; position: absolute; bottom: 0; left: 50%; width: 0; height: 2px; background: var(--accent); transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); transform: translateX(-50%);
        }
        .nav-links a:hover::after { width: 100%; }
        .nav-links a:hover { color: var(--accent); }

        .mobile-toggle { display: none; cursor: pointer; z-index: 1001; color: var(--accent); font-size: 1.8rem; }

        /* === 4. PREMIUM MOBILE NAVIGATION (ANIMASI SAMA PERSIS) === */
        .nav-overlay {
            position: fixed; top: 0; right: -100%; width: 100%; height: 100vh;
            background: var(--bg-dark); display: flex; flex-direction: column;
            justify-content: center; align-items: center; transition: var(--transition); z-index: 2000;
        }
        .nav-overlay.active { right: 0; }

        .close-menu { 
            position: absolute; top: 35px; right: 8%; font-size: 2.2rem; 
            color: var(--accent); cursor: pointer; transition: 0.3s; padding: 10px; 
        }
        .close-menu:hover { transform: rotate(90deg); color: var(--white); }
        
        .nav-overlay ul { list-style: none !important; text-align: center; width: 100%; padding: 0 !important; }
        .nav-overlay li { 
            margin: 20px 0; opacity: 0; transform: translateY(20px); 
            transition: 0.6s ease; list-style: none !important; 
        }
        .nav-overlay.active li { opacity: 1; transform: translateY(0); }
        
        /* Staggered Delay (Falling In Effect) */
        .nav-overlay li:nth-child(1) { transition-delay: 0.2s; }
        .nav-overlay li:nth-child(2) { transition-delay: 0.3s; }
        .nav-overlay li:nth-child(3) { transition-delay: 0.4s; }
        .nav-overlay li:nth-child(4) { transition-delay: 0.5s; }

        .nav-overlay a { 
            font-family: 'Playfair Display', serif; font-size: 2.2rem; 
            color: var(--accent-light); text-decoration: none; display: inline-block; 
            transition: 0.3s;
        }
        .nav-overlay a:hover { color: var(--accent); letter-spacing: 2px; }

        .mobile-footer-info { position: absolute; bottom: 50px; text-align: center; }
        .mobile-socials { display: flex; justify-content: center; gap: 35px; color: var(--accent); font-size: 1.5rem; margin-bottom: 15px; }
        .mobile-socials a { color: var(--accent); text-decoration: none; transition: 0.3s; }
        .mobile-socials a:hover { color: var(--white); transform: translateY(-3px); }

        /* === 5. DASHBOARD LAYOUT === */
        .dashboard-hero { 
            padding: 180px 8% 60px; 
            background: linear-gradient(to bottom, #1b110b, var(--bg-dark)); 
            border-bottom: 1px solid var(--accent-dim);
        }
        .dashboard-hero h1 { font-size: clamp(2.5rem, 8vw, 4rem); color: var(--white); margin-bottom: 10px; }
        .dashboard-hero p { color: var(--accent); text-transform: uppercase; letter-spacing: 5px; font-size: 0.8rem; font-weight: 600; }

        .admin-container { padding: 0 8% 100px; }

        .table-wrapper {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(192, 160, 128, 0.08);
            backdrop-filter: blur(20px);
            padding: 40px;
            margin-top: 40px;
        }

        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; flex-wrap: wrap; gap: 20px; }
        .table-header h2 { font-size: 1.8rem; color: var(--accent); font-weight: 500; }

        .btn-add { 
            background: var(--accent); color: var(--bg-dark); padding: 14px 28px; 
            text-decoration: none; font-weight: 700; font-size: 0.7rem; 
            letter-spacing: 2px; text-transform: uppercase; transition: 0.4s;
            border: none; cursor: pointer; display: flex; align-items: center; gap: 10px;
        }
        .btn-add:hover { background: var(--white); transform: translateY(-3px); }

        .responsive-table-container { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

        table { width: 100%; border-collapse: collapse; min-width: 950px; }
        th { text-align: left; padding: 22px; color: var(--accent); text-transform: uppercase; font-size: 0.65rem; letter-spacing: 3px; border-bottom: 1px solid var(--accent); opacity: 0.8; }
        td { padding: 22px; border-bottom: 1px solid rgba(192, 160, 128, 0.05); font-size: 0.9rem; font-weight: 300; vertical-align: middle; }
        
        .store-name { color: var(--white); font-weight: 600; font-size: 1rem; display: block; margin-bottom: 5px; }
        .store-cat { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--accent); opacity: 0.7; }
        .coord-badge { font-family: 'JetBrains Mono', monospace; background: rgba(192, 160, 128, 0.08); padding: 6px 12px; border-radius: 4px; color: var(--text-gold); font-size: 0.8rem; border: 1px solid rgba(192, 160, 128, 0.1); }

        .action-btns { display: flex; gap: 20px; font-size: 1.1rem; }
        .btn-edit { color: var(--accent); transition: 0.3s; opacity: 0.7; }
        .btn-edit:hover { color: var(--white); transform: scale(1.2); opacity: 1; }
        .btn-delete { color: var(--error); transition: 0.3s; opacity: 0.7; }
        .btn-delete:hover { color: #ff0000; transform: scale(1.2); opacity: 1; }

        /* === 6. MODAL === */
        .modal {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.95); z-index: 5000;
            justify-content: center; align-items: center; padding: 20px; backdrop-filter: blur(10px);
        }
        .modal-content {
            background: var(--bg-medium); border: 1px solid var(--accent);
            width: 100%; max-width: 850px; padding: 60px; position: relative;
            box-shadow: 0 50px 100px rgba(0,0,0,0.8);
            animation: modalFade 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 90vh; overflow-y: auto;
        }
        @keyframes modalFade { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); margin-bottom: 12px; font-weight: 700; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; background: rgba(255,255,255,0.03); border: none;
            border-bottom: 1px solid rgba(192, 160, 128, 0.2);
            padding: 12px 0; color: white; font-family: inherit; transition: 0.4s;
            font-size: 0.95rem; border-radius: 0;
        }
        .form-group input:focus { border-bottom: 1px solid var(--accent); background: rgba(192, 160, 128, 0.05); }

        /* === 7. PREMIUM FOOTER (IDENTIK) === */
        footer {
            padding: 100px 8% 60px;
            background: #050302;
            border-top: 1px solid rgba(197, 163, 104, 0.1);
        }

        .footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 100px; margin-bottom: 80px; }
        .footer-desc h2 { font-size: 2.2rem; color: var(--accent); margin-bottom: 25px; font-weight: 700; }
        .footer-desc p { opacity: 0.4; line-height: 2; font-size: 0.9rem; }

        .footer-links h4 { color: var(--accent); margin-bottom: 30px; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 3px; }
        .footer-links ul { list-style: none !important; padding: 0 !important; }
        .footer-links li { margin-bottom: 15px; list-style: none !important; }
        .footer-links a { text-decoration: none; color: var(--accent-light); opacity: 0.4; transition: 0.3s; font-size: 0.85rem; }
        .footer-links a:hover { opacity: 1; color: var(--accent); padding-left: 8px; }

        .footer-bottom {
            text-align: center; padding-top: 50px; border-top: 1px solid rgba(197, 163, 104, 0.05);
            font-size: 0.65rem; letter-spacing: 6px; opacity: 0.3; text-transform: uppercase;
        }

        /* === 8. RESPONSIVE === */
        @media (max-width: 1150px) {
            .form-grid { grid-template-columns: 1fr; }
            .modal-content { padding: 40px 25px; }
            nav { padding: 25px 8%; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .footer-main { grid-template-columns: 1fr; gap: 60px; text-align: center; }
            .table-wrapper { padding: 25px 15px; }
            .dashboard-hero { padding: 150px 8% 50px; }
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
            <li><a href="<?= base_url('/katalog') ?>">Katalog</a></li>
            <li><a href="<?= base_url('/logout') ?>" style="color: var(--error); font-weight: 700;">Sign Out</a></li>
        </ul>

        <div class="mobile-toggle" id="menuToggle">
            <i class="fa-solid fa-bars-staggered"></i>
        </div>
    </nav>

    <!-- 2. MOBILE NAVIGATION OVERLAY (ANIMASI IDENTIK) -->
    <div class="nav-overlay" id="navOverlay">
        <div class="close-menu" id="closeMenu"><i class="fa-solid fa-xmark"></i></div>
        <ul>
            <li><a href="<?= base_url('/') ?>">Beranda</a></li>
            <li><a href="<?= base_url('/map') ?>">Eksplorasi Peta</a></li>
            <li><a href="<?= base_url('/katalog') ?>">Katalog</a></li>
            <li><a href="<?= base_url('/logout') ?>" style="color: var(--error);">Sign Out</a></li>
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

    <!-- 3. DASHBOARD HERO -->
    <header class="dashboard-hero">
        <div data-aos="fade-right">
            <p>Master Control Panel</p>
            <h1>Database Center</h1>
        </div>
    </header>

    <!-- 4. MAIN DATA TABLE -->
    <main class="admin-container">
        <!-- Notifikasi -->
        <?php if(session()->getFlashdata('success')): ?>
            <div style="background: rgba(0, 255, 136, 0.05); color: #00ff88; border: 1px solid rgba(0, 255, 136, 0.2); padding: 20px; margin-top: 30px; font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; text-align: center; animation: fadeIn 0.5s ease;">
                <i class="fa-solid fa-circle-check" style="margin-right: 10px;"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="table-wrapper" data-aos="fade-up">
            <div class="table-header">
                <h2>Heritage Registry</h2>
                <button class="btn-add" onclick="toggleModal()"><i class="fa fa-plus-circle"></i> New Entry</button>
            </div>

            <div class="responsive-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Location Identity</th>
                            <th>Information</th>
                            <th>Product</th>
                            <th>Coordinates</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($toko)): foreach($toko as $row): ?>
                        <tr>
                            <td>
                                <span class="store-name"><?= $row['nama_toko'] ?></span>
                                <span class="store-cat"><?= $row['nama_kategori'] ?></span>
                            </td>
                            <td style="max-width: 250px; opacity: 0.6; font-size: 0.8rem; line-height: 1.5;"><?= (strlen($row['alamat']) > 60) ? substr($row['alamat'], 0, 60).'...' : $row['alamat'] ?></td>
                            <td><span style="color: var(--accent); font-weight: 500;"><?= $row['produk_unggulan'] ?></span></td>
                            <td><span class="coord-badge"><?= round($row['lat'], 4) ?> , <?= round($row['lng'], 4) ?></span></td>
                            <td class="action-btns">
                                <a href="#" class="btn-edit" title="Edit Entry"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="<?= base_url('admin/delete/'.$row['id']) ?>" class="btn-delete" title="Remove Entry" onclick="return confirm('Sistem: Hapus data ini secara permanen?')"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center; opacity:0.3; padding: 100px; letter-spacing: 2px;">NO DATA DETECTED</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- 5. MODAL ADD DATA -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:40px;">
                <h2 style="color: var(--accent); font-size: 2rem;">New Entry Protocol</h2>
                <i class="fa-solid fa-xmark" style="cursor:pointer; font-size:1.5rem; color:var(--accent);" onclick="toggleModal()"></i>
            </div>
            
            <form action="<?= base_url('admin/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Store Name / Identity</label>
                        <input type="text" name="nama_toko" required placeholder="e.g. Mochi Kaswari Luxe">
                    </div>
                    <div class="form-group">
                        <label>Category Group</label>
                        <select name="kategori_id" required>
                            <option value="" disabled selected>Select Category</option>
                            <?php foreach($kategori as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Physical Address</label>
                    <textarea name="alamat" rows="2" required placeholder="Full street address..."></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Latitude (Y)</label>
                        <input type="text" name="lat" placeholder="-6.9211" required>
                    </div>
                    <div class="form-group">
                        <label>Longitude (X)</label>
                        <input type="text" name="lng" placeholder="106.9261" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Signature Product</label>
                        <input type="text" name="produk_unggulan" placeholder="Best seller item">
                    </div>
                    <div class="form-group">
                        <label>Operating Hours</label>
                        <input type="text" name="jam_operasional" placeholder="Ex: 08:00 - 21:00">
                    </div>
                </div>

                <div class="form-group">
                    <label>Visual Asset (Store Image)</label>
                    <input type="file" name="foto" required style="border:none; padding-top: 10px;">
                </div>

                <div style="display:flex; gap:20px; margin-top:40px;">
                    <button type="submit" class="btn-add" style="width:100%; padding: 20px; justify-content:center;">Save to Database</button>
                    <button type="button" class="btn-add" style="width:100%; background: transparent; border: 1px solid var(--accent); color: var(--accent); padding: 20px; justify-content:center;" onclick="toggleModal()">Abort</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 6. FOOTER (IDENTIK) -->
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
                    <li><a href="<?= base_url('/tentang') ?>">Tentang Projek</a></li>
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
            &copy; 2025 RASA PRIANGAN — THE ART OF GEOSPATIAL MANAGEMENT.
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Animasi Inisialisasi
        AOS.init({ duration: 1200, once: true, easing: 'ease-in-out' });

        // Sticky Navbar logic
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // Mobile Menu Logic (ANIMASI SAMA PERSIS)
        const menuToggle = document.getElementById('menuToggle'),
              navOverlay = document.getElementById('navOverlay'),
              closeMenu = document.getElementById('closeMenu');

        menuToggle.addEventListener('click', () => { 
            navOverlay.classList.add('active'); 
            document.body.style.overflow = 'hidden'; 
        });
        
        closeMenu.addEventListener('click', () => { 
            navOverlay.classList.remove('active'); 
            document.body.style.overflow = 'auto'; 
        });

        // Close menu when links are clicked
        navOverlay.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });

        // Modal Logic
        function toggleModal() {
            const modal = document.getElementById('addModal');
            const isVisible = modal.style.display === 'flex';
            modal.style.display = isVisible ? 'none' : 'flex';
            document.body.style.overflow = isVisible ? 'auto' : 'hidden';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('addModal');
            if (event.target == modal) toggleModal();
        }
    </script>
</body>
</html>