<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Buku Jimpitan RT 004 RW 003 (Compact)</title>
    <style>
        @page {
            size: landscape;
            margin: 5mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .header h2 { 
            margin: 0; 
            font-size: 13px; 
            text-transform: uppercase; 
        }
        .header p { 
            margin: 1px 0; 
            font-size: 10px; 
            font-weight: bold;
        }
        .container-split {
            display: flex;
            gap: 3mm;
            padding: 0 1mm;
        }
        .column-split {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1pt solid #000;
        }
        th, td {
            border: 0.5pt solid #000;
            padding: 2px 1px;
            text-align: center;
            height: 14px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 7px;
        }
        .name-col {
            text-align: left;
            padding-left: 3px;
            white-space: nowrap;
            font-weight: normal;
            max-width: 70px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .date-col {
            width: 12px;
            font-size: 7px;
        }
        .total-col {
            width: 25px;
            background-color: #fafafa;
            font-weight: bold;
        }
        /* Weekly divider: every 7 columns or specific day */
        .week-end {
            border-right: 1.5pt solid #000 !important;
        }
        /* Zebra striping for better eye tracking */
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        /* Thicker border every 5 rows */
        tr.row-gap td {
            border-bottom: 1pt solid #000;
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
        .footer-section {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0 20px;
            font-size: 9px;
        }
        .summary-box {
            border: 1pt solid #000;
            padding: 5px;
            width: 150px;
        }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
            table { font-size: 9px; }
            tr:nth-child(even) td { background-color: #f9f9f9 !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <div style="margin-bottom: 5px; font-weight: bold; color: #28a745;">
            FORMAT OPTIMAL (REKAP MUDAH + IRIT KERTAS)
        </div>
        <a href="javascript:window.print()" class="btn">🖨️ Cetak Buku Jimpitan</a>
        <a href="<?= site_url('tagihan/jimpitan_recap') ?>" class="btn" style="background:#e83e8c;">📊 Rekap Tahunan</a>
        <a href="<?= site_url('tagihan/list') ?>" class="btn" style="background:#6c757d;">Kembali</a>
    </div>

    <div class="header">
        <h2>BUKU JIMPITAN RT 004 RW 003</h2>
        <p>PERIODE: <?= $dates[0]['day'] . ' ' . strtoupper($bulan_list[$dates[0]['month']]) ?> - <?= end($dates)['day'] . ' ' . strtoupper($bulan_list[end($dates)['month']]) ?> <?= $tahun_pilih ?></p>
    </div>

    <?php
    $total_warga = count($warga);
    $half = ceil($total_warga / 2);
    $warga_split = array_chunk($warga, $half);
    $global_no = 1;
    ?>

    <div class="container-split">
        <?php foreach ($warga_split as $chunk_index => $warga_chunk): ?>
            <div class="column-split">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" width="15">NO</th>
                            <th rowspan="2">NAMA</th>
                            <th colspan="<?= count($dates) ?>">TANGGAL</th>
                            <th rowspan="2" class="total-col">TOTAL</th>
                        </tr>
                        <tr>
                            <?php 
                            $date_count = 0;
                            foreach ($dates as $d): 
                                $date_count++;
                                $is_week_end = ($date_count % 7 == 0);
                            ?>
                                <th class="date-col <?= $is_week_end ? 'week-end' : '' ?>"><?= $d['day'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $local_row = 0;
                        foreach ($warga_chunk as $w): 
                            $local_row++;
                            $row_class = ($local_row % 5 == 0) ? 'row-gap' : '';
                        ?>
                            <tr class="<?= $row_class ?>">
                                <td><?= $global_no++ ?></td>
                                <td class="name-col" title="<?= $w->nama ?>"><?= $w->nama ?></td>
                                <?php 
                                $date_count = 0;
                                foreach ($dates as $d): 
                                    $date_count++;
                                    $is_week_end = ($date_count % 7 == 0);
                                ?>
                                    <td class="<?= $is_week_end ? 'week-end' : '' ?>"></td>
                                <?php endforeach; ?>
                                <td class="total-col"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="footer-section">
        <div class="summary-box">
            <div style="font-weight:bold; border-bottom: 0.5pt solid #000; margin-bottom: 3px; text-align: center;">REKAP BULAN INI</div>
            <table style="border:none; font-size: 8px;">
                <tr><td style="border:none; text-align:left;">Total Hari Paid:</td><td style="border:none; text-align:right;">________</td></tr>
                <tr><td style="border:none; text-align:left;">Total Rupiah:</td><td style="border:none; text-align:right;">Rp ________</td></tr>
            </table>
        </div>
        <div style="text-align: center; width: 150px;">
            <p>Petugas Jimpitan,</p>
            <br><br>
            <p>( ................................. )</p>
        </div>
    </div>
</body>
</html>

