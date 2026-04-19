<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Tagihan 4 per Lembar</title>
    <style>
        /* =========================
   SETTING KERTAS F4 / FOLIO
   ========================= */
        @page {
            size: 216mm 356mm;
            /* Legal Portrait */
            margin: 5mm;
        }

        @media print {
            body {
                margin: 0;
            }

            .page {
                page-break-after: always;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        /* =========================
   1 HALAMAN (4 KOTAK)
   ========================= */
        .page {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 8mm;

            /* tinggi bersih kertas: 356mm - (2 × 5mm margin) = 346mm */
            height: 346mm;
            box-sizing: border-box;
        }

        /* =========================
   1 KOTAK TAGIHAN
   ========================= */
        .kotak {
            border: 1px solid #000;
            padding: 6px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* =========================
   HEADER
   ========================= */
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .subheader {
            text-align: center;
            font-size: 14px;
            margin-bottom: 2px;
        }

        /* =========================
   INFO
   ========================= */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .info-table td {
            padding: 1px 2px;
            vertical-align: top;
            font-size: 14px;
        }

        /* =========================
   TABEL IURAN
   ========================= */
        .iuran-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 2px;
            font-size: 14px;
        }

        .iuran-table td {
            padding: 2px 4px;
        }

        .total {
            border-top: 1px solid #000;
            font-weight: bold;
        }

        /* =========================
   TTD
   ========================= */
        .ttd {
            text-align: center;
            margin-top: 2px;
            font-size: 14px;
        }

        .ttd img {
            width: 70px;
            margin: 4px 0;
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

                <div class="header">RUKUN TETANGGA <br>RT 004 RW 003 DESA KARANGRAU</div>

                <!-- INFORMASI ATAS -->
                <table class="info-table">
                    <tr>
                        <td width="35%">NOMOR</td>
                        <td width="5%">:</td>
                        <td><?= str_pad($t->warga_id, 3, '0', STR_PAD_LEFT) ?></td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td> <?= ($t->jk == 'L' ? 'Bpk. ' : ($t->jk == 'P' ? 'Ibu ' : 'Ruko ')) ?><?= $t->nama ?></td>
                    </tr>
                    <tr>
                        <td>HARI / TANGGAL</td>
                        <td>:</td>
                        <td>
                            <?= tanggal_indo($t->tanggal) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>WAKTU</td>
                        <td>:</td>
                        <td><?= $t->waktu ?></td>
                    </tr>
                    <tr>
                        <td>TEMPAT</td>
                        <td>:</td>
                        <td><?= $t->tempat ?></td>
                    </tr>
                </table>

                <!-- DETAIL IURAN -->
                <table class="iuran-table">
                    <?php
                    $detail = $this->db
                        ->join('iuran', 'iuran.id = tagihan_detail.iuran_id')
                        ->where('tagihan_id', $t->id)
                        ->get('tagihan_detail')
                        ->result();

                    foreach ($detail as $d):
                    ?>
                        <tr style="border: 1px solid #000;">
                            <td><?= $d->nama_iuran ?></td>
                            <td align="right">
                                <?= number_format($d->nominal, 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr class="total">
                        <td>Jumlah</td>
                        <td align="right">
                            <?= number_format($t->total, 0, ',', '.') ?>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>

                        <td align="center">

                            Sekretaris RT 004 RW 003<br><br>
                            ttd<br><br>
                        </td>
                    </tr>
                </table>

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