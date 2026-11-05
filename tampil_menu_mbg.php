
<?php
include 'koneksi1.php';

$data = mysqli_query(
    $koneksi,
    "SELECT id_menu, nama_menu FROM tb_menu_mbg ORDER BY id_menu ASC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Menu MBG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Data Menu MBG</h4>
        </div>

        <div class="card-body">
            <a href="tambah_menu_mbg.php"
               class="btn btn-success mb-3">
                + Tambah Menu
            </a>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>ID Menu</th>
                            <th>Nama Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_menu']; ?></td>
                            <td>
                                <?= htmlspecialchars($row['nama_menu']); ?>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm"
                                   href="edit_menu_mbg.php?id=<?= $row['id_menu']; ?>">
                                    Edit
                                </a>

                                <a class="btn btn-danger btn-sm"
                                   href="hapus_menu_mbg.php?id=<?= $row['id_menu']; ?>"
                                   onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php if (mysqli_num_rows($data) == 0) { ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                Belum ada data menu.
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
