<?php
session_start();
include 'functions.php';

// Inisialisasi session jika belum ada data tugas
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

$tasks = $_SESSION['tasks'];

// Tambah tugas baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['judul'])) {
    $judul = trim($_POST['judul']);
    if (!empty($judul)) {
        $tasks[] = ['judul' => $judul, 'status' => 'belum'];
    }
}

// Toggle status tugas
if (isset($_POST['toggle_index'])) {
    $i = (int) $_POST['toggle_index'];
    if (isset($tasks[$i])) {
        $tasks[$i]['status'] = $tasks[$i]['status'] === 'selesai' ? 'belum' : 'selesai';
    }
}

// Hapus tugas
if (isset($_POST['hapus_index'])) {
    $i = (int) $_POST['hapus_index'];
    if (isset($tasks[$i])) {
        unset($tasks[$i]);
        $tasks = array_values($tasks); // reset index array
    }
}

// Simpan kembali ke session
$_SESSION['tasks'] = $tasks;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kegiatan Harian</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Daftar Kegiatan Harian</h1>
        <p>Daftar kegiatan Harian Primbad</p>
    </header>

    <!-- Form Tambah Tugas -->
    <section class="form-section">
        <form method="post" class="form-tugas">
            <input type="text" name="judul" placeholder="Tulis tugas baru..." required>
            <button type="submit">Tambah</button>
        </form>
    </section>

    <!-- Daftar Tugas -->
    <section class="task-section">
        <?php tampilkanDaftar($tasks); ?>
    </section>

</body>
</html>
