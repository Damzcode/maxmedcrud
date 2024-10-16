<?php
// Include file untuk koneksi ke database
include "test.php"; // Pastikan file ini berisi koneksi database

// Pastikan form telah mengirimkan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $table = $_POST['table'];
    $id = $_POST['id'];

    // Sanitasi input
    $table = $test->real_escape_string($table);
    $id = intval($id);

    // Validasi nama tabel untuk menghindari SQL Injection
    $validTables = ['service', 'fungsi', 'paket'];
    if (in_array($table, $validTables)) {
        // Query untuk menghapus data berdasarkan ID dan tabel
        $sqlDelete = "DELETE FROM $table WHERE id = $id";

        // Debugging: Tampilkan query yang dieksekusi
        echo "Executing query: $sqlDelete<br>";

        if ($test->query($sqlDelete) === TRUE) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Terjadi kesalahan: " . $test->error;
        }
    } else {
        echo "Nama tabel tidak valid.";
    }
} else {
    echo "Permintaan tidak valid.";
}

// Tutup koneksi database
$test->close();
?>
