<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include "test.php"; // Pastikan file ini berisi koneksi database

// Pastikan parameter `table` dan `id` tersedia
if (isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $id = intval($_GET['id']);
    
    // Validasi nama tabel untuk menghindari SQL Injection
    $validTables = ['service', 'fungsi', 'paket'];
    if (in_array($table, $validTables)) {
        // Query untuk mendapatkan data berdasarkan ID
        $sqlFetch = "SELECT * FROM $table WHERE id = $id";
        $result = $test->query($sqlFetch);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Data tidak ditemukan.";
            exit();
        }
    } else {
        echo "Tabel tidak valid.";
        exit();
    }
} else {
    echo "Permintaan tidak valid.";
    exit();
}

// Inisialisasi variabel pesan sukses
$successMessage = '';

// Proses pembaruan data saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $test->real_escape_string($_POST['nama']);
    $deskripsi = isset($_POST['deskripsi']) ? $test->real_escape_string($_POST['deskripsi']) : null;
    
    // Proses upload gambar
    $imagePath = $row['image']; // Default ke gambar yang sudah ada
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/"; // Folder yang dapat diakses oleh web server
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Pindahkan file yang diunggah ke folder target
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $imagePath = $target_file; // Simpan jalur relatif
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
            exit();
        }
    }

    // Update database berdasarkan tabel
    if ($table == 'service') {
        $sqlUpdate = "UPDATE $table SET nama = '$nama', image = '$imagePath', deskripsi = '$deskripsi' WHERE id = $id";
    } else if ($table == 'fungsi' || $table == 'paket') {
        $sqlUpdate = "UPDATE $table SET nama = '$nama', image = '$imagePath' WHERE id = $id";
    }

    if ($test->query($sqlUpdate) === TRUE) {
        // Menampilkan pesan sukses
        $successMessage = "Data berhasil diperbarui.";

        // Redirect ke dashboard setelah 2 detik
        echo "<script>
            setTimeout(function() {
                window.location.href = 'dashboard.php';
            }, 1000);
        </script>";
    } else {
        echo "Terjadi kesalahan: " . $test->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        form label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        form input, form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        form textarea {
            resize: vertical;
            height: 100px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14px;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .image-preview {
            margin-bottom: 15px;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data</h2>

    <?php if (!empty($successMessage)): ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>

        <label for="image">Unggah Gambar:</label>
        <input type="file" name="image" id="image">

        <!-- Tampilkan gambar yang ada -->
        <div class="image-preview">
            <p>Path Gambar: <?php echo htmlspecialchars($row['image']); ?></p> <!-- Debug path -->
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Image Preview">
        </div>

        <?php if ($table == 'service'): ?>
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
        <?php endif; ?>

        <button type="submit">Update Data</button>
    </form>
</div>
</body>
</html>

<?php
// Menutup koneksi database
$test->close();
?>
