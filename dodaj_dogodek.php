<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: dogodki.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naslov = $_POST['naslov'] ?? '';
    $lokacija = $_POST['lokacija'] ?? '';
    $cas_dogodka = $_POST['cas_dogodka'] ?? '';
    
    if (!empty($naslov) && !empty($lokacija) && !empty($cas_dogodka)) {

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
            
            $stmt = $pdo->prepare("INSERT INTO dogodki (naslov, lokacija, cas_dogodka) VALUES (?, ?, ?)");
            $stmt->execute([$naslov, $lokacija, $cas_dogodka]);
            
            header("Location: dogodki.php?success=1");
            exit;
        } catch (PDOException $e) {
            $error = "Napaka pri dodajanju dogodka: " . $e->getMessage();
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

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
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
    
    .form-group input {
        font-size: 16px; /* Prepreči zoom na iOS */
    }
}
</style>

<div class="glavni_del">
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="success">Dogodek je bil uspešno dodan!</div>
    <?php endif; ?>
    
    <div class="admin-controls">
        <h3>Dodaj nov dogodek</h3>
        
        <form method="POST">
            <div class="form-group">
                <label for="naslov">Naslov dogodka:</label>
                <input type="text" id="naslov" name="naslov" required>
            </div>
            
            <div class="form-group">
                <label for="lokacija">Lokacija:</label>
                <input type="text" id="lokacija" name="lokacija" required>
            </div>
            
            <div class="form-group">
                <label for="cas_dogodka">Datum in čas dogodka:</label>
                <input type="datetime-local" id="cas_dogodka" name="cas_dogodka" required>
            </div>
            
            <button type="submit" class="submit-btn">Dodaj dogodek</button>
        </form>
        <div style="text-align: center; margin-top: 20px;">
        <a href="dogodki.php" style="color: #005B8F; text-decoration: none; font-weight: bold;">
            ← Nazaj na dogodke
        </a>
    </div>
    </div>
</div>

<?php include 'noga.php'; ?>
