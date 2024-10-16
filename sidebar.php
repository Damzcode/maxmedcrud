<?php
// Query untuk mengambil data semua pengguna (hanya jika pengguna adalah admin)
if (isset($logged_in_user['role']) && $logged_in_user['role'] === 'admin') {
    $sqlUser = "SELECT id, name, email, phone, password, avatar, role FROM user";
    $resultUser = $test->query($sqlUser);
}

// Tentukan halaman aktif untuk sidebar
$activePage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

function createSidebar($activePage) {
    // Cek apakah user sudah login dan dapatkan peran mereka
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

    // Tentukan kelas CSS untuk halaman yang aktif
    function setActive($page, $activePage) {
        return $page === $activePage ? 'active' : '';
    }

    return '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <style>
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

            .sidebar ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            .sidebar ul li {
                margin: 0;
            }

            .sidebar ul li.active a {
                background-color: #495057;
            }

            .logout {
                margin-top: auto;
                padding: 10px 15px;
            }
        </style>
    </head>
    <body>
        <div class="sidebar">
            <ul>
                <li class="' . setActive('dashboard', $activePage) . '"><div class="sidebar-title">Dashboard</div></li>
                <li class="' . setActive('service', $activePage) . '"><a onclick="showTable(\'serviceTable\')">Service</a></li>
                <li class="' . setActive('fungsi', $activePage) . '"><a onclick="showTable(\'fungsiTable\')">Fungsi</a></li>
                <li class="' . setActive('mbps', $activePage) . '"><a onclick="showTable(\'mbpsTable\')">Mbps</a></li>
                ' . ($role === 'admin' ? '<li class="' . setActive('user', $activePage) . '"><a onclick="showTable(\'userTable\')">List User</a></li>' : '') . '
                <li class="' . setActive('profile', $activePage) . '"><a onclick="showTable(\'profileTable\')">Profile</a></li>
            </ul>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </body>
    </html>
    ';
}
?>
