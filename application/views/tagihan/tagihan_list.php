<!DOCTYPE html>
<html>

<head>
    <title>Data Tagihan Warga</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <h3>Data Tagihan Warga</h3>

    <form method="get">
        <select name="bulan">
            <option value="">- Semua Bulan -</option>
            <?php for ($b = 1; $b <= 12; $b++): ?>
                <option value="<?= $b ?>"
                    <?= ($bulan == $b) ? 'selected' : '' ?>>
                    <?= $b ?>
                </option>
            <?php endfor ?>
        </select>

        <select name="tahun">
            <option value="">- Semua Tahun -</option>
            <?php for ($t = date('Y'); $t >= 2023; $t--): ?>
                <option value="<?= $t ?>"
                    <?= ($tahun == $t) ? 'selected' : '' ?>>
                    <?= $t ?>
                </option>
            <?php endfor ?>
        </select>

        <button type="submit">Filter</button>
        <button type="button" id="btnCopySemua"
            style="margin-left:10px; padding:5px 10px; 
              background:#6610f2; color:#fff; 
              border:none; border-radius:4px; cursor:pointer;">
            🔁 Copy Semua ke Bulan Depan
        </button>
        <!-- TOMBOL INPUT -->
        <a href="<?= site_url('tagihan/') ?>"
            style="margin-left:10px; padding:5px 10px; 
              background:#28a745; color:#fff; 
              text-decoration:none; border-radius:4px;">
            + Input Tagihan
        </a>
        <a href="<?= site_url('tagihan/buku') . ($bulan ? '?bulan='.$bulan : '') . ($tahun ? ($bulan ? '&' : '?').'tahun='.$tahun : '') ?>"
            style="margin-left:10px; padding:5px 10px; 
              background:#17a2b8; color:#fff; 
              text-decoration:none; border-radius:4px;">
            📘 Buku Arisan
        </a>
        <a href="<?= site_url('tagihan/buku_stack') ?>"
            target="_blank"
            style="margin-left:10px; padding:5px 10px; 
              background:#6f42c1; color:#fff; 
              text-decoration:none; border-radius:4px;">
            📚 Cetak 1 Tahun (Apr-Des)
        </a>
        <a href="<?= site_url('tagihan/kas') ?>"
            target="_blank"
            style="margin-left:10px; padding:5px 10px; 
              background:#17a2b8; color:#fff; 
              text-decoration:none; border-radius:4px;">
            💰 Buku Kas
        </a>
        <a href="<?= site_url('tagihan/jimpitan') ?>"
            target="_blank"
            style="margin-left:10px; padding:5px 10px; 
              background:#fd7e14; color:#fff; 
              text-decoration:none; border-radius:4px;">
            🏠 Buku Jimpitan
        </a>
        <a href="<?= site_url('tagihan/jimpitan_recap') ?>"
            target="_blank"
            style="margin-left:10px; padding:5px 10px; 
              background:#e83e8c; color:#fff; 
              text-decoration:none; border-radius:4px;">
            📊 Rekap Jimpitan
        </a>
        <?php if ($bulan && $tahun): ?>
            <a href="<?= site_url('tagihan/cetak_semua/' . $bulan . '/' . $tahun) ?>"
                target="_blank">
                Cetak 4 per Lembar
            </a>
        <?php endif ?>
    </form>

    <hr>
    <table id="tabelTagihan" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Warga</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($tagihan as $t): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $t->nama ?></td>
                    <td><?= $t->bulan ?></td>
                    <td><?= $t->tahun ?></td>
                    <td><?= number_format($t->total, 0, ',', '.') ?></td>

                    <td>
                        <a href="#"
                            class="btnCopyTagihan"
                            data-id="<?= $t->id ?>">
                            🔁 Copy Bulan Lalu
                        </a>


                        |
                        <a href="<?= site_url('tagihan/cetak/' . $t->id) ?>"
                            target="_blank">
                            Cetak
                        </a>

                        |

                        <!-- EDIT -->
                        <a href="<?= site_url('tagihan/edit/' . $t->id) ?>">
                            Edit
                        </a>

                        |

                        <form action="<?= site_url('tagihan/hapus') ?>"
                            method="post"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin hapus tagihan <?= $t->nama ?> ?')">

                            <input type="hidden" name="id" value="<?= $t->id ?>">

                            <button type="submit"
                                style="border:none; background:none; color:red; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabelTagihan').DataTable({
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        });

        $(document).on('click', '.btnCopyTagihan', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: "<?= site_url('tagihan/copy_tagihan_bulan_lalu') ?>/" + id,
                type: "GET",
                dataType: "json",
                success: function(res) {
                    alert(res.msg);
                    if (res.status === 'success') {
                        // location.reload();
                    }
                },
                error: function() {
                    alert('Server error');
                }
            });
        });

        $('#btnCopySemua').on('click', function() {
            let bulan = $('select[name="bulan"]').val();
            let tahun = $('select[name="tahun"]').val();

            if (!bulan || !tahun) {
                alert('Silakan pilih Bulan dan Tahun di filter terlebih dahulu sebagai sumber data yang akan disalin.');
                return;
            }

            if (confirm('Apakah Anda yakin ingin menyalin SEMUA tagihan dari bulan ' + bulan + '/' + tahun + ' ke bulan berikutnya?')) {
                $.ajax({
                    url: "<?= site_url('tagihan/copy_semua') ?>",
                    type: "POST",
                    data: {
                        bulan: bulan,
                        tahun: tahun
                    },
                    dataType: "json",
                    success: function(res) {
                        alert(res.msg);
                        if (res.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Server error saat menyalin data.');
                    }
                });
            }
        });
    </script>

</body>

</html>