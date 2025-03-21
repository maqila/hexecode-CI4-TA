<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_teaterform');

if ($mysqli->connect_errno) {
    die('Koneksi gagal: ' . $mysqli->connect_error);
} else {
    echo 'Koneksi berhasil!';
}
?>
