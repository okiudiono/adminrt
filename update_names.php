<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");

$names = [
    8 => 'Bangunan',
    10 => 'D. Ronda',
    11 => 'Tung. Bln Lalu'
];

foreach ($names as $id => $name) {
    pg_query($conn, "UPDATE iuran SET nama_iuran = '" . pg_escape_string($name) . "' WHERE id = $id");
}

echo "Names updated successfully.\n";
