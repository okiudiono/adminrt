<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Buku Arisan RT 004 RW 003</title>
    <style>
        @page {
            size: 356mm 216mm; /* Legal Landscape */
            margin: 15mm 5mm 5mm 40mm; /* Top, Right, Bottom, Left */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: left;
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
            color: #555;
            vertical-align: middle;
        }

        .nama-col {
            text-align: left;
            padding-left: 10px;
        }

        .nominal-col {
            text-align: right;
            padding-right: 8px;
        }

        .total-row {
            background-color: #f1f3f5;
            font-weight: bold;
        }

        .filter-panel {
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        @media print {
            .filter-panel, .btn-print {
                display: none;
            }
            .container {
                padding: 0;
            }
            table {
                box-shadow: none;
            }
            th {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
            }
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
            border: 1px solid #ddd;
            background: #fff;
        }

        .btn-print {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="filter-panel">
            <form method="get" action="<?= site_url('tagihan/buku') ?>">
                Bulan: 
                <select name="bulan">
                    <?php
                    $bulan_list = [
                        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    foreach ($bulan_list as $m => $name): ?>
                        <option value="<?= $m ?>" <?= ($m == $bulan_pilih) ? 'selected' : '' ?>><?= $name ?></option>
                    <?php endforeach; ?>
                </select>
                Tahun:
                <input type="number" name="tahun" value="<?= $tahun_pilih ?>" style="width: 70px;">
                <button type="submit" class="btn">Tampilkan</button>
                <button type="button" class="btn btn-print" onclick="window.print()">🖨️ Cetak</button>
                <a href="<?= site_url('tagihan/list') ?>" class="btn">Kembali</a>
            </form>
        </div>

        <div class="header" style="text-align: center;">
            <h2>Buku Arisan RT 004 RW 003</h2>
            <p>Desa Karangrau Kecamatan Sokaraja</p>
        </div>
        <div style="text-align: left; margin-bottom: 15px;">
            <div>Periode: <?= $bulan_list[(int)$bulan_pilih] ?> <?= $tahun_pilih ?></div>
            <div>Tempat: </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th rowspan="1" width="30">No</th>
                    <th rowspan="1" width="120">Nama</th>
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
                $grand_totals = [];
                foreach ($iuran as $i) $grand_totals[$i->id] = 0;
                $grand_total_all = 0;

                foreach ($warga as $w): 
                    $row_total = $matrix[$w->id]['total'] ?? 0;
                    $grand_total_all += $row_total;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="nama-col"><?= $w->nama ?></td>
                        <?php foreach ($iuran as $i): 
                            $val = $matrix[$w->id][$i->id] ?? 0;
                            $grand_totals[$i->id] += $val;
                        ?>
                            <td class="nominal-col"><?= ($val > 0) ? number_format($val, 0, ',', '.') : '-' ?></td>
                        <?php endforeach; ?>
                        <td class="nominal-col" style="font-weight:bold;">
                            <?= ($row_total > 0) ? number_format($row_total, 0, ',', '.') : '-' ?>
                        </td>
                        <td style="text-align: left; padding-left: 10px;"><?= ($no-1) ?>. <?= $matrix[$w->id]['keterangan'] ?? '' ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php while ($no <= 60): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="nama-col"></td>
                        <?php foreach ($iuran as $i): ?>
                            <td></td>
                        <?php endforeach; ?>
                        <td></td>
                        <td style="text-align: left; padding-left: 10px;"><?= ($no-1) ?>. </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
