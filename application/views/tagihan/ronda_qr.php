<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Stiker QR Pos Ronda RT 004 RW 003</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Outfit:wght@800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .no-print {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
        }

        .btn {
            padding: 10px 20px;
            background: #1a365d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .qr-card {
            background: white;
            width: 140mm;
            padding: 15mm;
            text-align: center;
            border: 5px solid #1a365d;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: relative;
        }

        .header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            color: #1a365d;
            margin: 0;
            letter-spacing: 1px;
        }

        .header p {
            font-size: 18px;
            color: #dd6b20;
            font-weight: 700;
            margin: 5px 0 20px 0;
        }

        .qr-container {
            background: #fff;
            padding: 20px;
            border: 2px dashed #cbd5e0;
            display: inline-block;
            margin: 20px 0;
            border-radius: 15px;
        }

        .qr-image {
            width: 250px;
            height: 250px;
        }

        .instructions {
            margin-top: 20px;
            padding: 15px;
            background: #ebf8ff;
            border-radius: 12px;
        }

        .instructions h2 {
            font-size: 16px;
            margin: 0 0 10px 0;
            color: #2b6cb0;
        }

        .instructions ol {
            text-align: left;
            margin: 0;
            padding-left: 20px;
            font-size: 14px;
            color: #2d3748;
            font-weight: 600;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #718096;
            font-weight: 600;
        }

        @media print {
            body { background: white; padding: 0; }
            .no-print { display: none; }
            .qr-card { 
                box-shadow: none; 
                border-width: 3px;
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <a href="javascript:window.print()" class="btn">🖨️ Cetak Stiker QR</a>
        <a href="<?= site_url('tagihan/ronda') ?>" class="btn" style="background: #718096; margin-left: 10px;">Kembali</a>
    </div>

    <div class="qr-card">
        <div class="header">
            <h1>ABSEN RONDA ONLINE</h1>
            <p>RT 004 / RW 003 DESA KARANGRAU</p>
        </div>

        <div class="qr-container">
            <?php 
                // QR langsung mengarah ke Google Script agar warga bisa absen secara online
                $scan_url = 'https://script.google.com/macros/s/AKfycbxgFCmW9693wKKNvAmlZAl54ev6rhR1ZhHNvC1zDYJvmVFcjDM-mS1h3-z5FTyqh8Q/exec';
                $qr_api = "https://quickchart.io/qr?text=" . urlencode($scan_url) . "&size=300&margin=1";
            ?>
            <img src="<?= $qr_api ?>" alt="QR Code Absen Ronda" class="qr-image" style="width: 250px; height: 250px;">
        </div>

        <div class="instructions">
            <h2>CARA ABSEN:</h2>
            <ol>
                <li>Buka Kamera HP atau Aplikasi QR Scanner.</li>
                <li>Arahkan ke gambar QR Code di atas.</li>
                <li>Klik link yang muncul (Pilih nama & Absen).</li>
                <li>Selesai! Data Anda langsung terkirim.</li>
            </ol>
        </div>

        <div class="footer">
            "Keamanan Lingkungan Adalah Tanggung Jawab Bersama"
        </div>
    </div>

</body>
</html>
