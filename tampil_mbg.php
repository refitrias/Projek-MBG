<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Narik data gabungan dari tabel 'tb_mbg' dan 'tb_siswa' pakai JOIN supaya nama dan kelas siswa bisa ikut nampil (dapat dari database MySQL)
$query = mysqli_query($koneksi, "SELECT tb_mbg.*, tb_siswa.nama, tb_siswa.kelas FROM tb_mbg JOIN tb_siswa ON tb_mbg.id_siswa = tb_siswa.id_siswa");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Judul halaman web yang muncul di tab browser -->
    <title>Pendataan MBG</title>
    <!-- Ngambil file CSS Bootstrap dari internet (CDN) biar tampilannya otomatis rapi dan bagus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Kontainer utama dengan jarak atas (mt-5) -->
    <div class="container mt-5">
        <!-- Bagian header atas tabel (judul dan tombol aksi) yang ditata sejajar kanan-kiri -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Pendataan MBG</h2>
            <div>
                <!-- Tombol kecil untuk kembali ke halaman utama index.php -->
                <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
                <!-- Tombol hijau kecil untuk pindah ke halaman tambah data MBG -->
                <a href="tambah_mbg.php" class="btn btn-success btn-sm">+ Tambah Pendataan</a>
            </div>
        </div>
        <!-- Kotak kartu putih pembungkus tabel dengan sudut tanpa border dan bayangan tipis -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <!-- Tabel daftar data dengan garis belang-belang, efek hover baris, dan posisi teks vertikal di tengah -->
                <table class="table table-striped table-hover align-middle">
                    <!-- Kepala tabel berwarna hijau -->
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Status Penerimaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Perulangan (looping) untuk nampilin setiap baris data dari database ke dalam tabel -->
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <!-- Nomor urut yang otomatis bertambah terus setiap baris -->
                            <td><?= $no++; ?></td>
                            <!-- Nampilin Nama Siswa dan dilindungi htmlspecialchars biar aman -->
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <!-- Nampilin Kelas Siswa dan dilindungi htmlspecialchars -->
                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                            <!-- Nampilin Tanggal pendataan dan dilindungi htmlspecialchars -->
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            <td>
                                <!-- Mengecek status penerimaan: kalau 'diterima', nampilin badge hijau -->
                                <?php if($row['status_terima'] == 'diterima') { ?>
                                    <span class="badge bg-success">Diterima</span>
                                <!-- Kalau statusnya bukan diterima (tidak diterima), nampilin badge merah -->
                                <?php } else { ?>
                                    <span class="badge bg-danger">Tidak Diterima</span>
                                <?php } ?>
                            </td>
                            <td>
                                <!-- Tombol kuning (Edit) untuk mengarah ke halaman edit_mbg.php dengan membawa ID data -->
                                <a href="edit_mbg.php?id=<?= $row['id_mbg']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Tombol merah (Hapus) dengan pop-up konfirmasi sebelum data benar-benar dihapus -->
                                <a href="hapus_mbg.php?id=<?= $row['id_mbg']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>