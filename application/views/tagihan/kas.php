<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Buku Kas RT 004 RW 003 (Premium Edition)</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: 356mm 216mm; /* Legal Landscape */
            margin: 10mm 10mm 10mm 10mm; /* Symmetrical margins */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .no-print {
            background: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
            border: 1px solid #ddd;
            background: #007bff;
            color: white;
            margin: 0 5px;
            display: inline-block;
        }

        .page-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            page-break-after: always;
            box-sizing: border-box;
        }
        .page-container:last-child {
            page-break-after: auto;
        }

        .book-side {
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            border-right: 0.2pt dashed #ccc; /* Cut guide line */
            padding: 5mm 10mm;
        }
        
        /* Maksimalkan lebar dengan menggeser ke kiri sesuai permintaan */
        .book-side:first-child {
            padding-left: 22mm;  /* Geser aman ke kanan agar kolom No tidak terpotong fisik printer Legal */
            padding-right: 8mm;  /* Kurangi sisi kanan agar lebar tabel tetap maksimal */
        }
        
        .book-side:last-child {
            padding-left: 20mm;  /* Ruang untuk jilid/lipatan di tengah */
            padding-right: 8mm;  /* Seimbang dengan sisi paling kiri */
            border-right: none;
        }
        
        .header {
            text-align: center;
            margin-bottom: 12px;
        }
        .header h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 16px;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 2px 0;
            font-size: 13px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1.2pt solid #000;
        }
        th, td {
            border: 1pt solid #000;
            padding: 5px 4px;
            text-align: center;
            height: 24px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        .right { text-align: right; padding-right: 5px; }

        .signature-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }
        .signature-box {
            text-align: center;
            width: 150px;
            font-size: 11px;
        }

        /* PREMIUM COVER STYLES */
        .cover-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 20mm;
            box-sizing: border-box;
            border: 4pt double #000;
            border-radius: 20px;
            position: relative;
            background: #fff;
            overflow: hidden;
        }

        .cover-side::before {
            content: '';
            position: absolute;
            top: 10px; left: 10px; right: 10px; bottom: 10px;
            border: 1pt solid #000;
            border-radius: 15px;
            pointer-events: none;
        }

        .cover-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cover-title {
            font-family: 'Playfair Display', serif;
            font-size: 56px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #000;
            text-align: center;
        }

        .cover-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 22px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
        }

        .cover-info {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            margin-top: 10px;
            text-align: center;
            text-transform: uppercase;
        }

        .cover-year {
            margin-top: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 28px;
            font-weight: 700;
            border-top: 2pt solid #000;
            border-bottom: 2pt solid #000;
            padding: 10px 40px;
            letter-spacing: 5px;
        }

        .cover-footer {
            position: absolute;
            bottom: 40px;
            left: 30mm; /* Geser ke kanan mengimbangi lipatan/jilid punggung buku */
            right: 0;
            text-align: center;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
            text-transform: uppercase;
        }

        @media print {
            .no-print { display: none; }
            body { 
                margin: 0; 
                padding-left: 5mm; /* Minimal protection for printer margins */
                box-sizing: border-box;
            }
            .book-side { border-right: none; } /* Remove cut guide on print if desired, or keep it */
            th { background-color: #eee !important; -webkit-print-color-adjust: exact; }
            .cover-side { border-color: #000 !important; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <div style="margin-bottom: 5px; font-weight: bold; font-size: 14px; color: #28a745;">
            FORMAT HEMAT KERTAS (1 LEMBAR JADI 2 HALAMAN) - Kertas Legal
        </div>
        <a href="javascript:window.print()" class="btn">🖨️ Cetak Buku Kas</a>
        <a href="<?= site_url('tagihan/list') ?>" class="btn" style="background:#6c757d;">Kembali</a>
    </div>

    <?php foreach ($kategori as $kat): ?>
    <!-- COVER PAGE for <?= $kat ?> (Terhubung Depan & Belakang) -->
    <div class="page-container" style="display: flex; padding: 15mm 15mm; box-sizing: border-box; height: 100%; min-height: 190mm;">
        <div style="display: flex; width: 100%; border: 4pt double #000; border-radius: 20px; position: relative; background: #fff; box-sizing: border-box; overflow: hidden;">
            <!-- Bingkai dalam yang menyambung penuh dari depan ke belakang -->
            <div style="position: absolute; top: 8px; left: 8px; right: 8px; bottom: 8px; border: 1pt solid #000; border-radius: 12px; pointer-events: none;"></div>
            
            <!-- Sisi Kiri: Sampul Belakang (Back Cover) minimalis -->
            <div style="flex: 1; display: flex; justify-content: center; align-items: center; position: relative; z-index: 1;">
                <div style="font-family: 'Inter', sans-serif; font-size: 14px; letter-spacing: 4px; color: #aaa; text-transform: uppercase;">
                    CATATAN
                </div>
            </div>

            <!-- Sisi Kanan: Sampul Depan (Front Cover) -->
            <div style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20mm 5mm 20mm 35mm; box-sizing: border-box; position: relative; z-index: 1;">
                <h1 class="cover-title" style="font-size: 38px;">BUKU KAS</h1>
                <h1 class="cover-title" style="font-size: 42px; margin-top: 10px;"><?= strtoupper($kat) ?></h1>
                <div class="cover-subtitle">RT 004 RW 003</div>
                <div class="cover-info">DESA KARANGRAU • KECAMATAN SOKARAJA</div>
                <div class="cover-footer">KABUPATEN BANYUMAS</div>
            </div>
        </div>
    </div>

    <div class="page-container">
        <!-- MINGGU/SISI 1 -->
        <?php for ($side = 1; $side <= 2; $side++): ?>
        <div class="book-side">
            <div class="header">
                <h2>BUKU KAS <?= strtoupper($kat) ?></h2>
                <p>RT 004 RW 003 DESA KARANGRAU</p>
                <div style="margin-top:5px; font-size: 11px;">Bulan: ................</div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th width="60">Tanggal</th>
                        <th>Uraian</th>
                        <th width="60">Masuk</th>
                        <th width="60">Keluar</th>
                        <th width="70">Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<=10; $i++): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endfor; ?>
                    <tr style="background:#f9f9f9; font-weight:bold;">
                        <td colspan="3" class="right">TOTAL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="signature-section">
                <div class="signature-box">
                    <p style="margin-bottom: 0;">Ketua RT 004,</p>
                    <br><br><br>
                    <p>( ........................ )</p>
                </div>
                <div class="signature-box">
                    <p style="margin-bottom: 0;">Penanggung Jawab Kas,</p>
                    <br><br><br>
                    <p>( ........................ )</p>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <?php endforeach; ?>
</body>
</html>
