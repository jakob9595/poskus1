<?php
    include 'glava.php';
    
    // Avtomatsko izbriši potekle dogodke
    try {
        $stmt = $pdo->prepare("DELETE FROM dogodki WHERE cas_dogodka < NOW()");
        $stmt->execute();
        $deletedPastEvents = $stmt->rowCount();
    } catch (PDOException $e) {
        // Ignoriraj napake pri brisanju
    }
    
    // Pridobi dogodke iz baze
    try {
        $stmt = $pdo->query("SELECT * FROM dogodki ORDER BY cas_dogodka ASC");
        $dogodki = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $dogodki = [];
        $error = "Napaka pri nalaganju dogodkov: " . $e->getMessage();
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

p {
    line-height: 1.6;
    font-size: 1.1rem;
}

h2 {
    margin-top: 2rem;
    font-size: 1.6rem;
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
    background: #f7941D;
}

.delete-btn {
    background: #dc3545;
}

.delete-btn:hover {
    background: #c82333;
}

.kontainer-dogodek {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
    margin: 20px 0;
    padding: 10px;
    border-radius: 10px;
    background-color: lightgrey;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #005B8F;
    border-radius: 10px;
    border: none;
}

table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

table td {
    text-align: center;
    color: white;
}

table th {
    background-color: #F7941D;
    color: white;
    text-align: center;
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

.info {
    color: #0c5460;
    background: #d1ecf1;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    border: 1px solid #bee5eb;
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
    
    .kontainer-dogodek {
        padding: 15px;
        margin: 15px 0;
    }
    
    table th, table td {
        padding: 8px 10px;
        font-size: 0.9em;
    }
    
    .delete-item {
        flex-direction: column;
        text-align: center;
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
    
    .kontainer-dogodek {
        padding: 10px;
    }
    
    table th, table td {
        padding: 6px 8px;
        font-size: 0.8em;
    }
    
    table {
        font-size: 0.9em;
    }
}
</style>

<div class="glavni_del">
    <h1 class="naslov">Dogodki</h1>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="success">Dogodek je bil uspešno dodan!</div>
    <?php endif; ?>
    
    <?php if (isset($_GET['deleted'])): ?>
        <div class="success"><?php echo $_GET['deleted']; ?> dogodek(ov) je bil uspešno izbrisan!</div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($deletedPastEvents) && $deletedPastEvents > 0): ?>
        <div class="info">Avtomatsko je bilo izbrisanih <?php echo $deletedPastEvents; ?> poteklih dogodkov.</div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
    <div class="admin-controls">
        <a href="dodaj_dogodek.php" class="admin-btn">➕ Dodaj nov dogodek</a>
        <button onclick="toggleDeleteForm()" class="admin-btn delete-btn">🗑️ Izbriši dogodke</button>
        <a href="?odjava=1" class="admin-btn" style="background: #6c757d;">🚪 Odjava</a>
    </div>
    <?php else: ?>
    <div class="admin-controls" style="text-align: center; padding: 15px;">
        <p style="margin: 0; color: #666;"></p>
    </div>
    <?php endif; ?>
    
    <form id="deleteForm" method="POST" action="izbrisi_dogodke.php" class="delete-form">
        <h3>Izberi dogodke za brisanje:</h3>
        <?php if (!empty($dogodki)): ?>
            <?php foreach ($dogodki as $dogodek): ?>
                <div class="delete-item">
                    <input type="checkbox" name="delete_ids[]" value="<?php echo $dogodek['id']; ?>" class="delete-checkbox">
                    <div class="delete-item-info">
                        <h5><?php echo htmlspecialchars($dogodek['naslov']); ?></h5>
                        <small>
                            Lokacija: <?php echo htmlspecialchars($dogodek['lokacija']); ?> | 
                            Čas: <?php echo date('d.m.Y H:i', strtotime($dogodek['cas_dogodka'])); ?>
                        </small>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="admin-btn delete-btn" style="margin-top: 15px;">Potrdi izbris</button>
        <?php else: ?>
            <p>Ni dogodkov za prikaz.</p>
        <?php endif; ?>
    </form>
    
    <div class="kontainer-dogodek">
        <?php if (!empty($dogodki)): ?>
            <table>
                <tr>
                    <th>Datum in čas</th>
                    <th>Dogodek</th>
                    <th>Lokacija</th>
                </tr>
                <?php foreach ($dogodki as $dogodek): ?>
                    <tr>
                        <td><?php echo date('d.m.Y H:i', strtotime($dogodek['cas_dogodka'])); ?></td>
                        <td><?php echo htmlspecialchars($dogodek['naslov']); ?></td>
                        <td><?php echo htmlspecialchars($dogodek['lokacija']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #666; font-style: italic;">
                Trenutno ni načrtovanih dogodkov. Dodajte prvi dogodek z gumbom "Dodaj nov dogodek".
            </p>
        <?php endif; ?>
    </div>
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