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
    
    // Preveri, ali tabela trenerji vsebuje stolpec selekcija
    $stmt = $pdo->query("SHOW COLUMNS FROM trenerji LIKE 'selekcija'");
    $column_exists = $stmt->fetch() ? true : false;
    
    if (!$column_exists) {
        // Dodaj stolpec selekcija, če ne obstaja
        $pdo->exec("ALTER TABLE trenerji ADD COLUMN selekcija VARCHAR(100) NULL AFTER pozicija");
        echo "Stolpec 'selekcija' je bil uspešno dodan v tabelo 'trenerji'.";
    } else {
        echo "Stolpec 'selekcija' že obstaja v tabeli 'trenerji'.";
    }
    
    // Prikaži strukturo tabele
    $stmt = $pdo->query("DESCRIBE trenerji");
    echo "\n\nStruktura tabele 'trenerji':\n";
    while ($row = $stmt->fetch()) {
        echo $row['Field'] . " - " . $row['Type'] . " - " . ($row['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . "\n";
    }
    
} catch (PDOException $e) {
    echo "Napaka: " . $e->getMessage();
}
?>