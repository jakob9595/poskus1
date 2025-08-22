<?php
// Povezava z bazo podatkov
$host = 'localhost';
$db   = 'KKVojnik';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Preveri, če tabela obstaja
    $stmt = $pdo->query("SHOW TABLES LIKE 'trenerji_selekcije'");
    $tableExists = $stmt->rowCount() > 0;
    
    if ($tableExists) {
        // Odstrani tabelo
        $pdo->exec("DROP TABLE trenerji_selekcije");
        echo "Tabela 'trenerji_selekcije' je bila uspešno odstranjena.";
    } else {
        echo "Tabela 'trenerji_selekcije' ne obstaja.";
    }
    
} catch (PDOException $e) {
    echo "Napaka: " . $e->getMessage();
}
?>