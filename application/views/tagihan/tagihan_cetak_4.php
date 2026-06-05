<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Tagihan 4 per Lembar</title>
    <style>
        /* =========================
           SETTING KERTAS LEGAL
           ========================= */
        @page {
            size: legal portrait;
            margin: 10mm 5mm; 
        }

        @media print {
            body {
                margin: 0;
                background: none;
            }

            .page {
                page-break-after: always;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* =========================
           1 HALAMAN (4 KOTAK)
           ========================= */
        .page {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 155mm 155mm;
            gap: 5mm;
            height: 315mm; 
            box-sizing: border-box;
            padding: 0;
            margin: 0 auto;
        }

        /* =========================
           1 KOTAK TAGIHAN
           ========================= */
        .kotak {
            border: 1.5px solid #444;
            padding: 8px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #fff;
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            max-height: 155mm;
        }

        /* Decorative watermark-like effect */
        .kotak::before {
            content: "RT 004";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(0, 0, 0, 0.03);
            z-index: 0;
            pointer-events: none;
            font-weight: bold;
        }

        .kotak-content {
            position: relative;
            z-index: 1;
            flex-grow: 1;
            overflow: hidden;
        }

        /* =========================
           HEADER
           ========================= */
        .header {
            text-align: center;
            font-weight: 800;
            font-size: 15px;
            text-transform: uppercase;
            border-bottom: 1.5px double #000;
            padding-bottom: 4px;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
            flex-shrink: 0;
        }

        /* =========================
           INFO
           ========================= */
        .info-qr-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 5px;
        }

        .info-table {
            flex: 1;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .info-table td {
            padding: 1px 0;
            vertical-align: top;
            font-size: 12px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            width: 35%;
        }

        /* =========================
           TABEL IURAN
           ========================= */
        .iuran-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .iuran-table th {
            background: #f4f4f4;
            text-align: left;
            padding: 3px 8px;
            border-bottom: 1.5px solid #000;
            font-weight: bold;
            font-size: 12px;
        }

        .iuran-table td {
            padding: 2px 8px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        .total-row td {
            border-top: 1.5px solid #000;
            border-bottom: 2px solid #000;
            font-weight: 800;
            font-size: 14px;
            padding: 4px 8px;
            background: #fafafa;
        }

        /* =========================
           TTD & QR
           ========================= */
        .footer-section {
            display: flex;
            justify-content: flex-end; /* TTD di kanan */
            align-items: flex-end;
            margin-top: 2px;
            flex-shrink: 0;
            border-top: 1px dashed #ccc;
            padding-top: 3px;
        }

        .qr-box {
            text-align: center;
            flex-shrink: 0;
        }

        .qr-box img {
            width: 125px;
            height: 125px;
            border: 1px solid #ddd;
            padding: 2px;
            background: #fff;
        }

        .ttd-box {
            text-align: center;
            font-size: 12px;
            width: 50%;
        }

        .ttd-space {
            height: 35px;
        }

        .ttd-name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>


</head>

<body onload="window.print()">

    <?php
    $no = 0;
    foreach ($tagihan as $t):

        if ($no % 4 == 0): ?>
            <div class="page">
            <?php endif; ?>

            <div class="kotak">
                <div class="kotak-content">
                    <div class="header">RUKUN TETANGGA 04 / RW 03<br>DESA KARANGRAU</div>

                    <?php
                    // Ambil detail di awal untuk keperluan QR Code & filter
                    $detail = $this->db
                        ->join('iuran', 'iuran.id = tagihan_detail.iuran_id')
                        ->where('tagihan_id', $t->id)
                        ->get('tagihan_detail')
                        ->result();

                    $d_ronda = 0;
                    foreach ($detail as $di) {
                        if (stripos($di->nama_iuran, 'D. Ronda') !== false) {
                            $d_ronda = $di->nominal;
                        }
                    }

                    $base_url = !empty($google_script_url) ? $google_script_url : base_url();
                    $qr_data = $base_url . "?" . http_build_query([
                        'id' => $t->warga_id,
                        'nama' => $t->nama,
                        'total' => $t->total,
                        'bulan' => $t->bulan,
                        'tahun' => $t->tahun,
                        'tanggal' => $t->tanggal,
                        'denda_ronda' => $d_ronda,
                        'status' => $t->status,
                        'jk' => $t->jk
                    ]);
                    $qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&margin=4&data=" . urlencode($qr_data);
                    ?>

                    <div class="info-qr-wrapper">
                        <!-- INFORMASI ATAS -->
                        <table class="info-table">
                            <tr>
                                <td class="info-label">NOMOR</td>
                                <td width="5%">:</td>
                                <td><?= str_pad($t->warga_id, 3, '0', STR_PAD_LEFT) ?></td>
                            </tr>
                            <tr>
                                <td class="info-label">NAMA</td>
                                <td>:</td>
                                <td><strong><?= ($t->jk == 'L' ? 'Bpk. ' : ($t->jk == 'P' ? 'Ibu ' : 'Ruko ')) ?><?= $t->nama ?></strong></td>
                            </tr>
                            <tr>
                                <td class="info-label">HARI / TGL</td>
                                <td>:</td>
                                <td><?= tanggal_indo($t->tanggal) ?></td>
                            </tr>
                            <tr>
                                <td class="info-label">WAKTU</td>
                                <td>:</td>
                                <td><?= $t->waktu ?></td>
                            </tr>
                            <tr>
                                <td class="info-label">TEMPAT</td>
                                <td>:</td>
                                <td><?= $t->tempat ?></td>
                            </tr>
                        </table>

                        <div class="qr-box">
                            <img src="<?= $qr_url ?>" alt="QR" onerror="this.src='https://dummyimage.com/100x100/ffffff/000000.png&text=QR+Err'">
                            <div style="font-size: 7px; margin-top: 1px; color: #888;">Scan Verification</div>
                        </div>
                    </div>

                    <!-- DETAIL IURAN -->
                    <table class="iuran-table">
                        <thead>
                            <tr>
                                <th>JENIS IURAN</th>
                                <th style="text-align: right;">NOMINAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                                <?php if ($d->nominal <= 0) continue; // Hemat ruang, sembunyikan yang 0 ?>
                                <tr>
                                    <td><?= $d->nama_iuran ?></td>
                                    <td align="right">
                                        Rp <?= number_format($d->nominal, 0, ',', '.') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td>TOTAL TAGIHAN</td>
                                <td align="right">
                                    Rp <?= number_format($t->total, 0, ',', '.') ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="footer-section">
                    <div class="ttd-box">
                        Karangrau, <?= date('d M Y') ?><br>
                        Sekretaris RT 004,<br>
                        <div class="ttd-space"><br>ttd.</div>
                        <div class="ttd-name">..........................</div>
                    </div>
                </div>
            </div>

            <?php
            $no++;
            if ($no % 4 == 0): ?>
            </div>
    <?php endif;
        endforeach;
    ?>

</body>

</html>