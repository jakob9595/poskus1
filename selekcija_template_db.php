<?php
    session_start();
    include 'glava.php';
    
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
        $stmt = $pdo->prepare("SELECT * FROM igralci WHERE selekcija = ? ORDER BY je_kapetan DESC, ime_priimek ASC");
        $stmt->execute([$selekcija_id]);
        $igralci = $stmt->fetchAll();
        
        $stmt = $pdo->prepare("SELECT * FROM trenerji WHERE selekcija = ? ORDER BY CASE WHEN pozicija LIKE '%Glavni trener%' THEN 1 WHEN pozicija LIKE '%Pomožni trener%' THEN 2 ELSE 3 END");
        $stmt->execute([$selekcija_id]);
        $trenerji = $stmt->fetchAll();
    } catch (PDOException $e) {
        $igralci = [];
        $trenerji = [];
    }
?>
<style>
.glavni_del {
    max-width: 95vw;
    width: 100%;
    margin: 20px auto;
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

p {
    line-height: 1.6;
    font-size: 1.1rem;
}

h2 {
    margin-top: 2rem;
    font-size: 1.6rem;
}

.ekipa-blok {
    margin-top: 30px;
    padding: 20px;
    background: #f7f7f7;
    border-radius: 8px;
}

.ekipa-blok h2 {
    margin-top: 0;
}

.igralci-lista {
    list-style: none;
    padding: 0;
    margin: 0;
    columns: 2;
}

.igralci-lista li {
    padding: 6px 0;
    font-size: 1.1em;
}

.kapetan {
    font-weight: bold;
}

.kapetan::after {
    content: " (kapetan)";
}

.trener {
    margin-top: 20px;
    font-weight: bold;
}

.razpored-container {
    width: 450px;
    text-align: center;
    margin: 0 auto;
}

.kontakti-ureditev1 img {
    border: 1px solid #ccc;
    border-radius: 8px;
    max-width: 100%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.razpored-opis {
    font-size: 1.1em;
    margin: 15px auto;
}

.statistike-btn, .rezultati-btn {
    background: #005B8F;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin: 10px 5px;
    transition: background-color 0.3s;
}

.statistike-btn:hover, .rezultati-btn:hover {
    background: #f7941d;
}

/* Admin controls */
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

/* Responsive design */
@media (max-width: 768px) {
    .glavni_del {
        padding: 20px;
        margin: 15px auto;
    }
    
    .naslov {
        font-size: 2.2em;
        margin-bottom: 20px;
    }
    
    .razpored-container {
        width: 100%;
        max-width: 450px;
    }
    
    .igralci-lista {
        columns: 1;
    }
    
    .ekipa-blok {
        padding: 15px;
        margin-top: 20px;
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

@media (max-width: 480px) {
    .glavni_del {
        padding: 15px;
        margin: 10px auto;
    }
    
    .naslov {
        font-size: 1.8em;
    }
    
    .ekipa-blok {
        padding: 10px;
    }
    
    .statistike-btn, .rezultati-btn {
        padding: 8px 12px;
        font-size: 0.9em;
    }
}
</style>

<div class="glavni_del">
    <h1 class="naslov"><?php echo $selekcija_naslov; ?></h1>
    
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
        <div class="admin-controls">
            <h3>Upravljanje igralcev</h3>
            
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="success-message">Igralec je bil uspešno dodan!</div>
            <?php endif; ?>
            
            <?php if (isset($_GET['deleted'])): ?>
                <div class="success-message">Uspešno izbrisanih igralcev: <?php echo intval($_GET['deleted']); ?></div>
            <?php endif; ?>
            
            <div class="admin-buttons">
                <a href="dodaj_igralca.php?selekcija=<?php echo urlencode($selekcija_id); ?>" class="admin-btn">Dodaj novega igralca</a>
                <button id="toggle-delete" class="admin-btn delete">Izbriši igralce</button>
            </div>
            
            <form id="delete-form" action="izbrisi_igralce.php" method="post" style="display: none;">
                <input type="hidden" name="redirect" value="<?php echo $redirect_page; ?>">
                <div id="delete-checkboxes">
                    <?php foreach ($igralci as $igralec): ?>
                        <div class="checkbox-container">
                            <input type="checkbox" name="delete_ids[]" value="<?php echo $igralec['id']; ?>" id="igralec-<?php echo $igralec['id']; ?>">
                            <label for="igralec-<?php echo $igralec['id']; ?>">
                                <?php echo htmlspecialchars($igralec['ime_priimek']); ?>
                                <?php if ($igralec['je_kapetan']): ?> (kapetan)<?php endif; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="admin-btn delete">Izbriši izbrane</button>
            </form>
        </div>
        
        <div class="admin-controls">
            <h3>Upravljanje trenerjev</h3>
            
            <?php if (isset($_GET['success']) && $_GET['success'] == 2): ?>
                <div class="success-message">Trener je bil uspešno dodan!</div>
            <?php endif; ?>
            
            <?php if (isset($_GET['trener_deleted'])): ?>
                <div class="success-message">Uspešno izbrisanih trenerjev: <?php echo intval($_GET['trener_deleted']); ?></div>
            <?php endif; ?>
            
            <div class="admin-buttons">
                <a href="dodaj_trenerja.php?selekcija=<?php echo urlencode($selekcija_id); ?>&redirect=<?php echo urlencode($redirect_page); ?>" class="admin-btn">Dodaj novega trenerja</a>
                <button id="toggle-delete-trener" class="admin-btn delete">Izbriši trenerje</button>
            </div>
            
            <form id="delete-trener-form" action="izbrisi_trenerje.php" method="post" style="display: none;">
                <input type="hidden" name="redirect" value="<?php echo $redirect_page; ?>">
                <div id="delete-trener-checkboxes">
                    <?php foreach ($trenerji as $trener): ?>
                        <div class="checkbox-container">
                            <input type="checkbox" name="delete_ids[]" value="<?php echo $trener['id']; ?>" id="trener-<?php echo $trener['id']; ?>">
                            <label for="trener-<?php echo $trener['id']; ?>">
                                <?php echo htmlspecialchars($trener['ime_priimek']); ?> (<?php echo htmlspecialchars($trener['pozicija']); ?>)
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="admin-btn delete">Izbriši izbrane</button>
            </form>
        </div>
    <?php endif; ?>
    
    <div class="ekipa-blok razpored-container">
        <h2>Razpored tekem</h2>
        <div class="kontakti-ureditev1">
            <img src="slike/igra.jpg" alt="Razpored tekem">
            <div class="razpored-opis">
                Spremljajte rezultate preteklih in urnik <br> 
                prihajajočih srečanj <?php echo strtolower($selekcija_naslov); ?> ekipe v <br> 
                vseh tekmovanjih.
            </div>
            <div>
                <a class="rezultati-btn" href="<?php echo $kzs_url; ?>">
                    REZULTATI IN SPORED
                </a>
            </div>
        </div>
    </div>
    
    <div class="ekipa-blok">
        <h2>Ekipa</h2>
        <ul class="igralci-lista">
            <?php foreach ($igralci as $igralec): ?>
                <li class="<?php echo $igralec['je_kapetan'] ? 'kapetan' : ''; ?>">
                    <?php echo htmlspecialchars($igralec['ime_priimek']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <?php foreach ($trenerji as $trener): ?>
            <div class="trener">
                <?php 
                    $pozicija = $trener['pozicija'];
                    if (strpos($pozicija, 'Glavni trener') !== false) {
                        echo 'Trener: ';
                    } else if (strpos($pozicija, 'Pomožni trener') !== false) {
                        echo 'Pomočnik trenerja: ';
                    } else {
                        echo $pozicija . ': ';
                    }
                    echo htmlspecialchars($trener['ime_priimek']);
                ?>
            </div>
        <?php endforeach; ?>
        
        <div class="trener">
            <a class="statistike-btn" href="<?php echo $kzs_statistika_url; ?>">
                Statistike igralcev
            </a>
        </div>
    </div>
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
            this.textContent = 'Izbriši igralce';
        }
    });
    
    document.getElementById('toggle-delete-trener').addEventListener('click', function() {
        var form = document.getElementById('delete-trener-form');
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