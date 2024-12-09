<?php
require_once 'barang.php';
require_once 'barangmanager.php';

$barangManager = new BarangManager();

// Menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: index.php'); // Redirect untuk mencegah resubmission
    exit;
}

// Menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: index.php'); // Redirect setelah menghapus
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Barang</title>
    <link rel="stylesheet" href="style.css">
   
</head>
<body>

    <!-- Navbar -->
 <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="logo">Zalfa</a>
            <ul class="nav-links">
                <li><a href="home.php">Beranda</a></li>
                <li><a href="costumer.php">Costumer</a></li>
                <li><a href="index.php">Stok Produk</a></li>
            </ul>
        </div>
    </nav>

    <!-- Form Tambah Barang -->
    <div class="container">
        <h1>Pencatatan Barang</h1>
        <form method="POST" action="">
            <div>
                <label for="nama">Nama Barang:</label><br>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div>
                <label for="harga">Harga Barang:</label><br>
                <input type="number" id="harga" name="harga" required>
            </div>
            <div>
                <label for="stok">Stok Barang:</label><br>
                <input type="number" id="stok" name="stok" required>
            </div><br>
            <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barangManager->getBarang() as $barang): ?>
                    <tr>
                        <td><?= htmlspecialchars($barang['id']) ?></td>
                        <td><?= htmlspecialchars($barang['nama']) ?></td>
                        <td><?= htmlspecialchars($barang['harga']) ?></td>
                        <td><?= htmlspecialchars($barang['stok']) ?></td>
                        <td>
                            <a href="?hapus=<?= htmlspecialchars($barang['id']) ?>" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
