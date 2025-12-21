<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Peta | Rasa Priangan</title>
    
    <!-- Library Eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* === 1. DESIGN SYSTEM === */
        :root {
            --bg-dark: #080605;
            --accent: #c0a080;
            --accent-dim: rgba(192, 160, 128, 0.2);
            --white: #ffffff;
            --glass: rgba(10, 8, 7, 0.96);
            --transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            --panel-w: 350px;
            /* Tambahan warna untuk fitur baru */
            --success: #00ff88;
            --danger: #ff4d4d;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-dark); color: var(--white); overflow: hidden; }

        /* === 2. NAVIGATION (DESKTOP vs MOBILE) === */
        nav {
            position: fixed; top: 0; width: 100%; padding: 25px 8%;
            display: flex; justify-content: space-between; align-items: center;
            z-index: 3000; transition: var(--transition);
        }
        nav.scrolled { padding: 15px 8%; background: var(--glass); border-bottom: 1px solid var(--accent-dim); backdrop-filter: blur(20px); }
        .nav-logo { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--accent); text-decoration: none; font-weight: 700; }
        
        .nav-links { display: flex; gap: 30px; list-style: none; }
        .nav-links a { text-decoration: none; color: var(--white); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 600; opacity: 0.6; transition: 0.3s; }
        .nav-links a:hover { opacity: 1; color: var(--accent); }

        .mobile-hamburger { display: none; font-size: 1.6rem; color: var(--accent); cursor: pointer; }

        /* === 3. MAP & MARKER === */
        #map { width: 100vw; height: 100vh; z-index: 1; filter: contrast(1.1) brightness(0.9); }
        
        .marker-wrapper { display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; }
        .marker-pin {
            width: 32px; height: 32px; background: white; border-radius: 50% 50% 50% 4px;
            transform: rotate(-45deg); display: flex; justify-content: center; align-items: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.4); border: 2px solid var(--accent);
            animation: bounce 2s infinite alternate;
        }
        .marker-pin i { transform: rotate(45deg); font-size: 1rem; color: #000; }
        .marker-pulse { position: absolute; width: 35px; height: 35px; border-radius: 50%; background: var(--accent); opacity: 0.3; animation: pulse 2s infinite; }
        
        /* GPS User Marker */
        .user-gps-marker { width: 18px; height: 18px; background: #4285F4; border: 3px solid white; border-radius: 50%; box-shadow: 0 0 15px rgba(66,133,244,0.7); }
        .user-gps-pulse { position: absolute; width: 40px; height: 40px; background: rgba(66,133,244,0.2); border: 1px solid rgba(66,133,244,0.5); border-radius: 50%; animation: pulse 2s infinite; }

        @keyframes bounce { from { transform: rotate(-45deg) translateY(0); } to { transform: rotate(-45deg) translateY(-8px); } }
        @keyframes pulse { 0% { transform: scale(1); opacity: 0.6; } 100% { transform: scale(2.5); opacity: 0; } }

        /* === 4. POPUP LUXURY (FIX BUG TOMBOL X - TITAN SIZE) === */
        .leaflet-popup-content-wrapper { 
            background: #0d0b0a !important; color: white !important; 
            border-radius: 15px !important; border: 1px solid var(--accent) !important;
            padding: 0 !important; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.8);
        }
        
        .leaflet-popup-close-button {
            width: 42px !important; height: 42px !important; line-height: 42px !important; 
            font-size: 30px !important; color: var(--accent) !important; 
            background: rgba(0,0,0,0.8) !important; border: 1px solid var(--accent) !important;
            border-radius: 50% !important; top: 12px !important; right: 12px !important; 
            z-index: 9999 !important; pointer-events: auto !important; 
        }
        .leaflet-popup-close-button:hover { background: var(--accent) !important; color: #000 !important; }

        .pop-card { width: 280px; }
        .pop-img { width: 100%; height: 150px; object-fit: cover; border-bottom: 2px solid var(--accent); }
        .pop-body { padding: 20px; text-align: center; }
        .pop-body h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--accent); margin-bottom: 5px; }
        .pop-body p { font-size: 0.8rem; opacity: 0.6; margin-bottom: 15px; }
        .pop-btn { background: var(--accent); color: #000; border: none; padding: 12px; width: 100%; font-weight: 800; font-size: 0.65rem; border-radius: 8px; cursor: pointer; transition: 0.3s; }
        .pop-btn:hover { background: #fff; transform: translateY(-3px); }

        /* Styles tambahan fitur baru di Popup */
        .pop-status-badge { font-size: 0.6rem; font-weight: 800; padding: 3px 10px; border-radius: 20px; display: inline-block; margin-bottom: 10px; border: 1px solid; }
        .status-open { background: rgba(0, 255, 136, 0.1); color: var(--success); border-color: var(--success); }
        .status-closed { background: rgba(255, 77, 77, 0.1); color: var(--danger); border-color: var(--danger); }
        .pop-actions-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 10px; }
        .wa-btn { background: #25D366 !important; color: white !important; grid-column: span 2; margin-top: 5px; }

        /* === NEW: TOOLTIP STYLE === */
        .custom-tooltip {
            background: #0d0b0a !important;
            color: #c0a080 !important;
            border: 1px solid #c0a080 !important;
            font-family: inherit;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 5px 12px;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }
        .leaflet-tooltip-top:before { border-top-color: #c0a080 !important; }

        /* === 5. PANELS (GIS & AI) === */
        .gis-panel {
            position: fixed; top: 0; right: -400px;
            width: var(--panel-w); height: 100vh; background: var(--glass);
            backdrop-filter: blur(30px); z-index: 4000;
            border-left: 1px solid var(--accent-dim);
            transition: var(--transition); display: flex; flex-direction: column;
        }
        .gis-panel.active { right: 0; }
        
        .ai-panel {
            position: fixed; top: 0; left: -400px;
            width: var(--panel-w); height: 100vh; background: var(--glass);
            backdrop-filter: blur(30px); z-index: 4000;
            border-right: 1px solid var(--accent-dim);
            transition: var(--transition); display: flex; flex-direction: column;
        }
        .ai-panel.active { left: 0; }

        .panel-trigger { position: absolute; bottom: 40px; right: 40px; width: 70px; height: 70px; background: var(--accent); color: #000; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 1.6rem; cursor: pointer; z-index: 1005; box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
        .ai-trigger { position: absolute; bottom: 125px; right: 40px; width: 70px; height: 70px; background: var(--accent); color: #000; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 1.6rem; cursor: pointer; z-index: 1005; box-shadow: 0 20px 40px rgba(0,0,0,0.5); transition: 0.3s; }


        .close-gis { position: absolute; top: 40px; left: -20px; width: 40px; height: 40px; background: var(--accent); border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; color: #000; box-shadow: -5px 0 15px rgba(0,0,0,0.3); }
        .close-ai { position: absolute; top: 40px; right: -20px; width: 40px; height: 40px; background: var(--accent); border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; color: #000; box-shadow: 5px 0 15px rgba(0,0,0,0.3); }

        .panel-content { padding: 50px 35px; overflow-y: auto; flex-grow: 1; }
        .panel-content h2 { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--accent); margin-bottom: 5px; }
        .tool-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 3px; color: var(--accent); margin: 30px 0 15px; display: block; opacity: 0.6; font-weight: 700; }

        .tool-btn {
            width: 100%; padding: 18px; background: rgba(255,255,255,0.02);
            border: 1px solid var(--accent-dim); color: #fff;
            text-align: left; font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 2px; font-weight: 700; cursor: pointer;
            margin-bottom: 12px; display: flex; align-items: center; gap: 15px; transition: 0.3s;
        }
        .tool-btn:hover { background: var(--accent); color: #000; border-color: var(--accent); padding-left: 25px; }
        .tool-btn.active { background: #4285F4; border-color: #4285F4; color: white; }

        /* AI Chat Styles */
        .chat-display { flex-grow: 1; overflow-y: auto; padding: 20px 0; display: flex; flex-direction: column; gap: 15px; }
        .chat-bubble { font-size: 0.8rem; padding: 12px 18px; border-radius: 15px; line-height: 1.5; max-width: 85%; }
        .chat-bubble.ai { background: rgba(255,255,255,0.05); color: #ddd; align-self: flex-start; border-bottom-left-radius: 2px; border: 1px solid rgba(192, 160, 128, 0.2); }
        .chat-bubble.user { background: var(--accent); color: #000; align-self: flex-end; border-bottom-right-radius: 2px; font-weight: 700; }
        .ai-input-wrapper { background: rgba(255,255,255,0.03); border: 1px solid var(--accent-dim); border-radius: 15px; padding: 10px; display: flex; gap: 10px; align-items: center; margin-top: 10px; }
        .ai-input-wrapper input { flex: 1; background: transparent; border: none; color: white; font-size: 0.8rem; padding: 5px; }

        /* Search & Trip Planner Styles */
        .search-container { position: relative; margin: 20px 0; }
        .search-container input { width: 100%; padding: 15px 45px 15px 20px; background: rgba(255,255,255,0.05); border: 1px solid var(--accent-dim); border-radius: 30px; color: white; font-size: 0.8rem; }
        .search-container i { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: var(--accent); }

        /* FITUR BARU: SEARCH SUGGESTIONS STYLE */
        .search-suggestions {
            position: absolute;
            top: 100%; left: 0; right: 0;
            background: rgba(10, 8, 7, 0.98);
            border: 1px solid var(--accent-dim);
            border-top: none; z-index: 1100;
            max-height: 200px; overflow-y: auto;
            border-radius: 0 0 15px 15px; display: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .suggestion-item {
            padding: 12px 20px; font-size: 0.75rem; color: white;
            cursor: pointer; border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: 0.2s;
        }
        .suggestion-item:hover { background: var(--accent); color: black; }

        #trip-planner-box { background: rgba(192, 160, 128, 0.05); padding: 15px; border-radius: 10px; border: 1px dashed var(--accent); margin: 20px 0; display: none; }
        .trip-item { font-size: 0.7rem; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 8px 0; display: flex; justify-content: space-between; align-items: center; }

        /* Toggle Layer Style */
        .layer-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 12px 15px; background: rgba(255,255,255,0.03);
            border: 1px solid var(--accent-dim); margin-bottom: 8px;
        }
        .layer-item span { font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.8); }
        
        .switch { position: relative; display: inline-block; width: 40px; height: 20px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #333; transition: .4s; border-radius: 20px; }
        .slider:before { position: absolute; content: ""; height: 14px; width: 14px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: var(--accent); }
        input:checked + .slider:before { transform: translateX(20px); }

        /* === 6. RESPONSIVE === */
        @media (max-width: 950px) {
            .nav-links { display: none; }
            .mobile-hamburger { display: block; }
            .gis-panel, .ai-panel { width: 100%; bottom: -100%; top: auto; right: 0; left: 0; height: 75vh; border-radius: 35px 35px 0 0; }
            .gis-panel.active { bottom: 0; }
            .ai-panel.active { bottom: 0; top: auto; left: 0; }
            
            /* Menyesuaikan Tombol Close di Mobile untuk AI dan GIS */
            .close-gis { top: -20px; left: 50%; transform: translateX(-50%) rotate(90deg); }
            .close-ai { top: -20px; left: 50%; right: auto; transform: translateX(-50%) rotate(90deg); }
            
            .panel-trigger { width: 60px; height: 60px; bottom: 30px; right: 30px; }
            .ai-trigger { width: 60px; height: 60px; bottom: 100px; right: 30px; }
        }

        .mobile-nav-overlay {
            position: fixed; top: 0; right: -100%; width: 100%; height: 100vh;
            background: var(--bg-dark); z-index: 6000; display: flex;
            flex-direction: column; justify-content: center; align-items: center; transition: 0.6s;
        }
        .mobile-nav-overlay.active { right: 0; }
        .mobile-nav-overlay a { font-family: 'Playfair Display', serif; font-size: 2.2rem; color: var(--accent); text-decoration: none; margin: 20px 0; }
        .swal-select { width: 100%; padding: 12px; background: #1a1512; color: #c0a080; border: 1px solid #c0a080; border-radius: 5px; margin: 10px 0; font-family: inherit; }

        /* Penyesuaian Font SweetAlert untuk Mobile */
        .swal-title-mobile {
            font-size: 1.2rem !important;
            font-family: 'Playfair Display', serif;
        }

        .swal-text-mobile {
            font-size: 0.85rem !important;
            opacity: 0.8;
        }

        /* Border emas tipis untuk alert agar senada dengan tema */
        .swal-luxury-border {
            border: 1px solid var(--accent) !important;
            border-radius: 15px !important;
        }

        /* Jika HP, buat toast sedikit lebih transparan agar peta tetap terlihat */
        @media (max-width: 768px) {
            .swal2-toast {
                background: rgba(13, 11, 10, 0.9) !important;
                backdrop-filter: blur(10px);
            }
        }
    </style>
</head>
<body>

    <!-- [NAVBAR] -->
    <nav id="navbar">
        <a href="#" class="nav-logo">Rasa Priangan.</a>
        <ul class="nav-links">
            <li><a href="<?= base_url('/') ?>">Beranda</a></li>
            <li><a href="<?= base_url('/map') ?>">Eksplorasi</a></li>
            <li><a href="<?= base_url('/katalog') ?>">Katalog</a></li>
            <li><a href="<?= base_url('/login') ?>">Admin</a></li>
        </ul>
        <div class="mobile-hamburger" id="openMobileNav"><i class="fa-solid fa-bars-staggered"></i></div>
    </nav>

    <!-- [MOBILE OVERLAY] -->
    <div class="mobile-nav-overlay" id="mobileNav">
        <div style="position:absolute; top:40px; right:8%; font-size:2.5rem; color:var(--accent); cursor:pointer;" id="closeMobileNav"><i class="fa-solid fa-xmark"></i></div>
        <a href="<?= base_url('/') ?>">Beranda</a>
        <a href="<?= base_url('/map') ?>">Eksplorasi</a>
        <a href="<?= base_url('/katalog') ?>">Katalog</a>
        <a href="<?= base_url('/login') ?>">Login</a>
    </div>

    <!-- [MAP SECTION] -->
    <div class="map-wrapper">
        <div id="map"></div>
        
        <!-- TRIGGERS -->
        <div class="ai-trigger" id="openAiPanel"><i class="fa-solid fa-brain"></i></div>
        <div class="panel-trigger" id="openGis"><i class="fa-solid fa-wand-magic-sparkles"></i></div>

        <!-- [AI INTELLIGENCE PANEL - LEFT] -->
        <aside class="ai-panel" id="aiPanel">
            <div class="close-ai" id="closeAiPanel"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="panel-content">
                <p style="font-size:0.6rem; letter-spacing:4px; opacity:0.5; margin-bottom:5px;">COGNITIVE ENGINE</p>
                <h2>AI Intelligence</h2>
                <div class="chat-display" id="chatDisplay">
                    <div class="chat-bubble ai">Halo! Saya asisten cerdas Rasa Priangan. Ingin tahu rekomendasi oleh-oleh terbaik di Sukabumi? Silakan tanya saya!</div>
                </div>
                <div id="aiLoading" style="display:none; font-size: 0.6rem; color: var(--accent); margin-bottom: 10px; font-style: italic;">
                    <i class="fa-solid fa-circle-notch fa-spin"></i> Memproses data kognitif...
                </div>
                <div class="ai-input-wrapper">
                    <input type="text" id="aiInputField" placeholder="Cari oleh-oleh yang enak..." onkeypress="if(event.key==='Enter') processAI()">
                    <button onclick="processAI()" style="background:var(--accent); border:none; width:35px; height:35px; border-radius:10px; cursor:pointer;">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- [GIS PANEL - RIGHT] -->
        <aside class="gis-panel" id="gisPanel">
            <div class="close-gis" id="closePanel"><i class="fa-solid fa-chevron-right"></i></div>
            <div class="panel-content">
                <p style="font-size:0.6rem; letter-spacing:4px; opacity:0.5; margin-bottom:5px;">SOVEREIGN COLLECTOR</p>
                <h2>Analisis Spasial</h2>

                <!-- SEARCH -->
                <div class="search-container">
                    <input type="text" id="storeSearch" placeholder="Cari nama toko..." onkeyup="handleStoreSearch()" autocomplete="off">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <div id="searchSuggestions" class="search-suggestions"></div>
                </div>

                <!-- TRIP PLANNER -->
                <div id="trip-planner-box">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                        <span style="font-size:0.7rem; font-weight:800; color:var(--accent);">TRIP PLANNER</span>
                        <a href="javascript:resetTripPlanner()" style="font-size:0.6rem; color:var(--danger); text-decoration:none;">RESET</a>
                    </div>
                    <div id="trip-items-list"></div>
                    <button class="tool-btn" style="background:var(--accent); color:#000; margin-top:10px; justify-content:center;" onclick="calculateTripRoute()">OPTIMALKAN RUTE</button>
                </div>

                <!-- LAYER BERDASARKAN KATEGORI -->
                <span class="tool-label">Filter Kategori</span>
                <div id="category-filters">
                    <!-- Diisi otomatis oleh JavaScript -->
                </div>

                <span class="tool-label">Perspektif Peta</span>
                <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:8px;">
                    <button class="tool-btn" style="justify-content:center; margin:0; font-size:0.6rem;" onclick="changeMap('dark')">Night</button>
                    <button class="tool-btn" style="justify-content:center; margin:0; font-size:0.6rem;" onclick="changeMap('street')">Street</button>
                    <button class="tool-btn" style="justify-content:center; margin:0; font-size:0.6rem;" onclick="changeMap('sat')">Satelit</button>
                </div>

                <span class="tool-label">Utilitas Geospasial</span>
                <button class="tool-btn" id="btn-realtime" onclick="toggleRealtimeTracking()">
                    <i class="fa-solid fa-person-walking-arrow-right"></i> <span id="text-realtime">Mulai Navigasi Real-time</span>
                </button>
                <button class="tool-btn" onclick="logicLocate()"><i class="fa-solid fa-location-crosshairs"></i> Fokus Lokasi Saya</button>
                <button class="tool-btn" onclick="logicNearest()"><i class="fa-solid fa-route"></i> Toko Terdekat</button>
                <button class="tool-btn" onclick="logicBuffer(1000)"><i class="fa-solid fa-bullseye"></i> Radius Buffer 1KM</button>
                
                <span class="tool-label">Analisis Lanjut</span>
                <button class="tool-btn" onclick="logicRadiusCustom()"><i class="fa-solid fa-circle-dot"></i> Cari Radius (m)</button>
                <button class="tool-btn" onclick="logicCompareStores()"><i class="fa-solid fa-code-compare"></i> Bandingkan 2 Toko</button>
                <button class="tool-btn" onclick="analyzeStoresInCityBoundary(cityBoundaryGeoJSON)"><i class="fa-solid fa-city"></i> Analisis Wilayah Kota</button>

                <span class="tool-label">Sistem</span>
                <button class="tool-btn" onclick="logicWeather()"><i class="fa-solid fa-cloud-bolt"></i> Cek Cuaca Lokal</button>
                <button class="tool-btn" style="margin-top:40px; border-color:rgba(255,0,0,0.1); color:#ff5e5e; justify-content:center;" onclick="logicReset()"><i class="fa-solid fa-trash-can"></i> Bersihkan Layer</button>
            </div>
        </aside>
    </div>

    <!-- SCRIPTS CORE -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // --- 1. CONFIGURATION ---
        const centerSukabumi = [-6.9211, 106.9261];
        
        // Base Layers
        const darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png');
        const streetLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', { attribution: '&copy; CartoDB Voyager' });
        const satLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}');

        const map = L.map('map', { zoomControl: false, layers: [darkLayer], closePopupOnClick: true }).setView(centerSukabumi, 14);

        const catLayers = {}; 
        const analysisLayer = L.layerGroup().addTo(map);
        
        let storeGeoJSON, userLocation = null, isTracking = false, userMarker = null;
        let cityBoundaryGeoJSON = null;
        let tripPoints = [];
        const weatherApiKey = "a38d422752dd794c58310dc626571b50";

        // --- 2. ICON FACTORY ---
        function createIcon(slug) {
            let iconClass = "fa-bag-shopping"; // Default

            // Sesuaikan dengan kategori_slug di database kamu
            if (slug === 'makanan-khas') iconClass = "fa-box-open";
            else if (slug === 'kuliner') iconClass = "fa-utensils";
            else if (slug === 'minuman-dessert') iconClass = "fa-ice-cream";
            else if (slug === 'fasilitas-pasar') iconClass = "fa-shop";

            return L.divIcon({ 
                className: 'marker-wrapper', 
                html: `<div class="marker-pulse"></div><div class="marker-pin"><i class="fa-solid ${iconClass}"></i></div>`, 
                iconSize: [40, 40], 
                iconAnchor: [20, 40] 
            });
        }

        // Logika Status Buka/Tutup
        function getStoreStatus(buka, tutup) {
            const now = new Date(); const hour = now.getHours();
            const isOpen = hour >= (buka || 8) && hour < (tutup || 21);
            return isOpen ? { text: 'BUKA SEKARANG', class: 'status-open' } : { text: 'SUDAH TUTUP', class: 'status-closed' };
        }

        // --- 3. DYNAMIC DATABASE LOADER ---
        async function loadCategoriesFromDB() {
            try {
                const res = await fetch('<?= base_url('api/categories') ?>');
                const categories = await res.json();
                const filterContainer = document.getElementById('category-filters');
                filterContainer.innerHTML = '';

                categories.forEach(cat => {
                    // Buat grup layer untuk setiap kategori
                    catLayers[cat.kategori_slug] = L.layerGroup().addTo(map);
                    
                    const item = document.createElement('div');
                    item.className = 'layer-item';
                    item.innerHTML = `
                        <span>${cat.nama_kategori}</span>
                        <label class="switch">
                            <input type="checkbox" checked onchange="toggleCategory('${cat.kategori_slug}')">
                            <span class="slider"></span>
                        </label>
                    `;
                    filterContainer.appendChild(item);
                });

                // PANGGIL TOKO SETELAH LAYER SIAP
                loadStoreDataFromDB();
                
            } catch (err) {
                console.error("Gagal memuat kategori:", err);
            }
        }
        async function loadStoreDataFromDB() {
            try {
                const res = await fetch('<?= base_url('api/geojson') ?>');
                storeGeoJSON = await res.json();

                // Bersihkan layer analisis jika ada
                analysisLayer.clearLayers();

                // JANGAN gunakan .addTo(map) di L.geoJSON agar layer tidak menempel di peta utama secara permanen
                L.geoJSON(storeGeoJSON, {
                    // 1. PROSES TITIK (MARKER)
                    pointToLayer: (f, latlng) => {
                        const p = f.properties;
                        
                        // Buat icon berdasarkan slug kategori
                        const markerIcon = createIcon(p.slug);
                        const marker = L.marker(latlng, { icon: markerIcon });
                        
                        // Masukkan marker HANYA ke grup kategori yang sesuai
                        if (p.slug && catLayers[p.slug]) {
                            marker.addTo(catLayers[p.slug]);
                        } else {
                            console.warn("Kategori slug tidak ditemukan atau tidak cocok:", p.slug);
                        }
                        
                        return marker;
                    },
                    
                    // 2. PROSES AREA (POLYGON) DAN POPUP
                    onEachFeature: (f, l) => {
                        const p = f.properties; 
                        const status = getStoreStatus(p.buka || 8, p.tutup || 21);
                        const ratingVal = p.rating || 0;
                        const stars = "⭐".repeat(Math.round(ratingVal)) || "No Rating";

                        // --- LOGIKA GAMBAR POLYGON JIKA ADA ---
                        if (p.polygon_data) {
                            try {
                                const geoJsonArea = JSON.parse(p.polygon_data);
                                const areaLayer = L.geoJSON(geoJsonArea, {
                                    style: {
                                        color: "#c0a080",
                                        weight: 2,
                                        fillOpacity: 0.2,
                                        dashArray: '5, 5'
                                    }
                                });

                                areaLayer.bindPopup(`Area: <b>${p.nama}</b>`);
                                
                                // Masukkan polygon ke layer kategori yang sama agar ikut hilang saat OFF
                                if (p.slug && catLayers[p.slug]) {
                                    areaLayer.addTo(catLayers[p.slug]);
                                }
                                
                            } catch (e) {
                                console.error("Gagal parse polygon " + p.nama, e);
                            }
                        }

                        // --- TOOLTIP & POPUP LUXURY ---
                        l.bindTooltip(`<b>${p.nama}</b>`, {
                            direction: 'top', offset: L.point(0, -35), className: 'custom-tooltip'
                        });

                        l.bindPopup(`
                            <div class="pop-card">
                                <img src="${p.foto}" class="pop-img" onerror="this.src='https://via.placeholder.com/400x250'">
                                <div class="pop-body">
                                    <span class="pop-status-badge ${status.class}">${status.text}</span>
                                    <div style="font-size: 0.7rem; color: #c0a080; margin-bottom: 5px;">${stars} (${ratingVal})</div>
                                    <h3>${p.nama}</h3>
                                    <p>${p.alamat}</p>
                                    <div class="pop-actions-grid">
                                        <button class="pop-btn" onclick="window.open('https://www.google.com/maps/dir/?api=1&destination=${p.lat},${p.lng}')">NAVIGASI</button>
                                        <button class="pop-btn" style="background:#fff; color:#000" onclick="addToTripPlanner('${p.nama}', ${p.lat}, ${p.lng})">+ TRIP</button>
                                        <button class="pop-btn wa-btn" onclick="showReviews(${p.id}, '${p.nama}')">ULASAN</button>
                                    </div>
                                </div>
                            </div>`, { maxWidth: 300, offset: L.point(0, -20) });
                    }
                }); 
                // PENTING: Perhatikan di sini TIDAK ADA .addTo(map)
                
            } catch (err) {
                console.error("Gagal memuat data toko:", err);
            }
        }

        // --- AI INTELLIGENCE CORE LOGIC ---
        async function processAI() {
            const input = document.getElementById('aiInputField');
            const display = document.getElementById('chatDisplay');
            const loading = document.getElementById('aiLoading');
            const query = input.value.trim();

            if (!query || !storeGeoJSON) return;

            // 1. Tampilkan Chat User
            display.innerHTML += `<div class="chat-bubble user">${query}</div>`;
            input.value = '';
            display.scrollTop = display.scrollHeight;
            loading.style.display = 'block';

            // Siapkan Konteks Data Toko
            const context = storeGeoJSON.features.map(f => `- ${f.properties.nama}: ${f.properties.produk}`).join('\n');
            try {
                const res = await fetch("<?= base_url('ai/chat') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        query: query,
                        context: context
                    })
                });

                const data = await res.json();

                // CEK APAKAH ADA ERROR DARI GOOGLE
                if (!res.ok) {
                    loading.style.display = 'none';
                    const errorMsg =
                    data.error?.message ||
                    data.error ||
                    data.message ||
                    "Kesalahan tidak diketahui";
                    display.innerHTML += `<div class="chat-bubble ai" style="color: #ff4d4d;">Error API: ${errorMsg}</div>`;
                    return;
                }

                // Ambil respon teks
                const reply = data.candidates[0].content.parts[0].text;
                loading.style.display = 'none';
                display.innerHTML += `<div class="chat-bubble ai">${reply}</div>`;
                display.scrollTop = display.scrollHeight;

                // Logika FlyTo jika menyebut nama toko
                storeGeoJSON.features.forEach(f => {
                    if (reply.toLowerCase().includes(f.properties.nama.toLowerCase())) {
                        map.flyTo([f.geometry.coordinates[1], f.geometry.coordinates[0]], 17);
                    }
                });

            } catch (err) {
                loading.style.display = 'none';
                console.error("Detail Error:", err);
                display.innerHTML += `<div class="chat-bubble ai">Maaf, koneksi ke server AI gagal. Pastikan internet aktif atau cek console browser (F12).</div>`;
            }
        }

        // --- GPS & ANALYSIS LOGIC ---
        function toggleRealtimeTracking() { 
            const btn = document.getElementById('btn-realtime'); 
            if (!isTracking) { 
                isTracking = true; 
                btn.classList.add('active'); 
                document.getElementById('text-realtime').innerText = "Hentikan Navigasi"; 
                map.locate({ watch: true, enableHighAccuracy: true }); 
            } else { 
                stopTracking(); 
            } 
        }

        function stopTracking() { 
            isTracking = false; 
            document.getElementById('btn-realtime').classList.remove('active'); 
            document.getElementById('text-realtime').innerText = "Mulai Navigasi Real-time"; 
            map.stopLocate(); 
            if (userMarker) { map.removeLayer(userMarker); userMarker = null; } 
        }

        map.on('locationfound', (e) => { 
            userLocation = e.latlng; 
            if (isTracking) { 
                if (!userMarker) { 
                    userMarker = L.marker(e.latlng, { icon: L.divIcon({ className: 'user-gps-container', html: '<div class="user-gps-pulse"></div><div class="user-gps-marker"></div>', iconSize: [20, 20], iconAnchor: [10, 10] }) }).addTo(map); 
                } else userMarker.setLatLng(e.latlng); 
                map.flyTo(e.latlng, map.getZoom(), { animate: true }); 
            } 
        });

        function logicLocate() { 
            map.locate({ setView: true, maxZoom: 16 }); 
            map.on('locationfound', (e) => { 
                userLocation = e.latlng; 
                analysisLayer.clearLayers(); 
                L.marker(e.latlng).addTo(analysisLayer).bindPopup("Lokasi Kamu").openPopup(); 
            }); 
        }

        function logicNearest() { 
            if(!userLocation) return Swal.fire('Error', 'Aktifkan GPS dahulu', 'error'); 
            const nearest = turf.nearestPoint(turf.point([userLocation.lng, userLocation.lat]), storeGeoJSON); 
            const dist = turf.distance(turf.point([userLocation.lng, userLocation.lat]), nearest, { units: 'kilometers' }).toFixed(2); 
            analysisLayer.clearLayers(); 
            L.polyline([[userLocation.lat, userLocation.lng], [nearest.geometry.coordinates[1], nearest.geometry.coordinates[0]]], { color: '#c0a080', weight: 4, dashArray: '10, 10' }).addTo(analysisLayer); 
            Swal.fire('Hasil', `Toko Terdekat: ${nearest.properties.nama}<br>Jarak: ${dist} KM`, 'success'); 
        }

        function logicBuffer(radiusM) { 
            if(!userLocation) return Swal.fire('Info', 'Aktifkan GPS dahulu', 'warning'); 
            analysisLayer.clearLayers(); 
            const buffer = turf.buffer(turf.point([userLocation.lng, userLocation.lat]), radiusM / 1000, { units: 'kilometers' }); 
            L.geoJSON(buffer, { style: { color: '#c0a080', fillOpacity: 0.1, weight: 1 } }).addTo(analysisLayer); 
            let count = 0; 
            storeGeoJSON.features.forEach(f => { if(turf.booleanPointInPolygon(f, buffer)) count++; }); 
            Swal.fire('Radius', `Ditemukan ${count} toko dalam radius 1km`, 'info'); 
        }
        
        function analyzeStoresInCityBoundary(cityBoundaryGeoJSON) {
            if (!cityBoundaryGeoJSON || !storeGeoJSON) {
                Swal.fire('Info', 'Data boundary atau toko belum siap', 'warning');
                return;
            }

            analysisLayer.clearLayers();

            let inside = 0;
            let outside = 0;

            storeGeoJSON.features.forEach(store => {
                const latlng = [
                    store.geometry.coordinates[1],
                    store.geometry.coordinates[0]
                ];

                if (turf.booleanPointInPolygon(store, cityBoundaryGeoJSON.features[0])) {
                    inside++;

                    // TOKO DALAM KOTA (HIJAU)
                    L.circleMarker(latlng, {
                        radius: 6,
                        color: '#00ff88',
                        fillColor: '#00ff88',
                        fillOpacity: 0.9
                    }).addTo(analysisLayer);

                } else {
                    outside++;

                    // TOKO LUAR KOTA (MERAH)
                    L.circleMarker(latlng, {
                        radius: 6,
                        color: '#ff4d4d',
                        fillColor: '#ff4d4d',
                        fillOpacity: 0.9
                    }).addTo(analysisLayer);
                }
            });

            Swal.fire({
                title: 'Analisis Administratif',
                html: `
                    <b>${inside}</b> toko di dalam Kota Sukabumi<br>
                    <b>${outside}</b> toko di luar wilayah kota
                `,
                icon: 'info'
            });
        }

        async function logicRadiusCustom() { 
            const { value: r } = await Swal.fire({ title: 'Radius Custom', input: 'number', inputLabel: 'Meter', background: '#0d0b0a', color: '#c0a080' }); 
            if(r) logicBuffer(r); 
        }

        async function logicCompareStores() { 
            let opts = storeGeoJSON.features.map((f, i) => `<option value="${i}">${f.properties.nama}</option>`).join(''); 
            const { value: form } = await Swal.fire({ title: 'Banding Toko', background: '#0d0b0a', color: '#c0a080', html: `<select id="storeA" class="swal-select">${opts}</select><select id="storeB" class="swal-select">${opts}</select>`, preConfirm: () => [document.getElementById('storeA').value, document.getElementById('storeB').value] }); 
            if (form) { 
                const sA = storeGeoJSON.features[form[0]]; 
                const sB = storeGeoJSON.features[form[1]]; 
                const d = turf.distance(turf.point(sA.geometry.coordinates), turf.point(sB.geometry.coordinates), { units: 'kilometers' }).toFixed(2); 
                analysisLayer.clearLayers(); 
                const line = L.polyline([[sA.geometry.coordinates[1], sA.geometry.coordinates[0]], [sB.geometry.coordinates[1], sB.geometry.coordinates[0]]], { color: '#c0a080', weight: 4 }).addTo(analysisLayer); 
                map.fitBounds(line.getBounds(), { padding: [100, 100] }); 
                Swal.fire('Hasil', `Jarak: ${d} KM`, 'success'); 
            } 
        }

        async function logicWeather() { 
            const l = userLocation || { lat: -6.9211, lng: 106.9261 }; 
            const res = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${l.lat}&lon=${l.lng}&appid=${weatherApiKey}&units=metric&lang=id`); 
            const data = await res.json(); 
            Swal.fire({ title: `Cuaca ${data.name}`, text: `${data.main.temp}°C - ${data.weather[0].description}`, background: '#0d0b0a', color: '#c0a080' }); 
        }
        
        function toggleCategory(slug) { 
            if (map.hasLayer(catLayers[slug])) map.removeLayer(catLayers[slug]); 
            else map.addLayer(catLayers[slug]); 
        }

        function changeMap(mode) { 
            map.removeLayer(darkLayer); map.removeLayer(streetLayer); map.removeLayer(satLayer); 
            if(mode === 'sat') map.addLayer(satLayer); 
            else if(mode === 'street') map.addLayer(streetLayer); 
            else map.addLayer(darkLayer); 
        }
        
        function addToTripPlanner(name, lat, lng) { 
            if (tripPoints.some(p => p.name === name)) return; 
            tripPoints.push({ name, lat, lng }); 
            updateTripUI(); 
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Ditambahkan ke Trip', showConfirmButton: false, timer: 1500 }); 
        }

        function updateTripUI() { 
            const box = document.getElementById('trip-planner-box'); 
            const list = document.getElementById('trip-items-list'); 
            box.style.display = tripPoints.length > 0 ? 'block' : 'none'; 
            list.innerHTML = tripPoints.map((p, i) => `<div class="trip-item"><span>${i+1}. ${p.name}</span><i class="fa-solid fa-trash" style="cursor:pointer; color:var(--danger)" onclick="removeFromTrip(${i})"></i></div>`).join(''); 
        }

        function removeFromTrip(index) { 
            tripPoints.splice(index, 1); 
            updateTripUI(); 
            if (tripPoints.length > 0) calculateTripRoute(); else analysisLayer.clearLayers(); 
        }

        function resetTripPlanner() { tripPoints = []; updateTripUI(); analysisLayer.clearLayers(); }

        function calculateTripRoute() { 
            if (tripPoints.length < 2) return Swal.fire('Info', 'Pilih minimal 2 toko', 'info'); 
            analysisLayer.clearLayers(); 
            const coords = tripPoints.map(p => [p.lat, p.lng]); 
            const line = L.polyline(coords, { color: '#c0a080', weight: 5, dashArray: '10, 15' }).addTo(analysisLayer); 
            map.fitBounds(line.getBounds(), { padding: [100, 100] }); 
        }

        function logicReset() { 
            analysisLayer.clearLayers(); 
            if (isTracking) stopTracking(); 
            resetTripPlanner(); 
            map.setView(centerSukabumi, 14); 
        }

        function handleStoreSearch() {
            const input = document.getElementById('storeSearch');
            const suggBox = document.getElementById('searchSuggestions');
            const query = input.value.toLowerCase();
            suggBox.innerHTML = '';
            if (query.length < 1) { suggBox.style.display = 'none'; return; }
            const matches = storeGeoJSON.features.filter(f => f.properties.nama.toLowerCase().includes(query));
            if (matches.length > 0) {
                suggBox.style.display = 'block';
                matches.forEach(f => {
                    const div = document.createElement('div');
                    div.className = 'suggestion-item';
                    div.innerText = f.properties.nama;
                    div.onclick = () => {
                        const coords = f.geometry.coordinates;
                        map.flyTo([coords[1], coords[0]], 17);
                        input.value = f.properties.nama;
                        suggBox.style.display = 'none';
                    };
                    suggBox.appendChild(div);
                });
            } else { suggBox.style.display = 'none'; }
        }

        async function showReviews(id, nama) {
            try {
                const res = await fetch(`<?= base_url('api/reviews') ?>/${id}`);
                const reviews = await res.json();
                let reviewHtml = reviews.length > 0 
                    ? reviews.map(r => `<div style="text-align:left; border-bottom:1px solid #333; padding:12px 0;"><b style="color:#c0a080">${r.nama_pengunjung}</b> (⭐${r.rating})<br><p style="margin-top:5px; opacity:0.7; font-size:0.85rem;">${r.komentar}</p></div>`).join('')
                    : '<p style="opacity:0.5; padding: 20px 0;">Belum ada ulasan.</p>';

                Swal.fire({
                    title: `<span style="font-family:serif; color:#c0a080; font-size: 1.8rem;">Ulasan ${nama}</span>`,
                    html: `<div style="max-height:350px; overflow-y:auto; padding-right:10px; margin-bottom: 20px;">${reviewHtml}</div><button class="pop-btn" onclick="writeReview(${id}, '${nama}')">TULIS ULASAN BARU</button>`,
                    background: '#0d0b0a', showConfirmButton: false, showCloseButton: true, width: '450px'
                });
            } catch (err) { Swal.fire('Error', 'Gagal mengambil ulasan', 'error'); }
        }

        // --- FITUR ULASAN ---
        async function showReviews(id, nama) {
            try {
                // PERBAIKAN 1: Pastikan menggunakan underscore '_' sesuai fungsi Controller
                const res = await fetch(`<?= base_url('api/reviews') ?>/${id}`);
                
                // Cek jika response error (404/500)
                if (!res.ok) throw new Error("Route tidak ditemukan atau server error");

                const reviews = await res.json();
                
                let reviewHtml = reviews.length > 0 
                    ? reviews.map(r => {
                        // PERBAIKAN 2: Pakai Number() agar .repeat() tidak error
                        const starCount = Number(r.rating) || 0; 
                        
                        return `
                        <div style="text-align:left; border-bottom:1px solid rgba(192, 160, 128, 0.2); padding:15px 0; color: white;">
                            <div style="display:flex; justify-content:space-between;">
                                <b style="color:#c0a080">${r.nama_pengunjung}</b>
                                <span style="color:#ffd700">${"⭐".repeat(starCount)}</span>
                            </div>
                            <p style="margin-top:5px; opacity:0.8; font-size:0.85rem; line-height:1.4;">"${r.komentar}"</p>
                        </div>`;
                    }).join('')
                    : '<p style="opacity:0.5; padding: 40px 0; text-align:center; color: white;">Belum ada ulasan untuk toko ini.</p>';

                Swal.fire({
                    title: `<span style="font-family:'Playfair Display',serif; color:#c0a080; font-size: 1.8rem;">Ulasan ${nama}</span>`,
                    html: `
                        <div style="max-height:350px; overflow-y:auto; padding-right:10px; margin-bottom: 20px;">
                            ${reviewHtml}
                        </div>
                        <button class="pop-btn" onclick="writeReview(${id}, '${nama}')" style="margin-top:10px;">
                            <i class="fa-solid fa-pen-to-square"></i> TULIS ULASAN BARU
                        </button>`,
                    background: '#0d0b0a',
                    showConfirmButton: false,
                    showCloseButton: true,
                    width: '450px'
                });
            } catch (err) { 
                console.error("Detail Error:", err);
                Swal.fire('Error', 'Gagal mengambil data ulasan. Pastikan Route di CI4 sudah benar.', 'error'); 
            }
        }

        async function writeReview(id, nama) {
            const { value: formValues } = await Swal.fire({
                title: `<span style="color:#c0a080;">Tulis Ulasan</span>`,
                background: '#0d0b0a',
                html: `
                    <div style="text-align:left; color:#fff;">
                        <label style="font-size:0.7rem; opacity:0.6;">Nama Anda</label>
                        <input id="swal-nama" class="swal-select" placeholder="Masukkan nama...">
                        <label style="font-size:0.7rem; opacity:0.6; margin-top:10px; display:block;">Rating</label>
                        <select id="swal-rating" class="swal-select">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <label style="font-size:0.7rem; opacity:0.6; margin-top:10px; display:block;">Komentar</label>
                        <textarea id="swal-komentar" class="swal-select" style="height:100px; padding:10px;" placeholder="Komentar Anda..."></textarea>
                    </div>`,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'KIRIM',
                preConfirm: () => {
                    return {
                        nama: document.getElementById('swal-nama').value,
                        rating: document.getElementById('swal-rating').value,
                        komentar: document.getElementById('swal-komentar').value
                    }
                }
            });

            if (formValues) {
                try {
                    const response = await fetch('<?= base_url('api/submit-review') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            toko_id: id,
                            nama: formValues.nama,
                            rating: formValues.rating,
                            komentar: formValues.komentar
                        })
                    });

                    if (!response.ok) {
                        throw new Error('HTTP Error ' + response.status);
                    }

                    const result = await response.json();

                    if (result.status === 'success') {
                        Swal.fire('Berhasil!', 'Ulasan tersimpan.', 'success')
                            .then(() => {
                                loadStoreDataFromDB();   // refresh marker & rating
                                showReviews(id, nama);  // buka ulang modal ulasan
                            });
                    } else {
                        Swal.fire('Gagal', 'Server menolak ulasan', 'error');
                    }

                } catch (e) {
                    console.error(e);
                    Swal.fire('Error', 'Gagal mengirim ulasan. Cek console & Network.', 'error');
                }
            }
        }

        // --- UI CONTROLS ---
        const gisPanel = document.getElementById('gisPanel');
        const aiPanel = document.getElementById('aiPanel');

        document.getElementById('openGis').onclick = () => gisPanel.classList.add('active');
        document.getElementById('closePanel').onclick = () => gisPanel.classList.remove('active');
        
        document.getElementById('openAiPanel').onclick = () => aiPanel.classList.add('active');
        document.getElementById('closeAiPanel').onclick = () => aiPanel.classList.remove('active');

        document.getElementById('openMobileNav').onclick = () => document.getElementById('mobileNav').classList.add('active');
        document.getElementById('closeMobileNav').onclick = () => document.getElementById('mobileNav').classList.remove('active');

        // Close suggestions on outside click
        document.addEventListener('click', (e) => {
            if (!document.querySelector('.search-container').contains(e.target)) {
                document.getElementById('searchSuggestions').style.display = 'none';
            }
        });

        async function loadCityBoundary() {
            try {
                const res = await fetch("<?= base_url('geojson/Kota_Sukabumi.geojson') ?>");
                cityBoundaryGeoJSON = await res.json(); // ⬅ SIMPAN

                L.geoJSON(cityBoundaryGeoJSON, {
                    style: {
                        color: "#ff4d4d",
                        weight: 2,
                        dashArray: "6, 10",
                        fillOpacity: 0.05
                    },
                    interactive: false
                }).addTo(map);

            } catch (e) {
                console.error("Gagal load boundary:", e);
            }
        }

        // Initialize
        loadCategoriesFromDB();
        loadCityBoundary();

        // === ALERT JIKA KLIK DI LUAR WILAYAH ADMINISTRATIF ===
        map.on('click', function (e) {
            if (!cityBoundaryGeoJSON) return;

            // 1. Logika Turf untuk mengecek titik
            const clickedPoint = turf.point([e.latlng.lng, e.latlng.lat]);
            const isInside = turf.booleanPointInPolygon(
                clickedPoint,
                cityBoundaryGeoJSON.features[0]
            );

            if (!isInside) {
                // 2. 🔊 Audio Feedback (Volume diperkecil agar tidak mengejutkan di HP)
                const audio = document.getElementById('bgSound');
                if (audio) {
                    audio.currentTime = 0;
                    audio.volume = 0.1; // Mobile user biasanya lebih sensitif suara
                    audio.play().catch(() => {});
                }

                // 3. Deteksi Mobile untuk Penyesuaian UI
                const isMobile = window.innerWidth <= 768;

                // 4. SweetAlert yang Responsif
                Swal.fire({
                    title: isMobile ? 'Luar Wilayah' : 'Di Luar Wilayah Administratif',
                    text: 'Lokasi ini berada di luar batas Kota Sukabumi.',
                    icon: 'warning',
                    background: '#0d0b0a',
                    color: '#c0a080',
                    confirmButtonColor: '#c0a080',
                    
                    // Pengaturan Khusus Mobile
                    toast: isMobile, // Jadi toast kecil di HP agar tidak mengganggu navigasi
                    position: isMobile ? 'top' : 'center', 
                    showConfirmButton: !isMobile, // Sembunyikan tombol OK di HP (auto close)
                    timer: isMobile ? 3000 : null, // Hilang otomatis dalam 3 detik jika di HP
                    timerProgressBar: isMobile,
                    
                    width: isMobile ? '90%' : '400px', // Lebar fleksibel
                    customClass: {
                        popup: 'swal-luxury-border',
                        title: 'swal-title-mobile',
                        htmlContainer: 'swal-text-mobile'
                    }
                });
            }
        });
    </script>

    <audio id="bgSound" preload="auto">
        <source src="<?= base_url('assets/audio/jarjit.mpeg') ?>" type="audio/mpeg">
    </audio>

</body>
</html>