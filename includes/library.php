<?php
function connectDB() {
    // detect if running locally or on InfinityFree
    $isLocal = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

    $configFile = __DIR__ . ($isLocal ? "/config_local.ini" : "/config_live.ini");
    $config = parse_ini_file($configFile);

    if ($config === false) {
        die("❌ Error reading config file: $configFile");
    }

    try {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("❌ Database connection failed: " . $e->getMessage());
    }
}
