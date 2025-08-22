<?php

session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: novice.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naslov = $_POST['naslov'] ?? '';
    $opis = $_POST['opis'] ?? '';
    
    if (!empty($naslov) && !empty($opis)) {

        if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'slike/';
            $fileExtension = strtolower(pathinfo($_FILES['slika']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $fileName = time() . '_' . uniqid() . '.' . $fileExtension;
                $uploadPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadPath)) {
                    $slika_url = $uploadPath;
                } else {
                    $slika_url = 'slike/default-news.jpg';
                }
            } else {
                $slika_url = 'slike/default-news.jpg';
            }
        } else {
            $slika_url = 'slike/default-news.jpg';
        }
        
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
            
            $stmt = $pdo->prepare("INSERT INTO novice (naslov, opis, slika_url, dodano_ob) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$naslov, $opis, $slika_url]);
            
            header("Location: novice.php?success=1");
            exit;
        } catch (PDOException $e) {
            $error = "Napaka pri dodajanju novice: " . $e->getMessage();
        }
    } else {
        $error = "Vsa polja so obvezna!";
    }
}
include 'glava.php';
?>

<style>
.admin-controls {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    border: 2px solid #e9ecef;
}

.admin-controls h3 {
    color: #005B8F;
    margin-bottom: 15px;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

.form-group textarea {
    height: 100px;
    resize: vertical;
}

.submit-btn {
    background: #005B8F;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background: #f7941d;
}

.error {
    color: #dc3545;
    background: #f8d7da;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    border: 1px solid #f5c6cb;
}

.success {
    color: #155724;
    background: #d4edda;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    border: 1px solid #c3e6cb;
}

@media (max-width: 768px) {
    .admin-controls {
        padding: 15px;
    }
    
    .form-group input,
    .form-group textarea {
        font-size: 16px; 
    }
}
</style>

<div class="glavni_del">
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="success">Novica je bila uspešno dodana!</div>
    <?php endif; ?>
    
    <div class="admin-controls">
        <h3>Dodaj novo novico</h3>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="naslov">Naslov novice:</label>
                <input type="text" id="naslov" name="naslov" required>
            </div>
            
            <div class="form-group">
                <label for="opis">Opis novice:</label>
                <textarea id="opis" name="opis" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="slika">Slika (opcijsko):</label>
                <input type="file" id="slika" name="slika" accept="image/*">
                <small>Dovoljene oblike: JPG, PNG, GIF, WEBP. Maksimalna velikost: 5MB</small>
            </div>
            
            <button type="submit" class="submit-btn">Dodaj novico</button>
        </form>
        <div style="text-align: center; margin-top: 20px;">
        <a href="novice.php" style="color: #005B8F; text-decoration: none; font-weight: bold;">
            ← Nazaj na novice
        </a>
    </div>
    </div>
</div>

<?php include 'noga.php';
 ?>
