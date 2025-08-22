<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: trenerji.php");
    exit;
}

// Preveri, če je bila podana selekcija in stran za preusmeritev
$selekcija = $_GET['selekcija'] ?? '';
$redirect = $_GET['redirect'] ?? 'trenerji.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime_priimek = $_POST['ime_priimek'] ?? '';
    $pozicija = $_POST['pozicija'] ?? '';
    $selekcija = $_POST['selekcija'] ?? '';
    $redirect = $_POST['redirect'] ?? 'trenerji.php';
    
    if (!empty($ime_priimek) && !empty($pozicija)) {

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
                    $slika_url = 'slike/profilna.png';
                }
            } else {
                $slika_url = 'slike/profilna.png';
            }
        } else {
            $slika_url = 'slike/profilna.png';
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
            
            // Če je podana selekcija, dodaj trenerja s selekcijo
            if (!empty($selekcija)) {
                $stmt = $pdo->prepare("INSERT INTO trenerji (ime_priimek, pozicija, slika_url, selekcija) VALUES (?, ?, ?, ?)");
                $stmt->execute([$ime_priimek, $pozicija, $slika_url, $selekcija]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO trenerji (ime_priimek, pozicija, slika_url) VALUES (?, ?, ?)");
                $stmt->execute([$ime_priimek, $pozicija, $slika_url]);
            }
            
            // Preusmeri na ustrezno stran z ustreznim parametrom success
            if ($redirect != 'trenerji.php') {
                header("Location: $redirect?success=2");
            } else {
                header("Location: trenerji.php?success=1");
            }
            exit;
        } catch (PDOException $e) {
            $error = "Napaka pri dodajanju trenerja: " . $e->getMessage();
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
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
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
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

.form-group textarea {
    height: 150px;
    resize: vertical;
}

.btn-submit {
    background-color: #005B8F;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    width: 100%;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #f7941d;
}

.error-message {
    color: #dc3545;
    margin-bottom: 15px;
    padding: 10px;
    background-color: #f8d7da;
    border-radius: 5px;
    border: 1px solid #f5c6cb;
}

.back-link {
    display: inline-block;
    margin-top: 15px;
    color: #005B8F;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .admin-controls {
        padding: 15px;
    }
    
    .btn-submit {
        padding: 10px 15px;
    }
}
</style>

<div class="glavni_del">
    <div class="admin-controls">
        <h3>Dodaj novega trenerja</h3>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="dodaj_trenerja.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">
            <input type="hidden" name="selekcija" value="<?php echo htmlspecialchars($selekcija); ?>">
            
            <?php if (!empty($selekcija)): ?>
            <div class="form-group">
                <p><strong>Dodajanje trenerja za selekcijo:</strong> <?php echo htmlspecialchars($selekcija); ?></p>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="ime_priimek">Ime in priimek:</label>
                <input type="text" id="ime_priimek" name="ime_priimek" required>
            </div>
            
            <div class="form-group">
                <label for="pozicija">Pozicija:</label>
                <select id="pozicija" name="pozicija" required>
                    <option value="">Izberi pozicijo</option>
                    <option value="Glavni trener">Glavni trener</option>
                    <option value="Pomožni trener">Pomožni trener</option>
                    <option value="Kondicijski trener">Kondicijski trener</option>
                    <option value="Fizioterapevt">Fizioterapevt</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="slika">Slika (neobvezno):</label>
                <input type="file" id="slika" name="slika">
                <small>Priporočena velikost: 300x350 pikslov. Dovoljeni formati: JPG, JPEG, PNG, GIF, WEBP.</small>
            </div>
            
            <button type="submit" class="btn-submit">Dodaj trenerja</button>
        </form>
        
        <a href="<?php echo htmlspecialchars($redirect); ?>" class="back-link">Nazaj</a>
    </div>
</div>

<?php
    include 'noga.php';
?>