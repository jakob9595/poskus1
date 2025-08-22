<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: trenerji.php");
    exit;
}

// Preveri, če je bila podana stran za preusmeritev
$redirect = $_POST['redirect'] ?? 'trenerji.php';

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
                $stmt = $pdo->prepare("SELECT slika_url FROM trenerji WHERE id = ?");
                $stmt->execute([$id]);
                $trener = $stmt->fetch();
                
                if ($trener && $trener['slika_url'] && $trener['slika_url'] !== 'slike/profilna.png') {
                    // Izbriši sliko, če ni default slika
                    if (file_exists($trener['slika_url'])) {
                        unlink($trener['slika_url']);
                    }
                }
                
                // Izbriši trenerja
                $stmt = $pdo->prepare("DELETE FROM trenerji WHERE id = ?");
                $stmt->execute([$id]);
                
                $stmt->execute([$id]);
                
                $deletedCount++;
                
            } catch (PDOException $e) {
                $errors[] = "Napaka pri brisanju trenerja ID $id: " . $e->getMessage();
            }
        }
        
        if ($deletedCount > 0) {
            // Preusmeri na ustrezno stran z ustreznim parametrom
            if ($redirect != 'trenerji.php') {
                header("Location: $redirect?trener_deleted=$deletedCount");
            } else {
                header("Location: trenerji.php?deleted=$deletedCount");
            }
            exit;
        }
    } catch (PDOException $e) {
        // Ignoriraj napake pri povezavi
    }
}

// Če ni POST zahteve, preusmeri nazaj
header("Location: $redirect");
exit;
?>