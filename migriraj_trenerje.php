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
    
    // Začni transakcijo
    $pdo->beginTransaction();
    
    // Pridobi vse trenerje, ki imajo nastavljeno selekcijo
    $stmt = $pdo->query("SELECT id, selekcija FROM trenerji WHERE selekcija IS NOT NULL AND selekcija != ''");
    $trenerji = $stmt->fetchAll();
    
    echo "<h2>Migracija trenerjev v novo strukturo</h2>";
    
    if (empty($trenerji)) {
        echo "<p>Ni trenerjev za migracijo.</p>";
    } else {
        // Pripravi stavek za vstavljanje v novo tabelo
        $insert_stmt = $pdo->prepare("INSERT IGNORE INTO trenerji_selekcije (trener_id, selekcija) VALUES (?, ?)");
        
        $migrirano = 0;
        foreach ($trenerji as $trener) {
            try {
                $insert_stmt->execute([$trener['id'], $trener['selekcija']]);
                $migrirano++;
                echo "<p>Migriran trener ID: {$trener['id']} - Selekcija: {$trener['selekcija']}</p>";
            } catch (PDOException $e) {
                echo "<p>Napaka pri migraciji trenerja ID: {$trener['id']} - {$e->getMessage()}</p>";
            }
        }
        
        echo "<p>Uspešno migrirano $migrirano trenerjev.</p>";
    }
    
    // Potrdi transakcijo
    $pdo->commit();
    
    echo "<p><a href='trenerji.php'>Nazaj na trenerje</a></p>";
    
} catch (PDOException $e) {
    // V primeru napake razveljavi transakcijo
    if (isset($pdo)) {
        $pdo->rollBack();
    }
    echo "<p>Napaka: " . $e->getMessage() . "</p>";
}
?>