<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Nangkep ID yang dikirim lewat URL (dapat dari parameter URL, contoh: edit.php?id=1)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Narik data dari database tabel 'tb_mbg' sesuai ID yang lagi diedit (dapat dari tabel database 'tb_mbg')
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM tb_mbg WHERE id_mbg = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$data = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data MBG tidak ditemukan.");
}

// Narik semua data siswa buat nanti dimasukin ke pilihan dropdown (dapat dari tabel database 'tb_siswa')
$siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa");

// Ngecek apakah tombol 'update' di form udah diklik atau belum
if (isset($_POST['update'])) {
    // Nangkep data pilihan siswa yang baru dari form (dapat dari atribut name="id_siswa" di form)
    $id_siswa = $_POST['id_siswa'];
    
    // Nangkep inputan tanggal yang baru dari form (dapat dari atribut name="tanggal" di form)
    $tanggal = $_POST['tanggal'];
    
    // Nangkep pilihan status terima yang baru dari form (dapat dari atribut name="status_terima" di form)
    $status_terima = $_POST['status_terima'];

    // Ngunci/update data baru tadi ke database tabel 'tb_mbg' berdasarkan ID-nya
    mysqli_query($koneksi, "UPDATE tb_mbg SET id_siswa='$id_siswa', tanggal='$tanggal', status_terima='$status_terima' WHERE id_mbg=$id");
    
    // Kalau udah selesai update, lempar/pindah balik halamannya ke 'tampil_mbg.php'
    header("Location: tampil_mbg.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pendataan MBG</title>
    <!-- Ngambil file CSS Bootstrap dari internet (CDN) biar tampilannya otomatis rapi dan bagus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="mb-4 text-success">Edit Pendataan MBG</h3>
                <!-- Form buat ngirim data pakai metode POST -->
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pilih Siswa</label>
                        <!-- Kotak pilihan/dropdown siswa -->
                        <select name="id_siswa" class="form-control" required>
                            <!-- Ngulangin data siswa satu-satu dari database -->
                            <?php while($s = mysqli_fetch_assoc($siswa)) { ?>
                                <!-- Nampilin nama & kelas siswa. Kalau ID-nya pas sama data lama, otomatis dipilih pake 'selected' -->
                                <option value="<?= $s['id_siswa']; ?>" <?= ($s['id_siswa'] == $row['id_siswa']) ? 'selected' : ''; ?>><?= $s['nama']; ?> (<?= $s['kelas']; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <!-- Kotak input tanggal, isinya otomatis ngikutin data dari database ($row['tanggal']) -->
                        <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Penerimaan</label>
                        <!-- Kotak pilihan status, otomatis milih 'diterima' atau 'tidak_diterima' sesuai data di database -->
                        <select name="status_terima" class="form-control" required>
                            <option value="diterima" <?= ($row['status_terima'] == 'diterima') ? 'selected' : ''; ?>>Diterima</option>
                            <option value="tidak_diterima" <?= ($row['status_terima'] == 'tidak_diterima') ? 'selected' : ''; ?>>Tidak Diterima</option>
                        </select>
                    </div>
                    <!-- Tombol buat nyimpen/ngirim data update -->
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <!-- Tombol buat batalin dan balik lagi ke halaman 'tampil_mbg.php' -->
                    <a href="tampil_mbg.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>