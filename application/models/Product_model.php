<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Pastikan database dimuat
    }

    public function get_product_by_barcode($barcode)
    {
        return $this->db->get_where('products', ['barcode' => $barcode])->row_array();
    }
    public function search_products($name)
    {
        $this->db->like('name', $name);
        return $this->db->get('products')->result_array();
    }

    public function add_product($barcode, $name, $price)
    {
        $data = [
            'barcode' => $barcode,
            'name' => $name,
            'price' => $price
        ];
        return $this->db->insert('products', $data);
    }
}
