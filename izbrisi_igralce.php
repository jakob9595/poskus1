<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: selekcije.php");
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
        $selekcija = '';
        
        foreach ($_POST['delete_ids'] as $id) {
            try {
                // Najprej pridobi informacije o igralcu za preusmeritev
                if (empty($selekcija)) {
                    $stmt = $pdo->prepare("SELECT selekcija FROM igralci WHERE id = ?");
                    $stmt->execute([$id]);
                    $igralec = $stmt->fetch();
                    if ($igralec) {
                        $selekcija = $igralec['selekcija'];
                    }
                }
                
                // Izbriši zapis iz baze
                $stmt = $pdo->prepare("DELETE FROM igralci WHERE id = ?");
                $stmt->execute([$id]);
                $deletedCount++;
                
            } catch (PDOException $e) {
                $errors[] = "Napaka pri brisanju igralca ID $id: " . $e->getMessage();
            }
        }
        
        if ($deletedCount > 0 && !empty($selekcija)) {
            header("Location: $selekcija.php?deleted=$deletedCount");
            exit;
        } else {
            header("Location: selekcije.php?deleted=$deletedCount");
            exit;
        }
    } catch (PDOException $e) {
        // Ignoriraj napake pri povezavi
    }
}

// Če ni POST zahteve, preusmeri nazaj
header("Location: selekcije.php");
exit;
?>