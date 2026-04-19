<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit Tagihan Warga</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            background: #f5f5f5;
        }

        .container {
            width: 700px;
            margin: 20px auto;
            background: #fff;
            padding: 15px;
            border: 1px solid #ccc;
        }

        h3 {
            margin-top: 0;
            text-align: center;
        }

        fieldset {
            border: 1px solid #aaa;
            margin-bottom: 15px;
            padding: 10px;
        }

        legend {
            font-weight: bold;
            padding: 0 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px;
            vertical-align: middle;
        }

        input,
        select {
            width: 100%;
            padding: 5px;
            font-size: 13px;
        }

        .right {
            text-align: right;
        }

        button {
            padding: 7px 14px;
            font-size: 13px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Edit Tagihan Arisan</h3>

        <form method="post" action="<?= site_url('tagihan/update') ?>">

            <input type="hidden" name="id" value="<?= $tagihan->id ?>">

            <!-- DATA WARGA -->
            <fieldset>
                <legend>Data Warga</legend>

                <table>
                    <tr>
                        <td width="30%">Nama Warga</td>
                        <td width="5%">:</td>
                        <td>
                            <select name="warga_id" required>
                                <?php foreach ($warga as $w): ?>
                                    <option value="<?= $w->id ?>"
                                        <?= ($w->id == $tagihan->warga_id) ? 'selected' : '' ?>>
                                        <?= $w->nama ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Bulan</td>
                        <td>:</td>
                        <td>
                            <input type="number" name="bulan"
                                value="<?= $tagihan->bulan ?>" min="1" max="12">
                        </td>
                    </tr>

                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td>
                            <input type="number" name="tahun"
                                value="<?= $tagihan->tahun ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="waktu"
                                value="<?= $tagihan->waktu ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Tempat</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="tempat"
                                value="<?= $tagihan->tempat ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="keterangan" value="<?= $tagihan->keterangan ?>">
                        </td>
                    </tr>
                </table>
            </fieldset>

            <!-- RINCIAN IURAN -->
            <fieldset>
                <legend>Rincian Iuran</legend>

                <table>
                    <?php
                    // mapping detail lama
                    $detail_map = [];
                    foreach ($detail as $d) {
                        $detail_map[$d->iuran_id] = $d->nominal;
                    }
                    ?>

                    <?php foreach ($iuran as $i): ?>
                        <tr>
                            <td width="60%"><?= $i->nama_iuran ?></td>
                            <td width="5%">Rp</td>
                            <td>
                                <input type="number"
                                    class="nominal"
                                    name="nominal[<?= $i->id ?>]"
                                    value="<?= $detail_map[$i->id] ?? 0 ?>"
                                    style="text-align:right;">
                            </td>
                        </tr>
                    <?php endforeach ?>

                    <!-- TOTAL -->
                    <tr style="border-top:1px solid #000; font-weight:bold;">
                        <td colspan="2" align="right">TOTAL</td>
                        <td>
                            <input type="number"
                                id="total"
                                name="total"
                                readonly
                                style="text-align:right; background:#eee;">
                        </td>
                    </tr>
                </table>
            </fieldset>

            <!-- TOMBOL -->
            <div class="right">
                <button type="submit">💾 Update</button>
                <a href="<?= site_url('tagihan') ?>">Kembali</a>
            </div>

        </form>
    </div>

    <script>
        function hitungTotal() {
            let total = 0;
            $('.nominal').each(function() {
                let val = parseInt($(this).val()) || 0;
                total += val;
            });
            $('#total').val(total);
        }

        $(document).ready(function() {
            hitungTotal();
            $('.nominal').on('input', hitungTotal);
        });
    </script>

</body>

</html>