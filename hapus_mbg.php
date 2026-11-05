<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Nangkep ID yang dikirim lewat URL untuk milih data mana yang mau dihapus (dapat dari parameter URL, contoh: hapus.php?id=3)
$id = $_GET['id'];

// Njalankan perintah SQL buat mangkas/menghapus data dari tabel 'tb_mbg' berdasarkan ID tersebut (dapat dari tabel database 'tb_mbg')
mysqli_query($koneksi, "DELETE FROM tb_mbg WHERE id_mbg = $id");

// Kalau datanya udah kehapus, otomatis lempar balik halamannya ke 'tampil_mbg.php'
header("Location: tampil_mbg.php");
?>