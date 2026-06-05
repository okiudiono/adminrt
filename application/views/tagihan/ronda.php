<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Jadwal Ronda RT 004 RW 003 (Premium Edition)</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Outfit:wght@700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a365d;
            --primary-light: #2b6cb0;
            --accent: #dd6b20;
            --text-main: #2d3748;
            --border-color: #cbd5e0;
            --bg-page: #f7fafc;
            --surface: #ffffff;
        }

        @page {
            size: legal portrait;
            margin: 12mm 10mm 12mm 10mm;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            margin: 0;
            padding: 20px;
            font-size: 13px;
        }

        /* Toolbar / Non-printable controls */
        .no-print {
            background: var(--surface);
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0,0,0,0.02);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .no-print-title {
            font-weight: 700;
            color: var(--primary);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 13px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-print { background: var(--primary-light); color: white; }
        .btn-print:hover { background: var(--primary); transform: translateY(-1px); }
        .btn-back { background: #e2e8f0; color: #4a5568; }
        .btn-back:hover { background: #cbd5e0; color: #1a202c; }

        /* Printable Board Container */
        .board-container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--surface);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 2px solid var(--primary);
            box-sizing: border-box;
        }

        /* Board Header */
        .board-header {
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            border-bottom: 3px double var(--primary);
        }

        .board-header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 900;
            color: var(--primary);
            margin: 0;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .board-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent);
            margin: 5px 0 0 0;
            letter-spacing: 0.5px;
        }

        .board-header p {
            margin: 5px 0 0 0;
            font-size: 13px;
            font-weight: 600;
            color: #718096;
        }

        /* Grid Layout for 7 Days + 1 Info Card (Total 8 Slots perfectly balanced) */
        .days-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        /* Day Card */
        .day-card {
            border: 1.5px solid var(--primary);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: #fff;
            box-sizing: border-box;
        }

        .day-header {
            background: var(--primary);
            color: white;
            text-align: center;
            padding: 8px 5px;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 1.5px solid var(--primary);
        }

        /* Specific Day Accents for visual richness */
        .day-card:nth-child(7) .day-header {
            background: #c53030; /* Minggu Red Accent */
            border-bottom-color: #c53030;
        }
        .day-card:nth-child(6) .day-header {
            background: #2b6cb0; /* Sabtu Blue Accent */
            border-bottom-color: #2b6cb0;
        }

        /* Day Table */
        .day-table {
            width: 100%;
            border-collapse: collapse;
            flex-grow: 1;
        }

        .day-table th {
            background: #edf2f7;
            font-size: 11px;
            font-weight: 700;
            color: #4a5568;
            padding: 5px 4px;
            border-bottom: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            text-align: center;
        }

        .day-table th:last-child {
            border-right: none;
        }

        .day-table td {
            padding: 5px 6px;
            font-size: 12px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid var(--border-color);
            height: 24px; /* Fixed height to ensure 8 rows perfectly uniform */
            vertical-align: middle;
        }

        .day-table tr:last-child td {
            border-bottom: none;
        }

        .day-table td:last-child {
            border-right: none;
        }

        .col-no {
            width: 20px;
            text-align: center;
            font-weight: 600;
            color: #718096;
        }

        .col-name {
            font-weight: 600;
            color: #1a202c;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }



        /* Info Card / Tata Tertib Ronda (8th Slot) */
        .rules-card {
            background: #fffaf0;
            border: 1.5px dashed var(--accent);
            border-radius: 8px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .rules-title {
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            font-weight: 800;
            color: var(--accent);
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 1px solid #feebc8;
            padding-bottom: 4px;
        }

        .rules-list {
            margin: 0;
            padding-left: 15px;
            font-size: 11px;
            color: #543d13;
            line-height: 1.5;
        }

        .rules-list li {
            margin-bottom: 4px;
        }

        .board-footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 11px;
            font-weight: 600;
            color: #718096;
            padding-top: 10px;
            border-top: 1px solid #edf2f7;
        }

        /* Print Optimizations */
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .no-print { display: none; }
            .board-container {
                border: none;
                box-shadow: none;
                padding: 0;
                max-width: 100%;
                width: 100%;
            }
            .days-grid {
                gap: 8px; /* Compact gap to ensure single page printing perfectly */
            }
            .day-card {
                border-width: 1pt;
                border-color: #000 !important;
            }
            .day-header {
                font-size: 13px;
                padding: 5px 2px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .day-table th {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                font-size: 10px;
            }
            .day-table td {
                font-size: 11px;
                padding: 4px 5px;
                height: 22px;
                border-color: #ccc;
            }
            .rules-card {
                background-color: #fff !important;
                border: 1pt solid #000;
            }
            .rules-title { color: #000; }
            .board-header h1 { font-size: 26px; color: #000; }
            .board-header h2 { font-size: 15px; color: #333; }
            .board-header { margin-bottom: 15px; padding-bottom: 10px; border-bottom-color: #000; }
        }

        /* Layout modifications based on viewport for outstanding responsiveness */
        @media (max-width: 1024px) {
            .days-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .days-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Toolbar / Non-printable controls -->
    <div class="no-print">
        <div class="no-print-title">
            <span style="font-size: 1.2rem;">🛡️</span> Papan Jadwal Ronda Keamanan Warga
        </div>
        <div class="btn-group">
            <a href="<?= site_url('tagihan/ronda_qr') ?>" target="_blank" class="btn btn-print" style="background: #1a365d;">🔲 Cetak QR Pos</a>
            <a href="<?= site_url('tagihan/ronda_absen') ?>" target="_blank" class="btn btn-print" style="background: var(--primary);">📝 Cetak Absen Terisi (7 Hari)</a>
            <a href="<?= site_url('tagihan/ronda_harian') ?>" target="_blank" class="btn btn-print" style="background: var(--accent);">🖨️ Cetak Jadwal (1 Lembar)</a>
            <button onclick="window.print()" class="btn btn-print">🖨️ Cetak Papan Board</button>
            <a href="<?= site_url('tagihan/list') ?>" class="btn btn-back">Kembali</a>
        </div>
    </div>

    <!-- Printable Board Container -->
    <div class="board-container">
        
        <div class="board-header">
            <h1>JADWAL RONDA KEAMANAN</h1>
            <h2>RUKUN TETANGGA 004 / RW 003</h2>
            <p>DESA KARANGRAU • KECAMATAN SOKARAJA • KABUPATEN BANYUMAS</p>
        </div>

        <div class="days-grid">
            
            <!-- Hari 1 sampai 7 -->
            <?php foreach ($hari_list as $h_id => $h_nama): ?>
                <?php 
                $warga_hari = $jadwal[$h_id] ?? [];
                $total_warga = count($warga_hari);
                // Default tampilan 8 row per tabel hari
                $total_rows = max(8, $total_warga);
                ?>
                <div class="day-card">
                    <div class="day-header"><?= $h_nama ?></div>
                    <table class="day-table">
                        <thead>
                            <tr>
                                <th class="col-no">NO</th>
                                <th class="col-name">NAMA WARGA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($r = 0; $r < $total_rows; $r++): ?>
                                <tr>
                                    <td class="col-no"><?= $r + 1 ?></td>
                                    <td class="col-name">
                                        <?php if (isset($warga_hari[$r])): ?>
                                            <?= $warga_hari[$r]->nama ?>
                                        <?php else: ?>
                                            <!-- Baris kosong default untuk pelengkap 8 baris -->
                                            &nbsp;
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>

            <!-- Slot ke-8: Tata Tertib / Catatan Keamanan (Penyempurna Grid 4 Kolom) -->
            <div class="rules-card">
                <div>
                    <div class="rules-title">TATA TERTIB RONDA</div>
                    <ul class="rules-list">
                        <li>Wajib hadir di Pos Kamling mulai pukul 22.00 WIB.</li>
                        <li>Melakukan patroli keliling lingkungan minimal 2 kali.</li>
                        <li>Mengisi buku mutasi / daftar hadir ronda.</li>
                        <li>Tamu harap lapor 1x24 jam kepada pengurus RT.</li>
                        <li>Jika ada kejadian darurat/mencurigakan segera hubungi Ketua RT atau pihak berwajib.</li>
                    </ul>
                </div>
                <div style="text-align: center; font-size: 10px; color: #a0aec0; margin-top: 8px; border-top: 1px solid #edf2f7; padding-top: 4px;">
                    Mari Jaga Kerukunan & Keamanan Lingkungan Bersama
                </div>
            </div>

        </div>

        <div class="board-footer">
            <div>Dicetak pada: <?= date('d/m/Y') ?></div>
            <div>Ketua RT 004 / RW 003</div>
        </div>

    </div>

</body>
</html>
