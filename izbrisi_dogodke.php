<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: dogodki.php");
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
                $stmt = $pdo->prepare("DELETE FROM dogodki WHERE id = ?");
                $stmt->execute([$id]);
                $deletedCount++;
                
            } catch (PDOException $e) {
                $errors[] = "Napaka pri brisanju dogodka ID $id: " . $e->getMessage();
            }
        }
        
        if ($deletedCount > 0) {
            header("Location: dogodki.php?deleted=$deletedCount");
            exit;
        }
    } catch (PDOException $e) {
        // Ignoriraj napake pri povezavi
    }
}

// Če ni POST zahteve, preusmeri nazaj
header("Location: dogodki.php");
exit;
?>
