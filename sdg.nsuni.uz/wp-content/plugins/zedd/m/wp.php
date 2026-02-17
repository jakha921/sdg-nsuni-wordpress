<?php
@ini_set('display_errors', 1);
@error_reporting(E_ALL);

echo "<h2>🔐 WP Config Hardener + Plugin Killer</h2>";

$config = find_config();
if (!$config) exit("❌ wp-config.php tidak ditemukan!");

echo "✅ Ditemukan: <code>$config</code><br>";

harden_config($config);
clean_plugins(dirname($config));

function find_config() {
    $d = __DIR__;
    while ($d !== dirname($d)) {
        if (file_exists("$d/wp-config.php")) return "$d/wp-config.php";
        $d = dirname($d);
    }
    return false;
}

function harden_config($file) {
    $cfg = @file_get_contents($file);
    if ($cfg === false) {
        echo "❌ Gagal baca wp-config.php<br>";
        return;
    }

    $adds = array(
        "define('DISALLOW_FILE_EDIT', true);",
        "define('DISALLOW_FILE_MODS', true);"
    );

    $added = 0;
    foreach ($adds as $line) {
        if (strpos($cfg, $line) === false) {
            $cfg .= "\n$line";
            echo "➕ Tambah: <code>$line</code><br>";
            $added++;
        }
    }

    if ($added && is_writable($file)) {
        @file_put_contents($file, $cfg);
        echo "✅ wp-config.php diperbarui<br>";
    } else {
        echo "ℹ️ Tidak ada perubahan atau file tidak bisa ditulis<br>";
    }
}

function clean_plugins($wp_root) {
    $dir = "$wp_root/wp-content/plugins";
    $bad = array('wp-file-manager', 'wpspy', 'file-manager-advanced', 'malicious-uploader');

    foreach ($bad as $p) {
        $path = "$dir/$p";
        if (is_dir($path)) {
            delete_recursive($path);
            echo "🗑️ Plugin dihapus: <code>$p</code><br>";
        }
    }
}

function delete_recursive($d) {
    $list = @scandir($d);
    if ($list === false) return;

    foreach ($list as $f) {
        if ($f === '.' || $f === '..') continue;
        $path = "$d/$f";
        if (is_dir($path)) {
            delete_recursive($path);
        } else {
            @unlink($path);
        }
    }
    @rmdir($d);
}
?>
