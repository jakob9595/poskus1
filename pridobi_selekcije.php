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
    
    // Pridobi vse selekcije iz tabele igralci
    $stmt = $pdo->query("SELECT DISTINCT selekcija FROM igralci WHERE selekcija IS NOT NULL AND selekcija != '' ORDER BY selekcija");
    $selekcije = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<pre>";
    print_r($selekcije);
    echo "</pre>";
    
} catch (PDOException $e) {
    echo "Napaka: " . $e->getMessage();
}
?>