<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Narik semua data siswa dari database tabel 'tb_siswa' buat dimasukin ke pilihan dropdown (dapat dari tabel database 'tb_siswa')
$siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa");

// Ngecek apakah tombol 'submit' (simpan) di form udah diklik atau belum
if (isset($_POST['submit'])) {
    // Nangkep pilihan ID siswa dari form (dapat dari atribut name="id_siswa" di form)
    $id_siswa = $_POST['id_siswa'];
    
    // Nangkep inputan tanggal dari form (dapat dari atribut name="tanggal" di form)
    $tanggal = $_POST['tanggal'];
    
    // Nangkep pilihan status terima dari form (dapat dari atribut name="status_terima" di form)
    $status_terima = $_POST['status_terima'];

    // Nambahin/nyimpen data baru tadi ke dalam database tabel 'tb_mbg'
    mysqli_query($koneksi, "INSERT INTO tb_mbg (id_siswa, tanggal, status_terima) VALUES ('$id_siswa', '$tanggal', '$status_terima')");
    
    // Kalau datanya udah sukses disimpen, lempar/pindah balik halamannya ke 'tampil_mbg.php'
    header("Location: tampil_mbg.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Judul halaman web yang muncul di tab browser -->
    <title>Tambah Pendataan MBG</title>
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
                <h3 class="mb-4 text-success">Tambah Pendataan MBG</h3>
                <!-- Form buat ngirim data baru pakai metode POST -->
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pilih Siswa</label>
                        <!-- Kotak pilihan/dropdown siswa -->
                        <select name="id_siswa" class="form-control" required>
                            <!-- Opsi awal sebelum siswa dipilih -->
                            <option value="">-- Pilih Siswa --</option>
                            <!-- Ngulangin data siswa satu-satu dari database -->
                            <?php while($s = mysqli_fetch_assoc($siswa)) { ?>
                                <!-- Nampilin nama dan kelas siswa sebagai opsi pilihan -->
                                <option value="<?= $s['id_siswa']; ?>"><?= $s['nama']; ?> (<?= $s['kelas']; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <!-- Kotak input tanggal pendataan -->
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Penerimaan</label>
                        <!-- Kotak pilihan status penerimaan MBG -->
                        <select name="status_terima" class="form-control" required>
                            <option value="diterima">Diterima</option>
                            <option value="tidak_diterima">Tidak Diterima</option>
                        </select>
                    </div>
                    <!-- Tombol buat nyimpen data baru -->
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <!-- Tombol buat batalin dan balik lagi ke halaman 'tampil_mbg.php' -->
                    <a href="tampil_mbg.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>