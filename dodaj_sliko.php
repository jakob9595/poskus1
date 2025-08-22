<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: galerija.php");
    exit;
}

include 'glava.php';

if (isset($_FILES['slika'], $_POST['opis'], $_POST['kategorija']) && $_FILES['slika']['error'] == 0) {
    $imeDatoteke = time() . "_" . basename($_FILES['slika']['name']); 
    $pot = 'slike/' . $imeDatoteke;
    $opis = $_POST['opis'];
    $kategorija = $_POST['kategorija'];

    if (move_uploaded_file($_FILES['slika']['tmp_name'], $pot)) {
        $stmt = $pdo->prepare("INSERT INTO galerija (slika_url, opis, kategorija) VALUES (?, ?, ?)");
        $stmt->execute([$pot, $opis, $kategorija]);

        echo "<script>alert('✅ Slika uspešno dodana!'); window.location.href='galerija.php';</script>";
    } else {
        echo "<script>alert('❌ Napaka pri nalaganju slike.'); window.location.href='galerija.php';</script>";
    }
} else {
    echo "<script>alert('❌ Slika, opis ali kategorija ni bila izbrana ali je prišlo do napake.'); window.location.href='galerija.php';</script>";
}
?>

