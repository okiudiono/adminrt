<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");

$order = [
    1 => 1,  // Arisan
    2 => 2,  // Kematian
    3 => 3,  // Dana Sehat
    4 => 4,  // Swadaya
    5 => 5,  // Snack
    7 => 6,  // TPQ
    8 => 7,  // Bangunan (Pembangunan)
    9 => 8,  // Suran
    6 => 9,  // Jimpitan
    10 => 10, // D. Ronda (Denda Ronda)
    11 => 11, // Tung. Bln Lalu (Tngkan Bulan lalu)
    12 => 12, // Angsuran
    13 => 13  // Kerjabakti
];

foreach ($order as $id => $ur) {
    pg_query($conn, "UPDATE iuran SET ur = $ur WHERE id = $id");
}

echo "Order updated successfully.\n";
