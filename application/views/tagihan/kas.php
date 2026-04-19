<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Buku Kas RT 004 RW 003 (Irit Kertas)</title>
    <style>
        @page {
            size: 356mm 216mm; /* Legal Landscape */
            margin: 10mm 5mm 10mm 5mm; /* Balanced margins */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10px;
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
            padding: 5mm 10mm 5mm 30mm; /* 30mm left padding for binding on EACH half */
            box-sizing: border-box;
            border-right: 0.2pt dashed #ccc; /* Cut guide line */
        }
        .book-side:last-child {
            border-right: none;
        }
        
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 2px 0;
            font-size: 11px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1.2pt solid #000;
        }
        th, td {
            border: 1pt solid #000;
            padding: 4px 3px;
            text-align: center;
            height: 18px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }
        .right { text-align: right; padding-right: 5px; }

        .signature-section {
            margin-top: 15px;
            display: flex;
            justify-content: space-around;
        }
        .signature-box {
            text-align: center;
            width: 150px;
            font-size: 9px;
        }

        @media print {
            .no-print { display: none; }
            body { margin: 0; }
            .book-side { border: none; }
            th { background-color: #eee !important; -webkit-print-color-adjust: exact; }
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

    <!-- COVER PAGE (Double Copy or Single) -->
    <div class="page-container">
        <div class="book-side" style="justify-content: center; align-items: center; border: 2pt double #000; border-radius: 15px;">
            <h1 style="font-size: 32px; margin: 0;">BUKU KAS</h1>
            <h2 style="font-size: 20px; margin: 10px 0;">RT 004 RW 003</h2>
            <div style="margin-top: 40px; font-size: 20px; font-weight: bold; border-top: 1.5pt solid #000; padding: 5px 20px;">
                TAHUN 2026
            </div>
        </div>
        <div class="book-side" style="justify-content: center; align-items: center; border: 2pt double #000; border-radius: 15px;">
             <h1 style="font-size: 32px; margin: 0;">BUKU KAS</h1>
            <h2 style="font-size: 20px; margin: 10px 0;">RT 004 RW 003</h2>
            <div style="margin-top: 40px; font-size: 20px; font-weight: bold; border-top: 1.5pt solid #000; padding: 5px 20px;">
                TAHUN 2026
            </div>
        </div>
    </div>

    <?php foreach ($kategori as $kat): ?>
    <div class="page-container">
        <!-- MINGGU/SISI 1 -->
        <?php for ($side = 1; $side <= 2; $side++): ?>
        <div class="book-side">
            <div class="header">
                <h2>BUKU KAS <?= strtoupper($kat) ?></h2>
                <p>RT 004 RW 003 DESA KARANGRAU</p>
                <div style="margin-top:5px; font-size: 9px;">Bulan: ....................................... 2026</div>
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
                    <?php for($i=1; $i<=14; $i++): ?>
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
                    <p style="margin-bottom: 0;">Bendahara,</p>
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
