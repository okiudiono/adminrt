<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Tagihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        .kotak {
            border: 1px solid #000;
            padding: 15px;
            width: 400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 2px;
            font-size: 14px;
        }

        .iuran-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 5px;
            font-size: 14px;
        }

        .iuran-table td {
            padding: 4px;
            border: 1px solid #000;
        }

        .total {
            font-weight: bold;
            background: #eee;
        }

        .ttd {
            text-align: center;
            margin-top: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="kotak">
        <div class="header">RUKUN TETANGGA <br>RT 004 RW 003 DESA KARANGRAU</div>
        <hr>

        <table class="info-table">
            <tr>
                <td width="35%">NOMOR</td>
                <td width="5%">:</td>
                <td><?= str_pad($tagihan->warga_id, 3, '0', STR_PAD_LEFT) ?></td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td>:</td>
                <td><?= $tagihan->nama ?? 'Warga' ?></td>
            </tr>
            <tr>
                <td>TANGGAL</td>
                <td>:</td>
                <td><?= tanggal_indo($tagihan->tanggal) ?></td>
            </tr>
            <tr>
                <td>WAKTU</td>
                <td>:</td>
                <td><?= $tagihan->waktu ?></td>
            </tr>
            <tr>
                <td>TEMPAT</td>
                <td>:</td>
                <td><?= $tagihan->tempat ?></td>
            </tr>
        </table>

        <table class="iuran-table">
            <thead>
                <tr style="background:#eee;">
                    <th>Jenis Iuran</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $d): ?>
                    <tr>
                        <td><?= $d->nama_iuran ?></td>
                        <td align="right"><?= number_format($d->nominal, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total">
                    <td>JUMLAH TOTAL</td>
                    <td align="right"><?= number_format($tagihan->total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>

        <?php if ($tagihan->keterangan): ?>
            <div style="margin-top:10px; font-size:12px;">
                <i>Ket: <?= $tagihan->keterangan ?></i>
            </div>
        <?php endif; ?>

        <table width="100%" style="margin-top:20px;">
            <tr>
                <td align="center">
                    Sekretaris RT 004 RW 003<br><br><br>
                    ( ............................ )
                </td>
            </tr>
        </table>
    </div>

    <div class="ttd no-print">
        <button onclick="window.print()">Cetak Ulang</button>
        <button onclick="window.close()">Tutup</button>
    </div>

</body>

</html>
