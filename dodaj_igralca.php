<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: selekcije.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime_priimek = $_POST['ime_priimek'] ?? '';
    $selekcija = $_POST['selekcija'] ?? '';
    $je_kapetan = isset($_POST['je_kapetan']) ? 1 : 0;
    
    if (!empty($ime_priimek) && !empty($selekcija)) {
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
            
            // Če je nov igralec kapetan, odstrani status kapetana od vseh ostalih igralcev v tej selekciji
            if ($je_kapetan) {
                $stmt = $pdo->prepare("UPDATE igralci SET je_kapetan = 0 WHERE selekcija = ?");
                $stmt->execute([$selekcija]);
            }
            
            $stmt = $pdo->prepare("INSERT INTO igralci (ime_priimek, selekcija, je_kapetan) VALUES (?, ?, ?)");
            $stmt->execute([$ime_priimek, $selekcija, $je_kapetan]);
            
            // Preusmeri nazaj na ustrezno stran selekcije
            header("Location: $selekcija.php?success=1");
            exit;
        } catch (PDOException $e) {
            $error = "Napaka pri dodajanju igralca: " . $e->getMessage();
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
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

.form-check {
    margin-top: 10px;
}

.form-check label {
    display: inline;
    margin-left: 5px;
    font-weight: normal;
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
        <h3>Dodaj novega igralca</h3>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="dodaj_igralca.php" method="post">
            <div class="form-group">
                <label for="ime_priimek">Ime in priimek:</label>
                <input type="text" id="ime_priimek" name="ime_priimek" required>
            </div>
            
            <div class="form-group">
                <label for="selekcija">Selekcija:</label>
                <select id="selekcija" name="selekcija" required>
                    <option value="">Izberi selekcijo</option>
                    <option value="clani">Člani</option>
                    <option value="u20">U20</option>
                    <option value="u18">U18</option>
                    <option value="u16">U16</option>
                    <option value="u14">U14</option>
                    <option value="u12">U12</option>
                    <option value="u10">U10</option>
                </select>
            </div>
            
            <div class="form-check">
                <input type="checkbox" id="je_kapetan" name="je_kapetan">
                <label for="je_kapetan">Kapetan ekipe</label>
                <small>(Če označite to možnost, bo morebitni obstoječi kapetan izgubil status kapetana)</small>
            </div>
            
            <button type="submit" class="btn-submit">Dodaj igralca</button>
        </form>
        
        <a href="selekcije.php" class="back-link">Nazaj na selekcije</a>
    </div>
</div>

<?php
    include 'noga.php';
?>