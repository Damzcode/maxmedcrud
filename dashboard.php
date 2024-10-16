<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include "test.php"; 

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$sqlService = "SELECT id, nama, image, deskripsi FROM service";
$resultService = $test->query($sqlService);

$sqlFungsi = "SELECT id, nama, image FROM fungsi";
$resultFungsi = $test->query($sqlFungsi);

$sqlMbps = "SELECT id, nama FROM paket";
$resultMbps = $test->query($sqlMbps);

$email_logged_in = $_SESSION['email'];
$sqlProfile = "SELECT id, name, email, phone, avatar, role FROM user WHERE email = '$email_logged_in'";
$resultProfile = $test->query($sqlProfile);
$logged_in_user = $resultProfile->fetch_assoc();

// Query untuk mengambil data semua pengguna (hanya jika pengguna adalah admin)
if ($logged_in_user['role'] === 'admin') {
    $sqlUser = "SELECT id, name, email, phone, password, avatar, role FROM user";
    $resultUser = $test->query($sqlUser);
}

// Tentukan halaman aktif untuk sidebar
$activePage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

function createSidebar($activePage, $role) {
    return '
    <div class="sidebar">
        <ul>
            <li class="'. ($activePage == 'dashboard' ? 'active' : '') .'"><div class="sidebar-title">Dashboard</div></li>
            <li class="'. ($activePage == 'service' ? 'active' : '') .'"><a onclick="showTable(\'serviceTable\')">Service</a></li>
            <li class="'. ($activePage == 'fungsi' ? 'active' : '') .'"><a onclick="showTable(\'fungsiTable\')">Fungsi</a></li>
            <li class="'. ($activePage == 'mbps' ? 'active' : '') .'"><a onclick="showTable(\'mbpsTable\')">Mbps</a></li>
            ' . ($role === 'admin' ? '<li class="'. ($activePage == 'user' ? 'active' : '') .'"><a onclick="showTable(\'userTable\')">User</a></li>' : '') . '
            <li class="'. ($activePage == 'profile' ? 'active' : '') .'"><a onclick="showTable(\'profileTable\')">Profile</a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            height: 100vh;
            color: white;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            cursor: pointer;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar .sidebar-title {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 15px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .action-btns {
            display: flex;
            gap: 5px;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
        }

        .btn-edit {
            background-color: green;
        }

        .btn-delete {
            background-color: red;
        }

        .data-table {
            display: none;
        }

        .add-btn {
            display: inline-block;
            margin-bottom: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-btn:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function showTable(tableId) {
            document.querySelectorAll('.data-table').forEach(function(table) {
                table.style.display = 'none';
            });

            document.getElementById(tableId).style.display = 'block';
            
            localStorage.setItem('activeTable', tableId);
        }

        function deleteData(tableName, id) {
            if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
                document.getElementById('deleteFormTable').value = tableName;
                document.getElementById('deleteFormId').value = id;
                document.getElementById('deleteForm').submit();
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const activeTable = localStorage.getItem('activeTable') || 'serviceTable';
            showTable(activeTable);
        });
    </script>
</head>
<body>

<?php 
echo createSidebar($activePage, $logged_in_user['role']); 
?>

<div class="content">

    <!-- Tabel Service -->
    <div id="serviceTable" class="data-table">
        <h2>Daftar Service</h2>
        <a href="index1.php" class="add-btn">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Image</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultService->num_rows > 0) {
                    while($row = $resultService->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td><img src='" . $row["image"] . "' alt='" . $row["nama"] . "' width='50'></td>";
                        echo "<td>" . $row["deskripsi"] . "</td>";
                        echo "<td>";
                        echo "<div class='action-btns'>";
                        echo "<a href='edit.php?table=service&id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>";
                        echo "<button type='button' class='btn btn-delete' onclick='deleteData(\"service\", " . $row["id"] . ")'>Delete</button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Tabel Fungsi -->
    <div id="fungsiTable" class="data-table">
        <h2>Daftar Fungsi</h2>
        <a href="test1.php" class="add-btn">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Image</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultFungsi->num_rows > 0) {
                    while($row = $resultFungsi->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td><img src='" . $row["image"] . "' alt='" . $row["nama"] . "' width='50'></td>";
                        echo "<td>";
                        echo "<div class='action-btns'>";
                        echo "<a href='edit.php?table=fungsi&id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>";
                        echo "<button type='button' class='btn btn-delete' onclick='deleteData(\"fungsi\", " . $row["id"] . ")'>Delete</button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Tabel Mbps -->
    <div id="mbpsTable" class="data-table">
        <h2>Daftar Mbps</h2>
        <a href="test2.php" class="add-btn">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultMbps->num_rows > 0) {
                    while($row = $resultMbps->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>";
                        echo "<div class='action-btns'>";
                        echo "<a href='edit_paket.php?table=mbps&id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>";
                        echo "<button type='button' class='btn btn-delete' onclick='deleteData(\"mbps\", " . $row["id"] . ")'>Delete</button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Tabel User (hanya jika pengguna adalah admin) -->
    <?php if ($logged_in_user['role'] === 'admin'): ?>
    <div id="userTable" class="data-table">
        <h2>Daftar User</h2>
        <a href="add_user.php" class="add-btn">Tambah user</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultUser->num_rows > 0) {
                    while($row = $resultUser->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td><img src='" . $row["avatar"] . "' alt='Avatar' width='50' height='50'></td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo "<td>";
                        echo "<div class='action-btns'>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Profile User -->
    <div id="profileTable" class="data-table">
        <h2>Profile User</h2>
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo $logged_in_user['id']; ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td><?php echo $logged_in_user['name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $logged_in_user['email']; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $logged_in_user['phone']; ?></td>
            </tr>
            <tr>
                <th>Avatar</th>
                <td><img src="<?php echo $logged_in_user['avatar']; ?>" alt="Avatar" width="50"></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?php echo $logged_in_user['role']; ?></td>
            </tr>
        </table>
    </div>

    <!-- Form Hapus (umum) -->
    <form id="deleteForm" method="POST" action="delete.php" style="display:none;">
        <input type="hidden" name="table" id="deleteFormTable">
        <input type="hidden" name="id" id="deleteFormId">
    </form>
</div>

</body>
</html>
