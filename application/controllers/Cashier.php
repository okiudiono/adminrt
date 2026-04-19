<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->database(); // Pastikan database dimuat
	}

	public function index()
	{
		$this->load->view('cashier_view');
	}

	public function scan_barcode()
	{
		$barcode = $this->input->post('barcode');
		$product = $this->Product_model->get_product_by_barcode($barcode);
		echo json_encode($product);
	}

	public function search_product()
	{
		// print_r($_POST);
		// die;
		$name = $_POST['query'] ?? '';
		$products = $this->Product_model->search_products($name);
		echo json_encode($products);
	}

	public function add_product()
	{
		$barcode = $this->input->post('barcode');
		$name = $this->input->post('name');
		$price = $this->input->post('price');

		if ($this->Product_model->add_product($barcode, $name, $price)) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}
	public function save_product()
	{
		$kode = $this->input->post('kbarcode');

		$barcode = ($kode == '' ? $this->input->post('name') : $kode);
		$name = $this->input->post('name');
		$price = $this->input->post('price');

		if (empty($name) || empty($price)) {
			echo json_encode(['success' => false, 'message' => 'Nama dan harga wajib diisi']);
			return;
		}

		$data = [
			'barcode' => $barcode,
			'name' => $name,
			'price' => $price
		];

		if ($this->db->insert('products', $data)) {
			echo json_encode([
				'success' => true,
				'id' => $this->db->insert_id()  // Mengembalikan ID produk baru
			]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal menyimpan produk']);
		}
	}

	public function save_transaction()
	{
		header('Content-Type: application/json');

		$data = json_decode(file_get_contents("php://input"), true);
		if (!$data || empty($data['items'])) {
			echo json_encode(["success" => false, "message" => "Data tidak valid"]);
			return;
		}

		$this->db->trans_start(); // Mulai transaksi database

		// Simpan transaksi utama
		$transaksi = [
			'total' => $data['total'],
			'paid' => $data['paid'],
			'change' => $data['change'],
			'created_at' => date("Y-m-d H:i:s")
		];
		$this->db->insert('transactions', $transaksi);
		$transaction_id = $this->db->insert_id();

		// Simpan detail transaksi
		foreach ($data['items'] as $item) {
			$detail = [
				'transaction_id' => $transaction_id,
				'product_id' => $item['id'],
				'quantity' => $item['qty'],
				'price' => $item['price'],
				'subtotal' => $item['price'] * $item['qty']
			];
			$this->db->insert('transaction_details', $detail);
		}

		$this->db->trans_complete(); // Selesaikan transaksi database

		if ($this->db->trans_status() === FALSE) {
			echo json_encode(["success" => false, "message" => "Gagal menyimpan transaksi"]);
		} else {
			echo json_encode(["success" => true, "message" => "Transaksi berhasil"]);
		}
	}
}
