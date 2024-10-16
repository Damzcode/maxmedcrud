<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include "test.php"; // Menghubungkan ke database

$message = '';
$packageId = '';
$packageName = '';

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $packageId = $_POST['packageId'];
    $packageName = $_POST['packageName'];

    // SQL untuk memperbarui data paket
  // SQL untuk memperbarui data paket
$sql = "UPDATE paket SET nama=? WHERE id=?";
$stmt = $test->prepare($sql);
$stmt->bind_param("si", $packageName, $packageId);

if ($stmt->execute()) {
    $message = "Paket berhasil diperbarui!";
} else {
    $message = "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
}

// Ambil data untuk ditampilkan di form (jika ada ID yang dipilih)
if (isset($_GET['packageId'])) {
    $packageId = $_GET['packageId'];
    
    // Menggunakan kolom 'id' yang benar
    $sql = "SELECT nama FROM paket WHERE id=?";
    $stmt = $test->prepare($sql);
    $stmt->bind_param("i", $packageId);
    $stmt->execute();
    $stmt->bind_result($packageName);
    $stmt->fetch();
    $stmt->close();
}

$test->close();

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Mbps</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Paket Mbps</h2>
    <?php if (!empty($message)) { ?>
        <div class="message"><?php echo $message; ?></div>
    <?php } ?>
    <form action="edit_paket.php" method="post">
        <div class="form-group">
            <label for="packageId">ID Paket:</label>
            <input type="text" id="packageId" name="packageId" value="<?php echo htmlspecialchars($packageId); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="packageName">Nama Paket:</label>
            <input type="text" id="packageName" name="packageName" value="<?php echo htmlspecialchars($packageName); ?>" required>
        </div>
        <div class="form-group">
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

</body>
</html>
