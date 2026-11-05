
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pendataan MBG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                MBG Kelas
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
            <div class="container-fluid py-3">

                <h1 class="display-5 fw-bold text-success">
                    Aplikasi Pendataan MBG
                </h1>

                <p class="col-md-8 fs-4 text-muted">
                    Sistem Pengelolaan Makan Bergizi Gratis (MBG)
                    untuk lingkungan kelas dengan mudah dan terstruktur.
                </p>

                <hr class="my-4">

                <p class="text-secondary">
                    Silakan pilih data yang ingin kamu kelola:
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="tampil_siswa.php"
                       class="btn btn-success btn-lg px-4">
                        Data Siswa
                    </a>

                    <a href="tampil_mbg.php"
                       class="btn btn-outline-success btn-lg px-4">
                        Pendataan MBG
                    </a>

                    <a href="tampil_menu_mbg.php"
                       class="btn btn-warning btn-lg px-4">
                        Data Menu MBG
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
