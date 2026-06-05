<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Absen & Mutasi Ronda (Auto-fill)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Outfit:wght@700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #000;
            --text-main: #000;
            --border-color: #000;
        }

        @page {
            size: legal portrait;
            margin: 10mm;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
            padding: 0;
            font-size: 11px; /* Smaller font for 2 days per page */
        }

        .no-print {
            background: #f8f9fa;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .btn {
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 13px;
            transition: all 0.2s;
        }

        .btn-print { background: #333; color: white; }
        .btn-back { background: #e2e8f0; color: #4a5568; }

        .container {
            width: 190mm;
            margin: 0 auto;
        }

        /* 2 Blocks per page logic */
        .day-block {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10mm;
            page-break-inside: avoid;
            height: 155mm; /* Roughly half of legal height minus margins */
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            border: 2px solid #000;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            margin: 0;
            text-transform: uppercase;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 12px;
        }

        .section-title {
            background: #eee;
            padding: 3px 8px;
            font-weight: 800;
            border: 1px solid #000;
            margin-top: 5px;
            text-transform: uppercase;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px 6px;
        }

        th {
            background: #fafafa;
            font-weight: 800;
            text-align: center;
            font-size: 10px;
        }

        .col-no { width: 25px; text-align: center; }
        .col-nama { width: 180px; font-weight: 600; }
        .col-ttd { width: 100px; text-align: center; }
        .col-jam { width: 60px; text-align: center; }

        .row-empty { height: 22px; }

        .signatures {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            padding-top: 10px;
        }

        .sig-box {
            text-align: center;
            width: 180px;
            font-size: 11px;
        }

        .sig-space {
            height: 40px;
        }

        .sig-name {
            font-weight: 800;
            text-decoration: underline;
        }

        @media print {
            .no-print { display: none; }
            .container { width: 100%; }
            .day-block { border-color: #000; }
            .section-title { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print">
        <div style="font-weight: 700;">🖨️ Pratinjau Absen Ronda (Otomatis & Hemat Kertas)</div>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" class="btn btn-print">Cetak Sekarang</button>
            <a href="<?= site_url('tagihan/ronda') ?>" class="btn btn-back">Kembali</a>
        </div>
    </div>

    <div class="container">
        <?php foreach ($hari_list as $h_id => $h_nama): ?>
            <?php 
                $warga_hari = $jadwal[$h_id] ?? [];
            ?>
            <div class="day-block">
                <div class="header">
                    <h1>LAPORAN MUTASI & KEJADIAN RONDA MALAM</h1>
                    <div style="font-size: 11px; font-weight: 600;">RT 004 / RW 003 DESA KARANGRAU</div>
                </div>

                <div class="info-row">
                    <div>Hari : <?= $h_nama ?></div>
                    <div>Tanggal : ..............................</div>
                </div>

                <div class="section-title">LAPORAN MUTASI / KEJADIAN LINGKUNGAN</div>
                <table>
                    <thead>
                        <tr>
                            <th class="col-jam">JAM</th>
                            <th>URAIAN KEJADIAN / KEADAAN LINGKUNGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=1; $i<=12; $i++): // 12 rows for mutation to fill the page layout ?>
                        <tr class="row-empty">
                            <td class="col-jam"></td>
                            <td></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>

                <div class="signatures">
                    <div class="sig-box">
                        Mengetahui,<br>
                        Ketua RT 004 RW 003<br>
                        <div class="sig-space"></div>
                        <div class="sig-name">.........................................</div>
                    </div>
                    <div class="sig-box">
                        <br>
                        Kepala Jaga<br>
                        <div class="sig-space"></div>
                        <div class="sig-name">.........................................</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
