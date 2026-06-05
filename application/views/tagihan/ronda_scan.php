<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Absen Ronda RT 004</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%);
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: linear-gradient(90deg, #6366f1 0%, #a855f7 100%);
            --accent-hover: linear-gradient(90deg, #4f46e5 0%, #9333ea 100%);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --success: #10b981;
            --error: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .mobile-container {
            width: 100%;
            max-width: 480px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid var(--glass-border);
            border-right: 1px solid var(--glass-border);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
        }

        header {
            padding: 40px 20px 25px 20px;
            text-align: center;
            border-bottom: 1px solid var(--glass-border);
        }

        .logo-area {
            margin-bottom: 15px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 56px;
            height: 56px;
            border-radius: 18px;
            background: rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: #818cf8;
            font-size: 28px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #c7d2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        header p {
            margin-top: 5px;
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .content {
            padding: 30px 20px;
            flex-grow: 1;
        }

        .card {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid var(--glass-border);
        }

        .info-card {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.12) 0%, rgba(168, 85, 247, 0.12) 100%);
            border-color: rgba(99, 102, 241, 0.2);
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            color: #818cf8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        .info-value {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
        }

        .select-wrapper {
            position: relative;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 15px 20px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid var(--glass-border);
            border-radius: 16px;
            font-size: 16px;
            font-family: inherit;
            font-weight: 600;
            color: var(--text-main);
            appearance: none;
            -webkit-appearance: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            background: rgba(15, 23, 42, 0.85);
        }

        .select-wrapper::after {
            content: "";
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid var(--text-muted);
            pointer-events: none;
        }

        select option {
            background: #0f172a;
            color: #f8fafc;
            padding: 15px;
        }

        .btn-submit {
            width: 100%;
            padding: 18px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 16px;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.5px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover:not(:disabled) {
            background: var(--accent-hover);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
            transform: translateY(-1px);
        }

        .btn-submit:active:not(:disabled) {
            transform: translateY(1px);
            box-shadow: 0 2px 6px rgba(99, 102, 241, 0.2);
        }

        .btn-submit:disabled {
            background: #475569;
            color: #94a3b8;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        #status {
            margin-top: 25px;
            padding: 16px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.5;
            display: none;
            text-align: center;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { transform: translateY(15px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .status-success { 
            background: rgba(16, 185, 129, 0.15); 
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399; 
            display: block !important; 
        }
        .status-error { 
            background: rgba(239, 68, 68, 0.15); 
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171; 
            display: block !important; 
        }
        .status-loading { 
            background: rgba(71, 85, 105, 0.15); 
            border: 1px solid rgba(71, 85, 105, 0.3);
            color: #94a3b8; 
            display: block !important; 
        }

        /* GPS Pill Badge */
        .gps-info {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 20px auto 0 auto;
            padding: 6px 14px;
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .gps-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--text-muted);
            display: inline-block;
        }

        .gps-active-dot {
            background: var(--success);
            box-shadow: 0 0 8px var(--success);
            animation: pulse 2s infinite;
        }

        .gps-error-dot {
            background: var(--error);
            box-shadow: 0 0 8px var(--error);
        }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.6; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.6; }
        }

        /* Custom Spinner */
        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 3px solid white;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        footer {
            padding: 25px 20px;
            text-align: center;
            font-size: 11px;
            color: var(--text-muted);
            border-top: 1px solid var(--glass-border);
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

<div class="mobile-container">
    <header>
        <div class="logo-area">🛡️</div>
        <h1>ABSEN RONDA ONLINE</h1>
        <p>RT 004 / RW 003 DESA KARANGRAU</p>
    </header>

    <div class="content">
        <div class="card info-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <span class="label">Hari Ini</span>
                    <div class="info-value"><?= $hari_nama ?></div>
                </div>
                <div style="text-align: right;">
                    <span class="label">Tanggal</span>
                    <div class="info-value"><?= $tanggal_ini ?></div>
                </div>
            </div>
        </div>

        <div class="card">
            <label class="label" for="nama_petugas">Pilih Nama Anda</label>
            <div class="select-wrapper">
                <select id="nama_petugas">
                    <option value="">-- Pilih Nama --</option>
                    <?php foreach ($petugas as $p): ?>
                        <option value="<?= $p->nama ?>"><?= $p->nama ?></option>
                    <?php endforeach; ?>
                    <option value="Lainnya / Cadangan">Lainnya / Cadangan</option>
                </select>
            </div>
            <p style="font-size: 11px; color: var(--text-muted); margin-top: 8px; font-weight: 500;">
                *Hanya menampilkan warga yang jadwalnya hari ini.
            </p>
        </div>

        <button id="btnAbsen" class="btn-submit">
            <span>🛡️ ABSEN SEKARANG</span>
        </button>

        <div id="status"></div>
        
        <div style="text-align: center; display: flex; justify-content: center;">
            <div class="gps-info" id="gps-badge">
                <span class="gps-dot" id="gps-dot"></span>
                <span id="gps-text">Sedang mendeteksi lokasi...</span>
            </div>
        </div>
    </div>

    <footer>
        &copy; <?= date('Y') ?> Keamanan RT 004 RW 003
    </footer>
</div>

<script>
    // GANTI URL INI DENGAN URL WEB APP ANDA DARI GOOGLE APPS SCRIPT
    const GOOGLE_SCRIPT_URL = "https://script.google.com/macros/s/AKfycbzxErla5UUaE2MWTqCgi901HYDi0TmesSYws5-yum5fZPyx7-mW401-Vwk8exSbONg/exec";

    const btn = document.getElementById('btnAbsen');
    const statusDiv = document.getElementById('status');
    const gpsText = document.getElementById('gps-text');
    const gpsDot = document.getElementById('gps-dot');
    const gpsBadge = document.getElementById('gps-badge');
    let userLocation = "Lokasi tidak terdeteksi";

    // Minta akses GPS saat halaman dibuka
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (pos) => {
                userLocation = `Lat: ${pos.coords.latitude}, Lng: ${pos.coords.longitude}`;
                gpsDot.className = "gps-dot gps-active-dot";
                gpsText.innerText = "📍 GPS Aktif (Siap Absen)";
                gpsBadge.style.borderColor = "rgba(16, 185, 129, 0.2)";
                gpsBadge.style.backgroundColor = "rgba(16, 185, 129, 0.1)";
            },
            (err) => {
                userLocation = "Izin lokasi ditolak";
                gpsDot.className = "gps-dot gps-error-dot";
                gpsText.innerText = "⚠️ Akses lokasi ditolak. Aktifkan GPS.";
                gpsBadge.style.borderColor = "rgba(239, 68, 68, 0.2)";
                gpsBadge.style.backgroundColor = "rgba(239, 68, 68, 0.1)";
            }
        );
    } else {
        gpsText.innerText = "Browser tidak mendukung GPS";
    }

    btn.addEventListener('click', async () => {
        const nama = document.getElementById('nama_petugas').value;

        if (!nama) {
            showStatus("Silakan pilih nama Anda terlebih dahulu!", "error");
            return;
        }

        if (GOOGLE_SCRIPT_URL === "URL_WEBAPP_GOOGLE_ANDA_DISINI") {
            showStatus("PENGURUS: Belum memasang URL Google Script di kode.", "error");
            return;
        }

        // Lock button
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner"></span> <span>Sedang mengirim data...</span>';
        showStatus("Menyimpan kehadiran ke Google Sheets...", "loading");

        const data = {
            nama: nama,
            hari: "<?= $hari_nama ?>",
            tanggal_absen: "<?= $tanggal_ini ?>",
            jam: new Date().toLocaleTimeString('id-ID'),
            lokasi: userLocation
        };

        try {
            // Gunakan fetch dengan mode no-cors agar tidak error saat kirim ke Google
            await fetch(GOOGLE_SCRIPT_URL, {
                method: 'POST',
                mode: 'no-cors',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            showStatus("🎉 BERHASIL! Absen Anda sudah tercatat di Google Sheets.", "success");
            btn.style.background = "#10b981";
            btn.style.boxShadow = "0 4px 12px rgba(16, 185, 129, 0.3)";
            btn.innerHTML = "✅ SUDAH ABSEN";
        } catch (error) {
            showStatus("Gagal mengirim data: " + error.message, "error");
            btn.disabled = false;
            btn.innerHTML = "🛡️ ABSEN SEKARANG";
        }
    });

    function showStatus(msg, type) {
        statusDiv.className = "";
        statusDiv.classList.add("status-" + type);
        statusDiv.innerText = msg;
    }
</script>

</body>
</html>
