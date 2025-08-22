<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: galerija.php");
    exit;
}

include 'glava.php';

if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    foreach ($_POST['delete_ids'] as $id) {
        $id = (int)$id; 

        $stmt = $pdo->prepare("SELECT slika_url FROM galerija WHERE id = ?");
        $stmt->execute([$id]);
        $slika = $stmt->fetch();

        if ($slika && file_exists($slika['slika_url'])) {
            unlink($slika['slika_url']); 
        }

        $stmt = $pdo->prepare("DELETE FROM galerija WHERE id = ?");
        $stmt->execute([$id]);
    }

    echo "<script>alert('🗑️ Izbrane slike so bile izbrisane!'); window.location.href='galerija.php';</script>";
} else {
    echo "<script>alert('❌ Ni bilo izbranih slik.'); window.location.href='galerija.php';</script>";
}
?>
