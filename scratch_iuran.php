<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");

if (!$conn) {
    echo "An error occurred.\n";
    exit;
}

$result = pg_query($conn, "SELECT id, nama_iuran FROM iuran");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

while ($row = pg_fetch_assoc($result)) {
    echo $row['id'] . '|' . $row['nama_iuran'] . "\n";
}
