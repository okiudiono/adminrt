<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");
$res = pg_query($conn, "SELECT jadwal_ronda, count(*) FROM warga WHERE aktif = true GROUP BY jadwal_ronda ORDER BY jadwal_ronda");
while($row = pg_fetch_assoc($res)) {
    echo "Hari " . ($row['jadwal_ronda'] ?? 'NULL') . ": " . $row['count'] . " orang\n";
}
