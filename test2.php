<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        form table {
            width: 100%;
            border-collapse: collapse;
        }

        form td {
            padding: 10px 5px;
            vertical-align: top;
        }

        form td:first-child {
            width: 130px;
            font-weight: bold;
            color: #555;
        }

        form input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        ul li form {
            display: inline;
        }

        ul li input[type="submit"] {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        ul li input[type="submit"]:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Service</h2>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Id</td>
                    <td><input type="text" name="id" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Submit" name="proses"></td>
                </tr>
            </table>
        </form>

        <?php
        include "test.php";

        if (isset($_POST['proses'])) {
            // Menggunakan prepared statement untuk menghindari SQL Injection
            $stmt = $test->prepare("INSERT INTO paket (nama) VALUES (?)");
            $stmt->bind_param("s", $_POST['nama']);

            if ($stmt->execute()) {
                // Arahkan ke dashboard.php setelah berhasil
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        if (isset($_POST['delete'])) {
            // Hapus data dari database
            $id = intval($_POST['id']);
            $stmt = $test->prepare("DELETE FROM paket WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Arahkan ke dashboard.php setelah berhasil
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        // Menampilkan data dari tabel paket
        $sql = "SELECT * FROM paket";
        $result = $test->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Daftar Service</h2><ul>";
            while($row = $result->fetch_assoc()) {
                echo "<li>ID: " . $row["id"]. " - Nama: " . $row["nama"];
                echo " <form action='' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='submit' name='delete' value='Delete' onclick=\"return confirm('Are you sure you want to delete this item?');\">
                      </form></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>0 results</p>";
        }

        // Menutup koneksi
        $test->close();
        ?>
    </div>
</body>
</html>
