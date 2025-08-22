<?php
    session_start();
    include 'glava.php';
    
    // Povezava z bazo podatkov
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
    $stmt = $pdo->query("SELECT * FROM trenerji ORDER BY id");
    $trenerji = $stmt->fetchAll();
} catch (PDOException $e) {
    $trenerji = [];
}
?>
<style>
.glavni_del {
    max-width: 95vw;
    width: 100%;
    margin: 35px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    box-sizing: border-box;
}

@media (min-width: 600px) {
    .glavni_del {
        max-width: 1500px;
    }
}

.naslov {
    text-align: center;
    font-size: 3em;
    font-weight: bold;
    color: black;
    margin-bottom: 30px;
    letter-spacing: 2px;
}

.trener-box {
    display: flex;
    background: #f7f7f7;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    max-width: 630px;
    margin-left: auto;
    margin-right: auto;
}

.trener-box img {
    width: 300px;
    height: 350px;
    border-radius: 8px;
    margin-right: 20px;
    object-fit: cover;
    object-position: center;
}

.trener-info h4 {
    margin: 0;
    font-size: 1.4rem;
    color: #333;
}

.trener-info p {
    margin-top: 8px;
    line-height: 1.6;
    font-size: 1.05rem;
    color: #555;
}

.trener-selekcije {
    margin-top: 10px;
    font-style: italic;
    color: #005B8F;
}

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

.admin-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
}

.admin-btn {
    background-color: #005B8F;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s;
}

.admin-btn:hover {
    background-color: #f7941d;
}

.admin-btn.delete {
    background-color: #dc3545;
}

.admin-btn.delete:hover {
    background-color: #c82333;
}

.checkbox-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.checkbox-container input[type="checkbox"] {
    margin-right: 10px;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    text-align: center;
}

@media (max-width: 768px) {
    .glavni_del {
        padding: 20px;
        margin: 20px auto;
    }
    
    .naslov {
        font-size: 2.2em;
        margin-bottom: 20px;
    }
    
    .trener-box {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 15px;
        max-width: 100%;
    }
    
    .trener-box img {
        width: 250px;
        height: 300px;
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .trener-info h4 {
        font-size: 1.3rem;
    }
    
    .trener-info p {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .glavni_del {
        padding: 15px;
        margin: 15px auto;
    }
    
    .naslov {
        font-size: 1.8em;
    }
    
    .trener-box {
        padding: 10px;
        margin-bottom: 15px;
    }
    
    .trener-box img {
        width: 200px;
        height: 250px;
        margin-bottom: 10px;
    }
    
    .trener-info h4 {
        font-size: 1.2rem;
    }
    
    .trener-info p {
        font-size: 0.95rem;
    }
    
    .admin-buttons {
        flex-direction: column;
    }
    
    .admin-btn {
        width: 100%;
        margin-bottom: 5px;
        text-align: center;
    }
}
</style>

<div class="glavni_del">
    <h1 class="naslov">VODSTVO KLUBA</h1>
    
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
        <div class="admin-controls">
            <h3>Upravljanje trenerjev</h3>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">Trener je bil uspešno dodan!</div>
            <?php endif; ?>
            
            <?php if (isset($_GET['deleted'])): ?>
                <div class="success-message">Uspešno izbrisanih trenerjev: <?php echo intval($_GET['deleted']); ?></div>
            <?php endif; ?>
            
            <div class="admin-buttons">
                <a href="dodaj_trenerja.php" class="admin-btn">Dodaj novega trenerja</a>
                <button id="toggle-delete" class="admin-btn delete">Izbriši trenerje</button>
            </div>
            
            <form id="delete-form" action="izbrisi_trenerje.php" method="post" style="display: none;">
                <div id="delete-checkboxes">
                    <?php foreach ($trenerji as $trener): ?>
                        <div class="checkbox-container">
                            <input type="checkbox" name="delete_ids[]" value="<?php echo $trener['id']; ?>" id="trener-<?php echo $trener['id']; ?>">
                            <label for="trener-<?php echo $trener['id']; ?>"><?php echo htmlspecialchars($trener['ime_priimek']); ?> (<?php echo htmlspecialchars($trener['pozicija']); ?>)</label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="admin-btn delete">Izbriši izbrane</button>
            </form>
        </div>
    <?php endif; ?>

    <?php foreach ($trenerji as $trener): ?>
        <div class="trener-box">
            <img src="<?php echo htmlspecialchars($trener['slika_url']); ?>" alt="<?php echo htmlspecialchars($trener['ime_priimek']); ?>">
            <div class="trener-info">
                <h4><?php echo htmlspecialchars($trener['ime_priimek']); ?></h4>
                <p><?php echo htmlspecialchars($trener['pozicija']); ?></p>
                <?php if (!empty($trener['selekcije'])): ?>
                    <p class="trener-selekcije">Selekcije: <?php echo htmlspecialchars($trener['selekcije']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
<script>
    document.getElementById('toggle-delete').addEventListener('click', function() {
        var form = document.getElementById('delete-form');
        if (form.style.display === 'none') {
            form.style.display = 'block';
            this.textContent = 'Prekliči brisanje';
        } else {
            form.style.display = 'none';
            this.textContent = 'Izbriši trenerje';
        }
    });
</script>
<?php endif; ?>

<?php
    include 'noga.php';
?>
