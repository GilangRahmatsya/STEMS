<?php

/**
 * Script untuk memperbaiki error "caching_sha2_password" pada MySQL Railway.
 * Script ini akan merubah metode autentikasi user root agar kompatibel dengan PHP.
 */

$host = 'yamabiko.proxy.rlwy.net';
$port = 41375;
$db   = 'railway';
$user = 'root';
$pass = 'vEZhnkijoEDddtaXZmlFoEkHiecuwxOW';

echo "--- DATABASE AUTH FIXER ---\n";
echo "Connecting to: $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 10,
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully!\n";

    echo "Changing authentication plugin for root user...\n";
    $pdo->exec("ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY '$pass'");
    $pdo->exec("FLUSH PRIVILEGES");
    
    echo "SUCCESS: Authentication method changed to 'mysql_native_password'.\n";
    echo "Now your Railway application should be able to connect.\n";

} catch (PDOException $e) {
    echo "ERROR: Could not connect to database.\n";
    echo "Message: " . $e->getMessage() . "\n";
    if (strpos($e->getMessage(), 'caching_sha2_password') !== false) {
        echo "\nTips: Jika local PHP Anda juga tidak mendukung caching_sha2_password, \n";
        echo "gunakan tool seperti TablePlus, Beekeeper Studio, atau MySQL Workbench \n";
        echo "untuk menjalankan query ini secara manual:\n\n";
        echo "ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY '$pass';\n";
    }
}
