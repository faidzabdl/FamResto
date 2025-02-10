<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "famresto";

// Buat koneksi
$db = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}
