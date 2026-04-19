<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekap Tahunan Jimpitan <?= $tahun_pilih ?></title>
    <style>
        @page {
            size: landscape;
            margin: 8mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h2 { 
            margin: 0; 
            font-size: 16px; 
            text-transform: uppercase; 
        }
        .header p { 
            margin: 4px 0; 
            font-size: 12px; 
            font-weight: bold;
        }
        .container-split {
            display: flex;
            gap: 5mm;
        }
        .column-split {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1.5pt solid #000;
        }
        th, td {
            border: 1pt solid #000;
            padding: 4px 2px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 9px;
        }
        .name-col {
            text-align: left;
            padding-left: 5px;
            white-space: nowrap;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nominal-col {
            width: 28px;
            font-size: 8px;
        }
        .total-col {
            width: 40px;
            font-weight: bold;
            background-color: #eee;
        }
        .no-print {
            margin: 10px;
            text-align: center;
        }
        .btn {
            padding: 8px 15px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            font-size: 12px;
        }
        tr:nth-child(even) td {
            background-color: #fcfcfc;
        }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
            tr:nth-child(even) td { background-color: #fcfcfc !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <div style="margin-bottom: 5px; font-weight: bold; color: #28a745;">
            REKAP TAHUNAN (12 BULAN DALAM 1 LEMBAR)
        </div>
        <a href="javascript:window.print()" class="btn">🖨️ Cetak Rekap Tahunan</a>
        <a href="<?= site_url('tagihan/list') ?>" class="btn" style="background:#6c757d;">Kembali</a>
    </div>

    <div class="header">
        <h2>REKAP JIMPITAN TAHUN <?= $tahun_pilih ?></h2>
        <p>RT 004 RW 003 DESA KARANGRAU</p>
    </div>

    <?php
    $total_warga = count($warga);
    $half = ceil($total_warga / 2);
    $warga_split = array_chunk($warga, $half);
    $global_no = 1;
    ?>

    <div class="container-split">
        <?php foreach ($warga_split as $chunk): ?>
            <div class="column-split">
                <table>
                    <thead>
                        <tr>
                            <th width="15">NO</th>
                            <th>NAMA</th>
                            <?php foreach ($bulan_list as $m_num => $m_name): ?>
                                <th class="nominal-col"><?= $m_name ?></th>
                            <?php endforeach; ?>
                            <th class="total-col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chunk as $w): 
                            $row_total = 0;    
                        ?>
                            <tr>
                                <td><?= $global_no++ ?></td>
                                <td class="name-col"><?= $w->nama ?></td>
                                <?php foreach ($bulan_list as $m_num => $m_name): 
                                    $val = $matrix[$w->id][$m_num] ?? 0;
                                    $row_total += $val;
                                ?>
                                    <td class="nominal-col">
                                        <?= $val > 0 ? number_format($val/1000, 1, ',', '.') : '-' ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="total-col">
                                    <?= $row_total > 0 ? number_format($row_total/1000, 1, ',', '.') : '-' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>

    <div style="margin-top: 10px; font-size: 8px; color: #666;">
        * Angka dalam ribuan (contoh: 15,0 = Rp 15.000)
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: flex-end; padding-right: 50px;">
        <div style="text-align: center;">
            <p>Bendahara RT,</p>
            <br><br><br>
            <p>( ................................. )</p>
        </div>
    </div>
</body>
</html>
