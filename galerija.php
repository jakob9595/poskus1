<?php
    include 'glava.php';
?>
<style>
.glavni_del {
    max-width: 95vw;
    width: 100%;
    margin: 35px auto;
    background: #fff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    box-sizing: border-box;
}
@media (min-width: 600px) {
    .glavni_del {
        max-width: 1500px;
    }
}
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}
.slike{
    width: 100%;
    text-align: center;
}
h1{
    font-weight: normal;
    font-size: 35px;
    position: relative;
    margin: 40px 0;
}
h1::before{
    content: "";
    position: absolute;
    width: 100px;
    height: 5px;
    background: #005B8F;
    left: 50%;
    transform: translateX(-50%);
    bottom: -20px;
    animation: animate 4s linear infinite;
}
@keyframes animate{
    0%{
        width: 100px;
    }
    50%{
        width: 300px;
    }
    100%{
        width: 100px;
    }
}
.top-content{
    background: #005B8F;
    width: 100%;
    margin: 0 auto 20px auto;
    min-height: 60px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-left: 5px solid #FFA500;
    border-right: 5px solid #FFA500;
}
h3{
    background-color: lightgray;
    height: 100%;
    line-height: 60px;
    padding: 0 50px;
    color: black;
}
label{
    display: inline-block;
    height: 100%;
    padding: 0 20px;
    margin: 0 20px;
    line-height: 60px;
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: color .5s;
}
label:hover{
    color: lightgray;

}
.photo-gallery{
    width: 90%;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 50px;
}

.photo-gallery .pic {
    display: none;
}
#check1:checked ~ .photo-gallery .pic {
    display: flex;
}
#check2:checked ~ .photo-gallery .clani {
    display: flex;
}
#check3:checked ~ .photo-gallery .u20 {
    display: flex;
}
#check4:checked ~ .photo-gallery .u18 {
    display: flex;
}
#check5:checked ~ .photo-gallery .u16 {
    display: flex;
}
#check6:checked ~ .photo-gallery .u14 {
    display: flex;
}
#check7:checked ~ .photo-gallery .u12 {
    display: flex;
}
#check8:checked ~ .photo-gallery .ostalo {
    display: flex;
}
.pic img{
    width: 100%;
    height: 200px;
    border-radius: 10px;
    display: block;
}
.pic p{
    margin-top: 10px;
    text-align: center;
    word-break: break-word;
    font-size: 1rem;
    flex-shrink: 0;
}
.pic:hover{
    transform: scale(1.1);
    transition: all .5s;
}
.lightbox {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.lightbox.open { 
    display: flex; 
}
.lightbox img {
    max-width: 90%;
    max-height: 80%;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.5);
}
.lightbox .nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    color: white;
    cursor: pointer;
    padding: 10px;
    user-select: none;
}
.lightbox .nav.left { 
    left: 20px; 
}
.lightbox .nav.right { 
    right: 20px; 
}
.lightbox .close {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    color: white;
    cursor: pointer;
}
.admin-controls {
    position: relative;
    margin-top: 40px;
    display: flex;
    gap: 10px;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.admin-controls button {
    padding: 8px 15px;
    background-color: #f7941d;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

form#addForm,
form#deleteForm {
    margin-top: 20px;
    padding: 15px;
    background-color: #eee;
    border-radius: 8px;
}

@media (max-width: 768px) {
    form#addForm,
    form#deleteForm {
        padding: 20px;
        margin-top: 15px;
    }
}

#deleteForm label {
    color: black;
    margin-left: 8px;
}

#deleteForm input[type="checkbox"] {
    transform: scale(1.2);
    margin-right: 5px;
}

#deleteArea div {
    margin-bottom: 8px;
}


#deleteArea {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 15px;
}

#deleteArea div {
    transition: background-color 0.2s;
}

#deleteArea div:hover {
    background-color: #f0f0f0 !important;
}

#deleteArea label {
    width: 100%;
    margin: 0;
    padding: 0;
}

#deleteArea img {
    border: 2px solid #ddd;
}

#deleteArea input[type="checkbox"]:checked + img {
    border-color: #f7941d;
}


form input[type="file"],
form input[type="text"],
form select {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}
.pic {
    position: relative;
    width: 100%;
    max-width: 270px;
    border-radius: 10px;
    box-shadow: 2px 2px 4px lightgray;
    opacity: 1;
    transform: scale(1);
    transition: .5s;
    display: flex;
    flex-direction: column;
    align-items: stretch;
}
</style>
<body>
    <div class="glavni_del">
    <input style="display: none;" type="radio" name="photos" id="check1" checked>
    <input style="display: none;" type="radio" name="photos" id="check2">
    <input style="display: none;" type="radio" name="photos" id="check3">  
    <input style="display: none;" type="radio" name="photos" id="check4">
    <input style="display: none;" type="radio" name="photos" id="check5">
    <input style="display: none;" type="radio" name="photos" id="check6">
    <input style="display: none;" type="radio" name="photos" id="check7">
    <input style="display: none;" type="radio" name="photos" id="check8">

    <div class="slike">
    <h1>Galerija</h1>
</div>
    <div class="top-content">
        <h3>Izberi kategorijo:</h3>
        <label for="check1">Vse slike</label>
        <label for="check2">Člani</label>
        <label for="check3">U20</label>
        <label for="check4">U18</label>
        <label for="check5">U16</label>
        <label for="check6">U14</label>
        <label for="check7">U12</label>
        <label for="check8">OSTALO</label>
    </div>

   <div class="photo-gallery">
<?php

    try {

        $stmt = $pdo->query("SHOW TABLES LIKE 'galerija'");
        if ($stmt->rowCount() == 0) {
            echo '<p>Napaka: Tabela "galerija" ne obstaja v bazi podatkov.</p>';
            echo '<p>Ustvarite tabelo z naslednjo strukturo:</p>';
            echo '<pre>CREATE TABLE galerija (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slika_url VARCHAR(255) NOT NULL,
    opis TEXT,
    kategorija VARCHAR(50) DEFAULT "ostalo"
);</pre>';
        } else {
            $stmt = $pdo->query("SELECT * FROM galerija ORDER BY id DESC");
            $slike = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($slike)) {
                echo '<p>Galerija je prazna. Dodajte prvo sliko z gumbom "Dodaj sliko".</p>';
            } else {
                
                foreach ($slike as $row) {
                    $id = isset($row['id']) ? $row['id'] : 0;
                    $kategorija = isset($row['kategorija']) ? $row['kategorija'] : 'ostalo';
                    $opis = isset($row['opis']) ? $row['opis'] : '';
                    $slika = isset($row['slika_url']) ? $row['slika_url'] : 'slike/default.jpg';

                    echo '<div class="pic ' . htmlspecialchars($kategorija) . '" data-id="' . $id . '">';
                    echo '<img src="' . htmlspecialchars($slika) . '" alt="Slika">';
                    echo '<p>' . htmlspecialchars($opis) . '</p>';
                    echo '</div>';
                }
            }
        }
    } catch (PDOException $e) {
        echo '<p>Napaka pri nalaganju galerije: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
</div>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
    <div class="admin-controls">
        <button id="showAddForm">➕ Dodaj sliko</button>
        <button id="enableDelete">🗑️ Izbriši slike</button>
        <a href="?odjava=1" class="admin-btn" style="background: #6c757d; text-decoration: none; color: white; padding: 8px 15px; border-radius: 5px;">🚪 Odjava</a>
    </div>
    <?php else: ?>
    <div class="admin-controls" style="text-align: center; padding: 15px;">
        <p style="margin: 0; color: #666;"></p>
    </div>
    <?php endif; ?>


<form id="addForm" method="POST" action="dodaj_sliko.php" enctype="multipart/form-data" style="display: none; color: black;">
    <label style="color:black;">Izberi sliko:</label>
    <input type="file" name="slika" required><br>
    <label style="color:black;">Opis slike:</label>
    <input type="text" name="opis" required><br>
    <label style="color:black;">Kategorija:</label>
    <select name="kategorija" required>
        <option value="clani">Člani</option>
        <option value="u20">U20</option>
        <option value="u18">U18</option>
        <option value="u16">U16</option>
        <option value="u14">U14</option>
        <option value="u12">U12</option>
        <option value="ostalo">Ostalo</option>
    </select><br>
    <button style="padding: 8px 15px;
    background-color: #f7941d;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;" type="submit">✅ Dodaj</button>
</form>


<form id="deleteForm" method="POST" action="izbrisi_slike.php" style="display: none;">
    <div id="deleteArea">
        <?php

        if (isset($slike) && !empty($slike)) {
            foreach ($slike as $row) {
                $id = isset($row['id']) ? $row['id'] : 0;
                $opis = isset($row['opis']) ? $row['opis'] : '';
                $slika = isset($row['slika_url']) ? $row['slika_url'] : '';
                
                echo '<div style="margin: 10px 0; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">';
                echo '<label style="display: flex; align-items: center; cursor: pointer;">';
                echo '<input type="checkbox" name="delete_ids[]" value="' . $id . '" style="margin-right: 10px; transform: scale(1.2);">';
                echo '<img src="' . htmlspecialchars($slika) . '" alt="Slika" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 5px;">';
                echo '<span style="color: black;">' . htmlspecialchars($opis) . '</span>';
                echo '</label>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <button style="padding: 8px 15px;
    background-color: #f7941d;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;" type="submit">🗑️ Potrdi izbris</button>
</form>
</div>
    </div>
    </div>
<div class="lightbox" id="lightbox">
    <span class="close" id="lbClose">&times;</span>
    <span class="nav left" id="lbPrev">&#10094;</span>
    <img id="lbImg" src="" alt="">
    <span class="nav right" id="lbNext">&#10095;</span>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const allPics = Array.from(document.querySelectorAll('.pic img'));
    const lightbox = document.getElementById('lightbox');
    const lbImg = document.getElementById('lbImg');
    const lbClose = document.getElementById('lbClose');
    const lbPrev = document.getElementById('lbPrev');
    const lbNext = document.getElementById('lbNext');

    let currentIndex = 0;
    let currentSet = [];

    function updateCurrentSet() {
        currentSet = Array.from(document.querySelectorAll('.pic'))
            .filter(pic => window.getComputedStyle(pic).display !== 'none')
            .map(pic => pic.querySelector('img'));
    }

    function openLightbox(index) {
        updateCurrentSet();
        currentIndex = index;
        lbImg.src = currentSet[index].src;
        lightbox.classList.add('open');
    }

    function closeLightbox() {
        lightbox.classList.remove('open');
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % currentSet.length;
        lbImg.src = currentSet[currentIndex].src;
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + currentSet.length) % currentSet.length;
        lbImg.src = currentSet[currentIndex].src;
    }

    allPics.forEach(img => {
        img.addEventListener('click', () => {
            updateCurrentSet();
            const idx = currentSet.indexOf(img);
            if (idx !== -1) openLightbox(idx);
        });
    });

    if (lbClose) lbClose.addEventListener('click', closeLightbox);
    if (lbNext) lbNext.addEventListener('click', showNext);
    if (lbPrev) lbPrev.addEventListener('click', showPrev);

    document.addEventListener('keydown', (e) => {
        if (!lightbox || !lightbox.classList.contains('open')) return;
        if (e.key === 'ArrowRight') showNext();
        if (e.key === 'ArrowLeft') showPrev();
        if (e.key === 'Escape') closeLightbox();
    });

    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const showAddBtn = document.getElementById('showAddForm');
    const enableDeleteBtn = document.getElementById('enableDelete');
    const addForm = document.getElementById('addForm');
    const deleteForm = document.getElementById('deleteForm');
    const deleteArea = document.getElementById('deleteArea');

    if (showAddBtn && addForm) {
        showAddBtn.addEventListener('click', () => {
            addForm.style.display = addForm.style.display === 'none' ? 'block' : 'none';
        });
    }

    if (enableDeleteBtn && deleteForm) {
        enableDeleteBtn.addEventListener('click', () => {
            deleteForm.style.display = deleteForm.style.display === 'none' ? 'block' : 'none';
        });
    }
});
</script>

</body>
<?php
    include 'noga.php';
?>
</html>
            