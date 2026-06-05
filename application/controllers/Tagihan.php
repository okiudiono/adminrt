<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan extends CI_Controller
{
	private $google_script_url = ''; // PASTE URL GOOGLE APPS SCRIPT ANDA DI SINI

	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		
		// Anda bisa mengisi URL ini setelah melakukan deployment di Google Apps Script
		$this->google_script_url = 'https://script.google.com/macros/s/AKfycbwmS8GoFYZJCp4gbaNV4ZU7hOl8o1Z2ORG4aGvyKcOqLyAzmA0XBr2raJLx0bWBOcOk/exec'; 
	}

	public function index()
	{
		$data['warga'] = $this->db->get('warga')->result();
		$data['warga'] = $this->db
			->where('aktif', true)
			->order_by('id', 'ASC')
			->get('warga')
			->result();
		$data['iuran'] = $this->db
			->where('aktif', true)
			->order_by('ur', 'ASC')
			->get('iuran')
			->result();

		$this->load->view('tagihan/tagihan_form', $data);
	}

	public function simpan()
	{
		$total = array_sum($this->input->post('nominal'));

		$this->db->insert('tagihan', [
			'warga_id' => $this->input->post('warga_id'),
			'bulan'    => $this->input->post('bulan'),
			'tahun'    => $this->input->post('tahun'),
			'tanggal'  => date('Y-m-d'),
			'waktu'    => $this->input->post('waktu'),
			'tempat'   => $this->input->post('tempat'),
			'total'    => $total,
			'keterangan' => $this->input->post('keterangan')
		]);


		$tagihan_id = $this->db->insert_id();

		foreach ($this->input->post('nominal') as $iuran_id => $nominal) {
			// if ($nominal > 0) {
			$this->db->insert('tagihan_detail', [
				'tagihan_id' => $tagihan_id,
				'iuran_id'   => $iuran_id,
				'nominal'    => $nominal
			]);
			// }
		}

		redirect('tagihan/list');
	}

	public function copy_tagihan_bulan_lalu($tagihan_id_lama)
	{
		// Ambil tagihan lama
		$tagihan_lama = $this->db
			->where('id', $tagihan_id_lama)
			->get('tagihan')
			->row();

		if (!$tagihan_lama) {
			echo json_encode([
				'status' => 'error',
				'msg'    => 'Tagihan lama tidak ditemukan'
			]);
			return;
		}

		// Hitung bulan & tahun baru
		$bulan_baru = $tagihan_lama->bulan + 1;
		$tahun_baru = $tagihan_lama->tahun;

		if ($bulan_baru > 12) {
			$bulan_baru = 1;
			$tahun_baru++;
		}

		// ❗ CEK DUPLIKAT
		$cek = $this->db->where([
			'warga_id' => $tagihan_lama->warga_id,
			'bulan'    => $bulan_baru,
			'tahun'    => $tahun_baru
		])->get('tagihan')->num_rows();

		if ($cek > 0) {
			echo json_encode([
				'status' => 'exists',
				'msg'    => 'Tagihan bulan ini sudah pernah dicopy'
			]);
			return;
		}

		// Ambil detail lama
		$detail_lama = $this->db
			->where('tagihan_id', $tagihan_id_lama)
			->get('tagihan_detail')
			->result();

		// Hitung total
		$total = 0;
		foreach ($detail_lama as $d) {
			$total += $d->nominal;
		}

		// TRANSACTION
		$this->db->trans_start();

		// Insert tagihan baru
		$this->db->insert('tagihan', [
			'warga_id' => $tagihan_lama->warga_id,
			'bulan'    => $bulan_baru,
			'tahun'    => $tahun_baru,
			'tanggal'  => date('Y-m-d'),
			'waktu'    => $tagihan_lama->waktu,
			'tempat'   => $tagihan_lama->tempat,
			'total'    => $total,
			'keterangan' => $tagihan_lama->keterangan
		]);

		$tagihan_id_baru = $this->db->insert_id();

		// Insert detail
		foreach ($detail_lama as $d) {
			$this->db->insert('tagihan_detail', [
				'tagihan_id' => $tagihan_id_baru,
				'iuran_id'   => $d->iuran_id,
				'nominal'    => $d->nominal
			]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'msg'    => 'Gagal copy tagihan'
			]);
			return;
		}

		echo json_encode([
			'status' => 'success',
			'msg'    => 'Tagihan bulan ini berhasil dicopy'
		]);
	}

	public function copy_semua()
	{
		$bulan_asal = $this->input->post('bulan');
		$tahun_asal = $this->input->post('tahun');

		if (!$bulan_asal || !$tahun_asal) {
			echo json_encode(['status' => 'error', 'msg' => 'Pilih bulan dan tahun asal terlebih dahulu']);
			return;
		}

		// Hitung bulan & tahun target (+1)
		$bulan_target = $bulan_asal + 1;
		$tahun_target = $tahun_asal;
		if ($bulan_target > 12) {
			$bulan_target = 1;
			$tahun_target++;
		}

		// Ambil semua tagihan di bulan asal
		$tagihan_asal = $this->db
			->where(['bulan' => $bulan_asal, 'tahun' => $tahun_asal])
			->get('tagihan')
			->result();

		if (count($tagihan_asal) == 0) {
			echo json_encode(['status' => 'error', 'msg' => 'Tidak ada data tagihan untuk bulan ' . $bulan_asal . '/' . $tahun_asal]);
			return;
		}

		$count = 0;
		$this->db->trans_start();

		foreach ($tagihan_asal as $t_lama) {
			// Cek apakah warga ini sudah punya tagihan di bulan target
			$cek = $this->db->where([
				'warga_id' => $t_lama->warga_id,
				'bulan'    => $bulan_target,
				'tahun'    => $tahun_target
			])->get('tagihan')->num_rows();

			if ($cek == 0) {
				// Ambil detail lama
				$detail_lama = $this->db
					->where('tagihan_id', $t_lama->id)
					->get('tagihan_detail')
					->result();

				// Insert header baru
				$this->db->insert('tagihan', [
					'warga_id' => $t_lama->warga_id,
					'bulan'    => $bulan_target,
					'tahun'    => $tahun_target,
					'tanggal'  => date('Y-m-d'),
					'waktu'    => $t_lama->waktu,
					'tempat'   => $t_lama->tempat,
					'total'    => $t_lama->total,
					'keterangan' => $t_lama->keterangan
				]);

				$id_baru = $this->db->insert_id();

				// Insert detail baru
				foreach ($detail_lama as $d) {
					$this->db->insert('tagihan_detail', [
						'tagihan_id' => $id_baru,
						'iuran_id'   => $d->iuran_id,
						'nominal'    => $d->nominal
					]);
				}
				$count++;
			}
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo json_encode(['status' => 'error', 'msg' => 'Gagal menyalin data']);
		} else {
			echo json_encode([
				'status' => 'success',
				'msg'    => "Berhasil menyalin $count data tagihan ke bulan $bulan_target/$tahun_target"
			]);
		}
	}



	public function cetak($id)
	{
		$data['tagihan'] = $this->db
			->where('id', $id)
			->get('tagihan')->row();

		$data['detail'] = $this->db
			->join('iuran', 'iuran.id = tagihan_detail.iuran_id')
			->where('tagihan_id', $id)
			->get('tagihan_detail')->result();

		$this->load->view('tagihan/tagihan_cetak', $data);
	}

	public function list()
	{
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');

		if ($bulan) {
			$this->db->where('bulan', $bulan);
		}
		if ($tahun) {
			$this->db->where('tahun', $tahun);
		}

		$data['tagihan'] = $this->db
			->select('tagihan.*, warga.nama')
			->join('warga', 'warga.id = tagihan.warga_id')
			->order_by('tagihan.id', 'DESC')
			->get('tagihan')->result();

		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		$this->load->view('tagihan/tagihan_list', $data);
	}

	public function cetak_semua($bulan = null, $tahun = null)
	{
		$bulan_pilih = $bulan ?? date('n');
		$tahun_pilih = $tahun ?? date('Y');
		$data['tagihan'] = $this->db
			->select('tagihan.*, warga.nama, warga.jk, warga.status')
			->join('warga', 'warga.id = tagihan.warga_id')
			->where('tagihan.bulan', $bulan_pilih)
			->where('tagihan.tahun', $tahun_pilih)
			->order_by('tahun DESC, bulan DESC, warga.id ASC')
			->get('tagihan')
			->result();

		if (count($data['tagihan']) == 0) {
			show_error('Data tagihan masih kosong');
		}
		$data['google_script_url'] = $this->google_script_url;
		$this->load->view('tagihan/tagihan_cetak_4', $data);
	}

	public function hapus()
	{
		$id = $this->input->post('id');

		if ($id) {
			$this->db->where('id', $id)->delete('tagihan');
			$this->db->where('tagihan_id', $id)->delete('tagihan_detail');
		}

		redirect('tagihan/list');
	}
	public function edit($id)
	{
		$data['tagihan'] = $this->db
			->where('id', $id)
			->get('tagihan')
			->row();

		$data['detail'] = $this->db
			->where('tagihan_id', $id)
			->get('tagihan_detail')
			->result();

		$data['warga'] = $this->db->get('warga')->result();
		$data['iuran'] = $this->db->where('aktif', true)
			->order_by('ur', 'ASC')
			->get('iuran')
			->result();

		$this->load->view('tagihan/tagihan_edit', $data);
	}
	public function update()
	{
		$id = $this->input->post('id');

		$data = [
			'warga_id' => $this->input->post('warga_id'),
			'bulan'    => $this->input->post('bulan'),
			'tahun'    => $this->input->post('tahun'),
			'waktu'    => $this->input->post('waktu'),
			'tempat'   => $this->input->post('tempat'),
			'total'    => $this->input->post('total'),
			'keterangan' => $this->input->post('keterangan')
		];

		$this->db->where('id', $id)->update('tagihan', $data);

		// hapus detail lama
		$this->db->where('tagihan_id', $id)->delete('tagihan_detail');

		// simpan ulang detail
		foreach ($this->input->post('nominal') as $iuran_id => $nominal) {
			if ($nominal > 0) {
				$this->db->insert('tagihan_detail', [
					'tagihan_id' => $id,
					'iuran_id'   => $iuran_id,
					'nominal'    => $nominal
				]);
			}
		}

		redirect('tagihan/list');
	}
	public function buku()
	{
		$bulan = $this->input->get('bulan') ?? date('n');
		$tahun = $this->input->get('tahun') ?? date('Y');

		// Fetch all active residents
		$data['warga'] = $this->db
			->where('aktif', true)
			->order_by('id', 'ASC')
			->get('warga')
			->result();

		// Fetch all active iuran categories excluding Angsuran (12) and Kerjabakti (13)
		$data['iuran'] = $this->db
			->where('aktif', true)
			->where_not_in('id', [12, 13])
			->order_by('ur', 'ASC')
			->get('iuran')
			->result();

		// Fetch tagihan for the given month/year
		$tagihan = $this->db
			->select('tagihan.*, tagihan_detail.iuran_id, tagihan_detail.nominal')
			->join('tagihan_detail', 'tagihan_detail.tagihan_id = tagihan.id', 'left')
			->where('tagihan.bulan', $bulan)
			->where('tagihan.tahun', $tahun)
			->get('tagihan')
			->result();

		// Matrix of data: [warga_id][iuran_id] = nominal
		$matrix = [];
		foreach ($tagihan as $t) {
			$matrix[$t->warga_id][$t->iuran_id] = $t->nominal;
			$matrix[$t->warga_id]['total'] = $t->total;
			$matrix[$t->warga_id]['keterangan'] = $t->keterangan;
		}

		$data['matrix'] = $matrix;
		$data['bulan_pilih'] = $bulan;
		$data['tahun_pilih'] = $tahun; 

		$this->load->view('tagihan/buku', $data);
	}
	public function buku_stack()
	{
		$tahun = 2026;
		$bulan_awal = 4;
		$bulan_akhir = 12;

		$data['warga'] = $this->db
			->where('aktif', true)
			->order_by('id', 'ASC')
			->get('warga')
			->result();

		$data['iuran'] = $this->db
			->where('aktif', true)
			->where_not_in('id', [12, 13])
			->order_by('ur', 'ASC')
			->get('iuran')
			->result();

		$stack = [];
		for ($m = $bulan_awal; $m <= $bulan_akhir; $m++) {
			$tagihan = $this->db
				->select('tagihan.*, tagihan_detail.iuran_id, tagihan_detail.nominal')
				->join('tagihan_detail', 'tagihan_detail.tagihan_id = tagihan.id', 'left')
				->where('tagihan.bulan', $m)
				->where('tagihan.tahun', $tahun)
				->get('tagihan')
				->result();

			$matrix = [];
			foreach ($tagihan as $t) {
				$matrix[$t->warga_id][$t->iuran_id] = $t->nominal;
				$matrix[$t->warga_id]['total'] = $t->total;
				$matrix[$t->warga_id]['keterangan'] = $t->keterangan;
			}

			$stack[$m] = [
				'bulan' => $m,
				'tahun' => $tahun,
				'matrix' => $matrix,
				'tempat' => isset($tagihan[0]) ? $tagihan[0]->tempat : ''
			];
		}

		$data['stack'] = $stack;
		$data['bulan_list'] = [
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
			'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

		$this->load->view('tagihan/buku_stack', $data);
	}
	public function jimpitan()
	{
		$bulan = $this->input->get('bulan') ?? date('n');
		$tahun = $this->input->get('tahun') ?? date('Y');

		// Fetch residents where jk is 'L' or 'P' (excluding ruko)
		$data['warga'] = $this->db
			->where('aktif', true)
			->where_in('jk', ['L', 'P'])
			->order_by('nama', 'ASC')
			->get('warga')
			->result();

		// Generate dates from the 9th of the selected month to the 9th of the next month
		$start_date = new DateTime("$tahun-$bulan-09");
		$end_date = clone $start_date;
		$end_date->modify('+1 month');

		$dates = [];
		$current = clone $start_date;
		while ($current <= $end_date) {
			$dates[] = [
				'day' => (int)$current->format('d'),
				'full' => $current->format('Y-m-d'),
				'month' => (int)$current->format('n')
			];
			$current->modify('+1 day');
		}

		$data['dates'] = $dates;
		$data['bulan_pilih'] = $bulan;
		$data['tahun_pilih'] = $tahun;
		$data['bulan_list'] = [
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
			'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

		$this->load->view('tagihan/jimpitan', $data);
	}
	public function jimpitan_recap()
	{
		$tahun = $this->input->get('tahun') ?? date('Y');

		$data['warga'] = $this->db
			->where('aktif', true)
			->order_by('nama', 'ASC')
			->get('warga')
			->result();

		$data['bulan_list'] = [
			1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
			'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
		];

		// Fetch all jimpitan (Iuran ID 6) for the year
		$tagihan = $this->db
			->select('tagihan.warga_id, tagihan.bulan, tagihan_detail.nominal')
			->join('tagihan_detail', 'tagihan_detail.tagihan_id = tagihan.id')
			->where('tagihan.tahun', $tahun)
			->where('tagihan_detail.iuran_id', 6)
			->get('tagihan')
			->result();

		$matrix = [];
		foreach ($tagihan as $t) {
			$matrix[$t->warga_id][$t->bulan] = $t->nominal;
		}

		$data['matrix'] = $matrix;
		$data['tahun_pilih'] = $tahun;

		$this->load->view('tagihan/jimpitan_recap', $data);
	}
	public function kas()
	{
		$data['kategori'] = [
			'Kematian', 'Denda Ronda', 'Punya Gwe', 'Dana Sehat', 
			'Kas Umum', 'Kas Suran', 'Kas Swadaya', 'Pembangunan', 'TPQ'
		];
		$this->load->view('tagihan/kas', $data);
	}

	public function ronda()
	{
		// Ambil semua warga aktif, urutkan berdasarkan nama
		$warga_aktif = $this->db
			->where('aktif', true)
			->order_by('nama', 'ASC')
			->get('warga')
			->result();

		// Kelompokkan berdasarkan jadwal_ronda (1 - 7)
		$jadwal = [];
		for ($h = 1; $h <= 7; $h++) {
			$jadwal[$h] = [];
		}

		foreach ($warga_aktif as $w) {
			$hari = (int)$w->jadwal_ronda;
			if ($hari >= 1 && $hari <= 7) {
				$jadwal[$hari][] = $w;
			}
		}

		$data['jadwal'] = $jadwal;
		$data['hari_list'] = [
			1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'
		];

		$this->load->view('tagihan/ronda', $data);
	}

	public function ronda_harian($hari = null)
	{
		$hari_list = [
			1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'
		];

		if ($hari !== null) {
			$hari = (int)$hari;
			$target_hari = [$hari => $hari_list[$hari]];
		} else {
			$target_hari = $hari_list;
		}

		$jadwal_cetak = [];
		foreach ($target_hari as $id => $nama) {
			$jadwal_cetak[$id] = [
				'nama' => $nama,
				'warga' => $this->db
					->where('aktif', true)
					->where('jadwal_ronda', $id)
					->order_by('nama', 'ASC')
					->get('warga')
					->result()
			];
		}

		$data['jadwal_cetak'] = $jadwal_cetak;
		$this->load->view('tagihan/ronda_harian', $data);
	}

	public function ronda_absen()
	{
		// Ambil semua warga aktif, urutkan berdasarkan nama
		$warga_aktif = $this->db
			->where('aktif', true)
			->order_by('nama', 'ASC')
			->get('warga')
			->result();

		// Kelompokkan berdasarkan jadwal_ronda (1 - 7)
		$jadwal = [];
		for ($h = 1; $h <= 7; $h++) {
			$jadwal[$h] = [];
		}

		foreach ($warga_aktif as $w) {
			$hari = (int)$w->jadwal_ronda;
			if ($hari >= 1 && $hari <= 7) {
				$jadwal[$hari][] = $w;
			}
		}

		$data['jadwal'] = $jadwal;
		$data['hari_list'] = [
			1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'
		];

		$this->load->view('tagihan/ronda_absen', $data);
	}

	public function ronda_qr()
	{
		$this->load->view('tagihan/ronda_qr');
	}

	public function ronda_scan()
	{
		// Deteksi hari ini (1=Senin, ..., 7=Minggu)
		$hari_ini = date('N'); 
		$hari_nama = [
			1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'
		][$hari_ini];

		// Ambil warga yang jadwalnya hari ini
		$petugas_hari_ini = $this->db
			->where('aktif', true)
			->where('jadwal_ronda', $hari_ini)
			->order_by('nama', 'ASC')
			->get('warga')
			->result();

		$data['petugas'] = $petugas_hari_ini;
		$data['hari_nama'] = $hari_nama;
		$data['tanggal_ini'] = date('d-m-Y');

		$this->load->view('tagihan/ronda_scan', $data);
	}
}
