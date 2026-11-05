<?php
$username = "root";
$password = "root";
$hostname = "127.0.0.1";
$database = "mbg";

$koneksi = mysqli_connect(
    $hostname,
    $username,
    $password,
    $database
);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

return $koneksi;
?>