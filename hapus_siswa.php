<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Nangkep ID siswa yang dikirim lewat URL untuk milih data siswa mana yang mau dihapus (dapat dari parameter URL, contoh: hapus_siswa.php?id=2)
$id = $_GET['id'];

// Njalankan perintah SQL buat mangkas/menghapus data siswa dari tabel 'tb_siswa' berdasarkan ID tersebut (dapat dari tabel database 'tb_siswa')
mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE id_siswa = $id");

// Kalau datanya udah kehapus, otomatis lempar balik halamannya ke 'tampil_siswa.php'
header("Location: tampil_siswa.php");
?>