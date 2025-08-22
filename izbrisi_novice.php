<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: novice.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    // Ustvari povezavo z bazo
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
        
        $deletedCount = 0;
        $errors = [];
        
        foreach ($_POST['delete_ids'] as $id) {
            try {
                // Najprej pridobi informacije o sliki
                $stmt = $pdo->prepare("SELECT slika_url FROM novice WHERE id = ?");
                $stmt->execute([$id]);
                $novica = $stmt->fetch();
                
                if ($novica && $novica['slika_url'] && $novica['slika_url'] !== 'slike/default-news.jpg') {
                    // Izbriši sliko, če ni default slika
                    if (file_exists($novica['slika_url'])) {
                        unlink($novica['slika_url']);
                    }
                }
                
                // Izbriši zapis iz baze
                $stmt = $pdo->prepare("DELETE FROM novice WHERE id = ?");
                $stmt->execute([$id]);
                $deletedCount++;
                
            } catch (PDOException $e) {
                $errors[] = "Napaka pri brisanju novice ID $id: " . $e->getMessage();
            }
        }
        
        if ($deletedCount > 0) {
            header("Location: novice.php?deleted=$deletedCount");
            exit;
        }
    } catch (PDOException $e) {
        // Ignoriraj napake pri povezavi
    }
}

// Če ni POST zahteve, preusmeri nazaj
header("Location: novice.php");
exit;
?>
