<?php
$db = new SQLite3('db.sqlite');
$res = $db->query('SELECT * FROM tagihan ORDER BY id DESC LIMIT 5');
while($row = $res->fetchArray(SQLITE3_ASSOC)) {
    print_r($row);
}
