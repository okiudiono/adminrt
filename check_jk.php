<?php
defined('BASEPATH') or exit('No direct script access allowed');

echo "Checking warga table...\n";
$query = $this->db->select('jk, count(*) as total')->group_by('jk')->get('warga');
foreach ($query->result() as $row) {
    echo "JK: " . $row->jk . " - Total: " . $row->total . "\n";
}
