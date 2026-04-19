<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Buku Arisan Tahunan Apr-Des 2026</title>
    <style>
        @page {
            size: 356mm 216mm; /* Legal Landscape */
            margin: 15mm 5mm 5mm 40mm; /* Top, Right, Bottom, Left */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .page-container {
            padding: 0;
            page-break-after: always;
        }

        .page-container:last-child {
            page-break-after: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1.5pt solid #000;
        }

        th, td {
            border: 1.5pt solid #000;
            padding: 4px 2px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
        }

        .nama-col {
            text-align: left;
            padding-left: 10px;
        }

        .nominal-col {
            text-align: right;
            padding-right: 8px;
        }

        @media print {
            .no-print {
                display: none;
            }
            .page-container {
                padding: 0;
            }
            th {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
            }
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            border: 1px solid #ddd;
            background: #007bff;
            color: white;
            margin: 20px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="no-print">
        <a href="javascript:window.print()" class="btn">🖨️ Cetak Semua Halaman (Apr-Des)</a>
        <a href="<?= site_url('tagihan/list') ?>" class="btn" style="background:#6c757d;">Kembali</a>
    </div>

    <!-- COVER PAGE -->
    <div class="page-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 160mm; border: 4pt double #000; border-radius: 30px; box-sizing: border-box; width: 100%;">
        <h1 style="font-size: 48px; margin: 0;">BUKU ARISAN</h1>
        <h2 style="font-size: 32px; margin: 10px 0;">RT 004 RW 003</h2>
        <h3 style="font-size: 20px; margin: 0;">DESA KARANGRAU KECAMATAN SOKARAJA</h3>
        
        <div style="margin-top: 150px; font-size: 32px; font-weight: bold;">
            TAHUN 2026
        </div>
    </div>

    <?php 
    $matrix_april = $stack[4]['matrix'] ?? [];
    foreach ($stack as $s): 
        $m = $s['bulan'];
        $matrix = $s['matrix'];
        $is_april = ($m == 4);
    ?>
    <div class="page-container">
        <div style="text-align: center; margin-bottom: 10px;">
            <h2 style="margin:0;">Buku Arisan RT 004 RW 003</h2>
            <p style="margin:5px 0;">Desa Karangrau Kecamatan Sokaraja</p>
        </div>
        
        <div style="text-align: left; margin-bottom: 10px;">
            <div>Periode: <?= $bulan_list[$m] ?> 2026</div>
            <div>Tempat: <?= $s['tempat'] ?></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th width="120">Nama</th>
                    <?php foreach ($iuran as $i): ?>
                        <?php 
                        $w = '';
                        if (in_array($i->id, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])) $w = 'width="50"';
                        if ($i->id == 11) $w = 'width="80"';
                        ?>
                        <th <?= $w ?>><?= $i->nama_iuran ?></th>
                    <?php endforeach; ?>
                    <th width="60">Jumlah</th>
                    <th width="120">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                foreach ($warga as $w): 
                    $row_total = 0;
                    $row_values = [];
                    
                    foreach ($iuran as $i) {
                        $val = 0;
                        if ($is_april) {
                            $val = $matrix[$w->id][$i->id] ?? 0;
                        } else {
                            // Repeat columns 1, 2, 3, 4, 5, 7, 8, 9 from April
                            if (in_array($i->id, [1, 2, 3, 4, 5, 7, 8, 9])) {
                                $val = $matrix_april[$w->id][$i->id] ?? 0;
                            }
                        }
                        $row_values[$i->id] = $val;
                        $row_total += $val;
                    }

                    $ket = $is_april ? ($matrix[$w->id]['keterangan'] ?? '') : '';
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="nama-col"><?= $w->nama ?></td>
                        <?php foreach ($iuran as $i): 
                            $val = $row_values[$i->id] ?? 0;
                        ?>
                            <td class="nominal-col"><?= ($val > 0) ? number_format($val, 0, ',', '.') : '-' ?></td>
                        <?php endforeach; ?>
                        <td class="nominal-col" style="font-weight:bold;">
                            <?php 
                            // Jumlah hanya diisi untuk bulan April, selain itu kosong (tanpa strip)
                            if ($is_april && $row_total > 0) {
                                echo number_format($row_total, 0, ',', '.');
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                        <td style="text-align: left; padding-left: 10px;"><?= ($no-1) ?>. <?= $ket ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php while ($no <= 60): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="nama-col"></td>
                        <?php foreach ($iuran as $i): ?>
                            <td></td>
                        <?php endforeach; ?>
                        <td class="nominal-col"></td>
                        <td style="text-align: left; padding-left: 10px;"><?= ($no-1) ?>. </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>
</body>

</html>
