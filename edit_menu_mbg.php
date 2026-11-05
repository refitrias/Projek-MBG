
<?php
include 'koneksi1.php';

if (!isset($_GET['id'])) {
    header("Location: tampil_menu_mbg.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT nama_menu FROM tb_menu_mbg WHERE id_menu = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    exit("Data menu tidak ditemukan.");
}

$error = "";

if (isset($_POST['ubah'])) {
    $nama_menu = trim($_POST['nama_menu']);

    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE tb_menu_mbg SET nama_menu = ? WHERE id_menu = ?"
    );
    mysqli_stmt_bind_param($stmt, "si", $nama_menu, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: tampil_menu_mbg.php");
        exit;
    } else {
        $error = "Gagal mengubah menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Menu MBG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Menu MBG</h4>
        </div>

        <div class="card-body">
            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu"
                           class="form-control"
                           value="<?= htmlspecialchars($row['nama_menu']); ?>"
                           required>
                </div>

                <button type="submit" name="ubah"
                        class="btn btn-warning">Simpan Perubahan</button>

                <a href="tampil_menu_mbg.php"
                   class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
