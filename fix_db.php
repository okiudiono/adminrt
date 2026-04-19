<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");
$res = pg_query($conn, "ALTER TABLE tagihan ADD COLUMN keterangan TEXT");
if ($res) {
    echo "Column 'keterangan' added successfully.\n";
} else {
    echo "Error adding column: " . pg_last_error($conn) . "\n";
}
