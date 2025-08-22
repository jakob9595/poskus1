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
    
    // Preveri, ali tabela trenerji_selekcije že obstaja
    $stmt = $pdo->query("SHOW TABLES LIKE 'trenerji_selekcije'");
    $table_exists = $stmt->fetch() ? true : false;
    
    if (!$table_exists) {
        // Ustvari novo tabelo za povezavo med trenerji in selekcijami
        $sql = "CREATE TABLE trenerji_selekcije (
            id INT(11) NOT NULL AUTO_INCREMENT,
            trener_id INT(11) NOT NULL,
            selekcija VARCHAR(100) NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY trener_selekcija (trener_id, selekcija)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        
        $pdo->exec($sql);
        echo "Tabela 'trenerji_selekcije' je bila uspešno ustvarjena.";
        
        // Migriraj obstoječe podatke iz tabele trenerji
        $stmt = $pdo->query("SELECT id, selekcija FROM trenerji WHERE selekcija IS NOT NULL AND selekcija != ''");
        $trenerji = $stmt->fetchAll();
        
        $inserted = 0;
        foreach ($trenerji as $trener) {
            if (!empty($trener['selekcija'])) {
                $stmt = $pdo->prepare("INSERT INTO trenerji_selekcije (trener_id, selekcija) VALUES (?, ?)");
                $stmt->execute([$trener['id'], $trener['selekcija']]);
                $inserted++;
            }
        }
        
        echo "<br>Migrirano $inserted povezav med trenerji in selekcijami.";
    } else {
        echo "Tabela 'trenerji_selekcije' že obstaja.";
    }
    
    // Prikaži strukturo tabele
    $stmt = $pdo->query("DESCRIBE trenerji_selekcije");
    echo "<br><br>Struktura tabele 'trenerji_selekcije':<br>";
    while ($row = $stmt->fetch()) {
        echo $row['Field'] . " - " . $row['Type'] . " - " . ($row['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . "<br>";
    }
    
} catch (PDOException $e) {
    echo "Napaka: " . $e->getMessage();
}
?>