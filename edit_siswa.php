<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Nangkep ID siswa yang dikirim lewat URL (dapat dari parameter URL, contoh: edit_siswa.php?id=1)
$id = $_GET['id'];

// Narik data siswa dari database tabel 'tb_siswa' sesuai ID yang lagi diedit (dapat dari tabel database 'tb_siswa')
$data = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_siswa = $id");

// Nyiapin data mentah dari database tadi biar bisa dibaca dan dimasukin ke form (dapat dari hasil query variabel $data)
$row = mysqli_fetch_assoc($data);

// Ngecek apakah tombol 'update' di form udah diklik atau belum
if (isset($_POST['update'])) {
    // Nangkep inputan NIS yang baru dan dibersihin biar aman dari karakter aneh (dapat dari atribut name="nis" di form)
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    
    // Nangkep inputan nama siswa yang baru dan dibersihin (dapat dari atribut name="nama" di form)
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    
    // Nangkep inputan kelas yang baru dan dibersihin (dapat dari atribut name="kelas" di form)
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

    // Ngunci/update data siswa baru tadi ke database tabel 'tb_siswa' berdasarkan ID-nya
    mysqli_query($koneksi, "UPDATE tb_siswa SET nis='$nis', nama='$nama', kelas='$kelas' WHERE id_siswa=$id");
    
    // Kalau udah selesai update, lempar/pindah balik halamannya ke 'tampil_siswa.php'
    header("Location: tampil_siswa.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <!-- Ngambil file CSS Bootstrap dari internet (CDN) biar tampilannya otomatis rapi dan bagus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="mb-4 text-success">Edit Data Siswa</h3>
                <!-- Form buat ngirim data pakai metode POST -->
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <!-- Kotak input NIS, isinya otomatis nampil data lama dari database dan dilindungi htmlspecialchars biar aman -->
                        <input type="text" name="nis" class="form-control" value="<?= htmlspecialchars($row['nis']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <!-- Kotak input Nama Siswa, isinya otomatis nampil data lama dari database -->
                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($row['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <!-- Kotak input Kelas, isinya otomatis nampil data lama dari database -->
                        <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($row['kelas']); ?>" required>
                    </div>
                    <!-- Tombol buat nyimpen/ngirim data update -->
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <!-- Tombol buat batalin dan balik lagi ke halaman 'tampil_siswa.php' -->
                    <a href="tampil_siswa.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>