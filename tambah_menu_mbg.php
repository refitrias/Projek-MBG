<?php
include 'koneksi1.php';

if (isset($_POST['simpan'])) {
    $nama_menu = trim($_POST['nama_menu']);

    // PERBAIKAN: Menambahkan kolom 'tanggal' dan fungsi NOW() di sini
    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO tb_menu_mbg (nama_menu, tanggal) VALUES (?, NOW())"
    );
    mysqli_stmt_bind_param($stmt, "s", $nama_menu);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: tampil_menu_mbg.php");
        exit;
    } else {
        $error = "Gagal menyimpan menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Menu MBG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Menu MBG</h4>
        </div>

        <div class="card-body">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu"
                           class="form-control"
                           placeholder="Masukkan nama menu"
                           required>
                </div>

                <button type="submit" name="simpan"
                        class="btn btn-primary">
                    Simpan
                </button>

                <a href="tampil_menu_mbg.php"
                   class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>