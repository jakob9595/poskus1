<?php
    include 'glava.php';

    try {
        $stmt = $pdo->query("SELECT * FROM novice ORDER BY dodano_ob DESC");
        $novice = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $novice = [];
        $error = "Napaka pri nalaganju novic: " . $e->getMessage();
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

.admin-controls {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    border: 2px solid #e9ecef;
    text-align: center;
}

.admin-btn {
    background: #005B8F;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    margin: 0 10px;
    transition: background-color 0.3s;
}

.admin-btn:hover {
    background: #f7941d;
}

.delete-btn {
    background: #dc3545;
}

.delete-btn:hover {
    background: #c82333;
}

.novice-box {
    position: relative;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    background: #f7f7f7;
    border-radius: 8px;
    padding: 40px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
    gap: 20px;
}

.novice-info {
    flex: 1;
}

.novice-box img {
    width: 100%;
    max-width: 250px;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
    object-position: center;
    flex-shrink: 0;
}

.novice-info h4 {
    margin: 0;
    font-size: 1.5rem;
    color: #F7941D;
}

.novice-info p {
    margin-top: 8px;
    line-height: 1.6;
    font-size: 1.1rem;
    color: #555;
}

.datum {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 0.9rem;
    color: #888;
    background: #fff;
    padding: 3px 8px;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    z-index: 1;
}

.delete-form {
    display: none;
    background: #fff3cd;
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
    border: 2px solid #ffeaa7;
}

.delete-form.active {
    display: block;
}

.delete-checkbox {
    margin-right: 10px;
    transform: scale(1.2);
}

.delete-item {
    display: flex;
    align-items: center;
    padding: 10px;
    margin: 5px 0;
    background: white;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.delete-item img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 15px;
}

.delete-item-info {
    flex: 1;
}

.delete-item-info h5 {
    margin: 0 0 5px 0;
    color: #333;
}

.delete-item-info small {
    color: #666;
}

.success {
    color: #155724;
    background: #d4edda;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    border: 1px solid #c3e6cb;
}

.error {
    color: #dc3545;
    background: #f8d7da;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    border: 1px solid #f5c6cb;
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
    
    .admin-controls {
        padding: 15px;
    }
    
    .admin-btn {
        display: block;
        margin: 10px auto;
        text-align: center;
    }
    
    .novice-box {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 40px;
    }

    .novice-box img {
        max-width: 100%;
        width: 100%;
        height: auto;
        margin-top: 15px;
    }

    .datum {
        top: 10px;
        right: 10px;
        font-size: 0.8rem;
    }

    .novice-info {
        width: 100%;
    }
    
    .delete-item {
        flex-direction: column;
        text-align: center;
    }
    
    .delete-item img {
        margin: 0 0 10px 0;
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
    
    .novice-box {
        padding: 15px;
    }
    
    .novice-info h4 {
        font-size: 1.3rem;
    }
    
    .novice-info p {
        font-size: 1rem;
    }
}
</style>

<div class="glavni_del">
    <h1 class="naslov">Novice</h1>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="success">Novica je bila uspešno dodana!</div>
    <?php endif; ?>
    
    <?php if (isset($_GET['deleted'])): ?>
        <div class="success"><?php echo $_GET['deleted']; ?> novica(e) je bila uspešno izbrisana!</div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
    <div class="admin-controls">
        <a href="dodaj_novico.php" class="admin-btn">➕ Dodaj novo novico</a>
        <button onclick="toggleDeleteForm()" class="admin-btn delete-btn">🗑️ Izbriši novice</button>
        <a href="?odjava=1" class="admin-btn" style="background: #6c757d;">🚪 Odjava</a>
    </div>
    <?php else: ?>
    <div class="admin-controls" style="text-align: center; padding: 15px;">
        <p style="margin: 0; color: #666;"></p>
    </div>
    <?php endif; ?>
    
    <form id="deleteForm" method="POST" action="izbrisi_novice.php" class="delete-form">
        <h3>Izberi novice za brisanje:</h3>
        <?php if (!empty($novice)): ?>
            <?php foreach ($novice as $novica): ?>
                <div class="delete-item">
                    <input type="checkbox" name="delete_ids[]" value="<?php echo $novica['id']; ?>" class="delete-checkbox">
                    <img src="<?php echo htmlspecialchars($novica['slika_url']); ?>" alt="<?php echo htmlspecialchars($novica['naslov']); ?>">
                    <div class="delete-item-info">
                        <h5><?php echo htmlspecialchars($novica['naslov']); ?></h5>
                        <small>Dodano: <?php echo date('d.m.Y H:i', strtotime($novica['dodano_ob'])); ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="admin-btn delete-btn" style="margin-top: 15px;">Potrdi izbris</button>
        <?php else: ?>
            <p>Ni novic za prikaz.</p>
        <?php endif; ?>
    </form>

    <?php if (!empty($novice)): ?>
        <?php foreach ($novice as $novica): ?>
            <div class="novice-box">
                <div class="datum"><?php echo date('d.m.Y', strtotime($novica['dodano_ob'])); ?></div>
                <div class="novice-info">
                    <h4><?php echo htmlspecialchars($novica['naslov']); ?></h4>
                    <p><?php echo htmlspecialchars($novica['opis']); ?></p>
                </div>
                <img src="<?php echo htmlspecialchars($novica['slika_url']); ?>" alt="<?php echo htmlspecialchars($novica['naslov']); ?>">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="novice-box">
            <div class="novice-info">
                <h4>Ni novic</h4>
                <p>Dodajte prvo novico z gumbom "Dodaj novo novico".</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function toggleDeleteForm() {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.classList.toggle('active');
}
</script>

<?php
    include 'noga.php';
?>
