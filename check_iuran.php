<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");
$res = pg_query($conn, "SELECT id, nama_iuran, ur FROM iuran ORDER BY ur ASC");
while($row = pg_fetch_assoc($res)) {
    echo $row['id'] . '|' . $row['nama_iuran'] . '|' . $row['ur'] . "\n";
}
