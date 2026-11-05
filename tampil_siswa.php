<?php
// Ngambil koneksi database dari file luar (dapat dari file 'koneksi1.php')
$koneksi = include 'koneksi1.php';

// Narik semua data siswa dari tabel 'tb_siswa' di database (dapat dari database MySQL)
$query = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Judul halaman web yang muncul di tab browser -->
    <title>Data Siswa - MBG</title>
    <!-- Ngambil file CSS Bootstrap dari internet (CDN) biar tampilannya otomatis rapi dan bagus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Kontainer utama dengan jarak atas (mt-5) -->
    <div class="container mt-5">
        <!-- Bagian header atas tabel (judul dan tombol aksi) yang ditata sejajar kanan-kiri -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Siswa</h2>
            <div>
                <!-- Tombol kecil untuk kembali ke halaman utama index.php -->
                <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
                <!-- Tombol hijau kecil untuk pindah ke halaman tambah data siswa -->
                <a href="tambah_siswa.php" class="btn btn-success btn-sm">+ Tambah Siswa</a>
            </div>
        </div>
        <!-- Kotak kartu putih pembungkus tabel dengan sudut tanpa border dan bayangan tipis -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <!-- Tabel daftar siswa dengan garis belang-belang, efek hover baris, dan posisi teks vertikal di tengah -->
                <table class="table table-striped table-hover align-middle">
                    <!-- Kepala tabel berwarna hijau -->
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Perulangan (looping) buat nampilin setiap data siswa dari database satu-satu ke dalam baris tabel -->
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <!-- Nomor urut tabel yang otomatis bertambah terus -->
                            <td><?= $no++; ?></td>
                            <!-- Nampilin NIS siswa dan dilindungi htmlspecialchars biar aman -->
                            <td><?= htmlspecialchars($row['nis']); ?></td>
                            <!-- Nampilin Nama Siswa dan dilindungi htmlspecialchars -->
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <!-- Nampilin Kelas siswa dan dilindungi htmlspecialchars -->
                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                            <td>
                                <!-- Tombol kuning (Edit) untuk mengarah ke halaman edit_siswa.php dengan membawa ID siswa tersebut -->
                                <a href="edit_siswa.php?id=<?= $row['id_siswa']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Tombol merah (Hapus) dengan pop-up konfirmasi sebelum data siswa benar-benar dihapus -->
                                <a href="hapus_siswa.php?id=<?= $row['id_siswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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