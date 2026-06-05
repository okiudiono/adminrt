<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tagihan Warga</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    
    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #7b2cbf;
            --success: #2ec4b6;
            --danger: #e63946;
            --warning: #f77f00;
            --info: #00b4d8;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --bg: #f4f7fe;
            --surface: #ffffff;
            --text-main: #2b2d42;
            --text-muted: #6c757d;
            --radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
            padding-bottom: 50px;
        }

        /* Navbar */
        .navbar {
            background: var(--surface);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Container */
        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Cards */
        .card {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Form Controls */
        .form-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        select, input {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }

        select:focus, input:focus {
            border-color: var(--primary);
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.1);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-success { background: var(--success); color: white; }
        .btn-secondary { background: var(--secondary); color: white; }
        .btn-info { background: var(--info); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-outline { background: transparent; border: 1.5px solid #e0e0e0; color: var(--text-muted); }
        .btn-outline:hover { background: #f0f0f0; border-color: #ccc; color: var(--text-main); }

        /* Tables */
        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
            border: none !important;
            width: 100% !important;
            margin-top: 10px !important;
        }

        table.dataTable thead th {
            border: none !important;
            background: #f8f9fa !important;
            color: var(--text-muted) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
            letter-spacing: 0.5px !important;
            padding: 12px 15px !important;
            border-radius: 8px !important;
        }

        table.dataTable tbody tr {
            background-color: var(--surface) !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01) !important;
            transition: transform 0.2s;
        }

        table.dataTable tbody td {
            border: none !important;
            padding: 12px 15px !important;
            font-size: 0.9rem !important;
            color: var(--text-main) !important;
        }

        table.dataTable tbody tr td:first-child { border-radius: 10px 0 0 10px !important; }
        table.dataTable tbody tr td:last-child { border-radius: 0 10px 10px 0 !important; }

        table.dataTable tbody tr:hover {
            background-color: #fafbff !important;
            transform: scale(1.002);
        }

        /* Action Links as Badges */
        .action-link {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 5px;
            display: inline-block;
            transition: all 0.2s;
        }

        .link-copy { background: #f3f0ff; color: var(--secondary); }
        .link-print { background: #e7f5ff; color: var(--info); }
        .link-edit { background: #f0fdf4; color: var(--success); }
        .link-delete { background: #fff5f5; color: var(--danger); border: none; cursor: pointer; }

        .action-link:hover {
            filter: brightness(0.95);
            transform: translateY(-1px);
        }

        /* DataTables Customizing */
        .dataTables_wrapper .dataTables_filter input {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-left: 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 5px 10px;
            border-radius: 6px;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 15px; text-align: center; }
            .form-inline { flex-direction: column; align-items: stretch; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <span style="font-size: 1.5rem;">🏘️</span> AdminRT Arisan
        </div>
        <div class="navbar-actions">
            <a href="<?= site_url('tagihan/') ?>" class="btn btn-success">
                <span>➕</span> Input Tagihan Baru
            </a>
        </div>
    </nav>

    <div class="container">
        
        <!-- Action Toolbar -->
        <div class="card">
            <div class="card-title"><span>📊</span> Filter & Laporan Cepat</div>
            <form method="get" class="form-inline">
                <select name="bulan">
                    <option value="">- Semua Bulan -</option>
                    <?php 
                    $bulan_names = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    for ($b = 1; $b <= 12; $b++): ?>
                        <option value="<?= $b ?>" <?= ($bulan == $b) ? 'selected' : '' ?>>
                            <?= $bulan_names[$b] ?>
                        </option>
                    <?php endfor ?>
                </select>

                <select name="tahun">
                    <option value="">- Semua Tahun -</option>
                    <?php for ($t = date('Y'); $t >= 2023; $t--): ?>
                        <option value="<?= $t ?>" <?= ($tahun == $t) ? 'selected' : '' ?>>
                            <?= $t ?>
                        </option>
                    <?php endfor ?>
                </select>

                <button type="submit" class="btn btn-primary">Cari Data</button>
                
                <div style="flex-grow: 1;"></div>

                <a href="<?= site_url('tagihan/buku') . ($bulan ? '?bulan='.$bulan : '') . ($tahun ? ($bulan ? '&' : '?').'tahun='.$tahun : '') ?>" class="btn btn-info">
                    📘 Buku Arisan
                </a>
                <a href="<?= site_url('tagihan/jimpitan') ?>" target="_blank" class="btn btn-warning">
                    🏠 Buku Jimpitan
                </a>
                <a href="<?= site_url('tagihan/kas') ?>" target="_blank" class="btn btn-outline">
                    💰 Buku Kas
                </a>
                <a href="<?= site_url('tagihan/ronda') ?>" target="_blank" class="btn btn-outline" style="border-color: var(--secondary); color: var(--secondary);">
                    📋 Jadwal Ronda
                </a>
                <a href="<?= site_url('tagihan/ronda_absen') ?>" target="_blank" class="btn btn-outline" style="border-color: var(--dark); color: var(--dark);">
                    📝 Absen Ronda
                </a>
                <a href="<?= site_url('tagihan/ronda_qr') ?>" target="_blank" class="btn btn-outline" style="border-color: var(--primary); color: var(--primary);">
                    🔲 QR Pos Ronda
                </a>
            </form>
            
            <hr>

            <div class="form-inline">
                <button type="button" id="btnCopySemua" class="btn btn-secondary">
                    🔁 Copy Semua ke Bulan Depan
                </button>
                <a href="<?= site_url('tagihan/buku_stack') ?>" target="_blank" class="btn btn-outline">
                    📚 Cetak Tahunan (Legal)
                </a>
                <a href="<?= site_url('tagihan/jimpitan_recap') ?>" target="_blank" class="btn btn-outline">
                    📈 Rekap Jimpitan
                </a>
                <?php if ($bulan && $tahun): ?>
                    <a href="<?= site_url('tagihan/cetak_semua/' . $bulan . '/' . $tahun) ?>" target="_blank" class="btn btn-outline" style="color: var(--primary);">
                        🖨️ Cetak 4 Transaksi/Lembar
                    </a>
                <?php endif ?>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="card">
            <div class="card-title"><span>📋</span> Daftar Tagihan Warga</div>
            <table id="tabelTagihan" class="display">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Warga</th>
                        <th width="80">Bulan</th>
                        <th width="80">Tahun</th>
                        <th width="120">Total Tagihan</th>
                        <th width="200" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tagihan as $t): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td style="font-weight: 500;"><?= $t->nama ?></td>
                            <td><?= $bulan_names[(int)$t->bulan] ?></td>
                            <td><?= $t->tahun ?></td>
                            <td style="font-weight: 600; color: var(--primary);">Rp <?= number_format($t->total, 0, ',', '.') ?></td>

                            <td style="text-align: center;">
                                <a href="#" class="action-link link-copy btnCopyTagihan" data-id="<?= $t->id ?>" title="Copy data resident ke bulan selanjutnya">
                                    🔁 Copy
                                </a>
                                <a href="<?= site_url('tagihan/cetak/' . $t->id) ?>" target="_blank" class="action-link link-print" title="Cetak kuitansi">
                                    🖨️ Cetak
                                </a>
                                <a href="<?= site_url('tagihan/edit/' . $t->id) ?>" class="action-link link-edit" title="Ubah data">
                                    ✏️ Edit
                                </a>
                                <form action="<?= site_url('tagihan/hapus') ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin hapus tagihan <?= $t->nama ?> ?')">
                                    <input type="hidden" name="id" value="<?= $t->id ?>">
                                    <button type="submit" class="action-link link-delete" title="Hapus data">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabelTagihan').DataTable({
                pageLength: 10,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari warga atau periode...",
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
            if(confirm('Salin tagihan warga ini ke bulan berikutnya?')) {
                $.ajax({
                    url: "<?= site_url('tagihan/copy_tagihan_bulan_lalu') ?>/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        alert(res.msg);
                        if (res.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Server error');
                    }
                });
            }
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