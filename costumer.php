<?php
// Memulai sesi
session_start();

// Inisialisasi data pelanggan jika belum ada
if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = [];
}

// Menambahkan data pelanggan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_customer'])) {
    $name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);

    // Validasi sederhana
    if (!empty($name) && !empty($contact) && !empty($email)) {
        $_SESSION['customers'][] = [
            'name' => $name,
            'contact' => $contact,
            'email' => $email,
        ];
    } else {
        $error = "Semua bidang harus diisi!";
    }
}

// Menghapus semua data pelanggan
if (isset($_POST['clear_customers'])) {
    $_SESSION['customers'] = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            padding-top: 80px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #3498db;
        }

        button {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #2980b9;
        }

        button[type="submit"][name="clear_customers"] {
            background-color: #e74c3c;
        }

        button[type="submit"][name="clear_customers"]:hover {
            background-color: #c0392b;
        }

        /* Styling untuk Error Message */
        .error {
            color: #e74c3c;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        /* Styling untuk tabel pelanggan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
            text-align: left;
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        td[colspan="3"] {
            text-align: center;
            font-style: italic;
            color: #888;
}
    </style>
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

    <h1>Manajemen Pelanggan</h1>

    <form method="post">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" placeholder="Masukkan nama" required>

        <label for="contact">Kontak:</label>
        <input type="text" id="contact" name="contact" placeholder="Masukkan kontak" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" required>

        <button type="submit" name="add_customer">Tambahkan Pelanggan</button>
        <button type="submit" name="clear_customers">Hapus Semua</button>
    </form>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <h2>Daftar Pelanggan</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['customers'])): ?>
                <?php foreach ($_SESSION['customers'] as $customer): ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['name']); ?></td>
                        <td><?= htmlspecialchars($customer['contact']); ?></td>
                        <td><?= htmlspecialchars($customer['email']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align:center;">Belum ada pelanggan yang ditambahkan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>