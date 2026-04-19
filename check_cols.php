<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");
$res = pg_query($conn, "SELECT column_name FROM information_schema.columns WHERE table_name = 'tagihan'");
while($row = pg_fetch_assoc($res)) {
    echo $row['column_name'] . "\n";
}
