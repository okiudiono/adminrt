<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Jadwal Ronda Harian (1 Lembar)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Outfit:wght@700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a365d;
            --text-main: #000;
            --border-color: #000;
        }

        @page {
            size: legal portrait;
            margin: 20mm 10mm 10mm 20mm; /* top, right, bottom, left - Mengikuti standar jimpitan */
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
            padding: 0;
            line-height: 1.1;
        }

        .no-print {
            background: #f8f9fa;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 13px;
        }

        .btn-print { background: var(--primary); color: white; }
        .btn-back { background: #e2e8f0; color: #4a5568; }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }

        .header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 10px;
            font-weight: 600;
        }

        /* 3 Columns Grid for Portrait to fit all days on one page with enough width */
        .days-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .day-block {
            border: 1px solid #000;
            border-radius: 4px;
            overflow: hidden;
            background: #fff;
        }

        .day-label {
            background: #f2f2f2;
            padding: 4px;
            text-align: center;
            font-size: 12px;
            font-weight: 800;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #fafafa;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            padding: 4px;
            font-size: 9px;
            font-weight: 800;
        }

        td {
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #000;
            padding: 4px;
            font-size: 10px;
            height: 20px;
            white-space: nowrap;
            overflow: hidden;
        }

        td:last-child, th:last-child { border-right: none; }

        .col-no { width: 20px; text-align: center; }

        .footer-note {
            margin-top: 10px;
            font-size: 10px;
            text-align: center;
            font-style: italic;
        }

        @media print {
            .no-print { display: none; }
            .day-block { border-width: 0.5pt; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print">
        <div style="font-weight: 700;">🖨️ Jadwal Ronda Harian (Format 1 Lembar)</div>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" class="btn btn-print">Cetak Sekarang</button>
            <a href="<?= site_url('tagihan/ronda') ?>" class="btn btn-back">Kembali</a>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <h1>JADWAL RONDA KEAMANAN</h1>
            <p>RT 004 / RW 003 DESA KARANGRAU - KECAMATAN SOKARAJA</p>
        </div>

        <div class="days-grid">
            <?php foreach ($jadwal_cetak as $item): ?>
            <div class="day-block">
                <div class="day-label"><?= $item['nama'] ?></div>
                <table>
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th>NAMA WARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $warga = $item['warga'];
                        $total_warga = count($warga);
                        $display_rows = max(10, $total_warga); 
                        for ($i = 0; $i < $display_rows; $i++): 
                        ?>
                        <tr>
                            <td class="col-no"><?= $i + 1 ?></td>
                            <td>
                                <?= isset($warga[$i]) ? $warga[$i]->nama : '' ?>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="footer-note">
            Dicetak pada: <?= date('d/m/Y H:i') ?> | Mari Jaga Keamanan Lingkungan Bersama
        </div>
    </div>

</body>
</html>
