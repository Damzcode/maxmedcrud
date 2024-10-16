<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include 'test.php'; // Pastikan file ini berisi koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle avatar upload if provided
    $avatar_path = null;
    if (!empty($_FILES['avatar']['name'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $avatar_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Insert the user data into the database
    $sql = "INSERT INTO user (name, email, phone, password, avatar, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $test->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $hashed_password, $avatar_path, $role);

    if ($stmt->execute()) {
        // Jika sukses, arahkan ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $test->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah User</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="avatar">Avatar (optional):</label>
            <input type="file" id="avatar" name="avatar">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <input type="submit" value="Add User">
    </form>
</div>

</body>
</html>
