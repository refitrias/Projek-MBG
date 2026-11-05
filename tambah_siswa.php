<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Ngecek apakah tombol 'submit' (simpan) di form udah diklik atau belum
if (isset($_POST['submit'])) {
    // Nangkep inputan NIS yang baru dan dibersihin biar aman dari karakter aneh (dapat dari atribut name="nis" di form)
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    
    // Nangkep inputan nama siswa dan dibersihin (dapat dari atribut name="nama" di form)
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    
    // Nangkep inputan kelas dan dibersihin (dapat dari atribut name="kelas" di form)
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

    // Nambahin/nyimpen data siswa baru tadi ke dalam database tabel 'tb_siswa'
    mysqli_query($koneksi, "INSERT INTO tb_siswa (nis, nama, kelas) VALUES ('$nis', '$nama', '$kelas')");
    
    // Kalau datanya udah sukses disimpen, lempar/pindah balik halamannya ke 'tampil_siswa.php'
    header("Location: tampil_siswa.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Judul halaman web yang muncul di tab browser -->
    <title>Tambah Siswa</title>
    <!-- Ngambil file CSS Bootstrap dari internet (CDN) biar tampilannya otomatis rapi dan bagus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Kontainer utama dengan lebar maksimal 600px dan jarak atas (mt-5) -->
    <div class="container mt-5" style="max-width: 600px;">
        <!-- Kotak kartu putih dengan sudut tanpa border dan ada bayangan tipis -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- Judul bagian atas form -->
                <h3 class="mb-4 text-success">Tambah Data Siswa</h3>
                <!-- Form buat ngirim data baru pakai metode POST -->
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <!-- Kotak input teks untuk mengisi NIS siswa -->
                        <input type="text" name="nis" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <!-- Kotak input teks untuk mengisi Nama Siswa -->
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <!-- Kotak input teks untuk mengisi Kelas siswa -->
                        <input type="text" name="kelas" class="form-control" required>
                    </div>
                    <!-- Tombol buat nyimpen data siswa baru -->
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <!-- Tombol buat batalin dan balik lagi ke halaman 'tampil_siswa.php' -->
                    <a href="tampil_siswa.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>