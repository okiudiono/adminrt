<?php
$host = "localhost";
$port = "5432";
$db = "wargartempat";
$user = "postgres";
$pw = "zeromind";

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pw");

$r = pg_query($conn, "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
while($row = pg_fetch_assoc($r)) {
    echo $row['table_name'] . "\n";
}
