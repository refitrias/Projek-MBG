
<?php
include 'koneksi1.php';

if (!isset($_GET['id'])) {
    header("Location: tampil_menu_mbg.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM tb_menu_mbg WHERE id_menu = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: tampil_menu_mbg.php");
    exit;
}

echo "Gagal menghapus menu.";
?>
