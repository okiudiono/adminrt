<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Input Tagihan Warga</title>

    <!-- jQuery -->
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
        <h3>Input Tagihan Arisan</h3>

        <form method="post" action="<?= site_url('tagihan/simpan') ?>">

            <!-- DATA WARGA -->
            <fieldset>
                <legend>Data Warga</legend>

                <table>
                    <tr>
                        <td width="30%">Nama Warga</td>
                        <td width="5%">:</td>
                        <td>
                            <select name="warga_id" required>
                                <option value="">- Pilih Warga -</option>
                                <?php foreach ($warga as $w): ?>
                                    <option value="<?= $w->id ?>"><?= $w->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Bulan</td>
                        <td>:</td>
                        <td>
                            <input type="number" name="bulan"
                                value="<?= date('m') ?>" min="1" max="12">
                        </td>
                    </tr>

                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td>
                            <input type="number" name="tahun"
                                value="<?= date('Y') ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="waktu"
                                value="19.30 WIB">
                        </td>
                    </tr>

                    <tr>
                        <td>Tempat</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="tempat"
                                value="Rumah Bpk. Aris Santoso">
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="keterangan" placeholder="Contoh: Bayar lunas">
                        </td>
                    </tr>
                </table>
            </fieldset>

            <!-- RINCIAN IURAN -->
            <fieldset>
                <legend>Rincian Iuran</legend>

                <table>
                    <?php foreach ($iuran as $i): ?>
                        <tr>
                            <td width="60%"><?= $i->nama_iuran ?></td>
                            <td width="5%">Rp</td>
                            <td>
                                <input type="number" class="nominal"
                                    name="nominal[<?= $i->id ?>]"
                                    value="<?= $i->default_nominal ?>"
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
                <button type="submit">💾 Simpan & Cetak</button>
                <a href="<?= site_url('tagihan/list') ?>">Kembali</a>
            </div>

        </form>
    </div>

</body>
<script>
    function hitungTotal() {
        let total = 0;
        $('.nominal').each(function() {
            let val = parseInt($(this).val()) || 0;
            total += val;
        });
        $('#total').val(total);
    }

    // hitung saat halaman dibuka
    $(document).ready(function() {
        hitungTotal();

        // hitung ulang saat input berubah
        $('.nominal').on('input', function() {
            hitungTotal();
        });
    });
</script>

</html>