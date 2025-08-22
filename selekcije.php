<?php
    include 'glava.php';
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

.selekcije-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    margin-top: 40px;
}

.selekcija-kvadrat {
    width: 450px;
    height: 450px;
    perspective: 900px;
    background: none;
    border-radius: 18px;
    cursor: pointer;
}

.selekcija-inner {
    width: 100%;
    height: 100%;

    position: relative;
    border-radius: 18px;
}



.selekcija-front, .selekcija-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 18px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.1em;
    font-weight: 600;
    color: #222;
    text-align: center;
    overflow: hidden;
}

.selekcija-front {
    background: #f5f5f5;
}

.selekcija-front .kvadrat-bg {
    position: absolute;
    inset: 0;
    opacity: 0.13;
    z-index: 0;
    border-radius: 18px;
}

.selekcija-front span {
    position: relative;
    z-index: 1;
}

.selekcija-back {
    background: #fff;
    transform: rotateY(180deg);
    padding: 0;
    justify-content: center;
    align-items: center;
}

.selekcija-back img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.13);
    object-fit: cover;
}

@media (max-width: 1200px) {
    .selekcije-container {
        gap: 20px;
    }
    
    .selekcija-kvadrat {
        width: 400px;
        height: 400px;
    }
    
    .selekcija-front, .selekcija-back {
        font-size: 1.8em;
    }
}

@media (max-width: 900px) {
    .selekcija-kvadrat {
        width: 350px;
        height: 350px;
    }
    
    .selekcija-front, .selekcija-back {
        font-size: 1.6em;
    }
}

@media (max-width: 700px) {
    .glavni_del {
        padding: 20px;
        margin: 20px auto;
    }
    
    .naslov {
        font-size: 2.2em;
        margin-bottom: 20px;
    }
    
    .selekcije-container {
        gap: 15px;
        margin-top: 20px;
    }
    
    .selekcija-kvadrat {
        width: 140px;
        height: 140px;
    }
    
    .selekcija-front, .selekcija-back {
        font-size: 1.1em;
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
    
    .selekcije-container {
        gap: 10px;
    }
    
    .selekcija-kvadrat {
        width: 120px;
        height: 120px;
    }
    
    .selekcija-front, .selekcija-back {
        font-size: 1em;
    }
}
</style>

<div class="glavni_del">
    <h1 class="naslov">Selekcije</h1>
    
    <?php
    $selekcije = [
        ['ime' => 'Člani', 'link' => 'clani.php', 'barva' => '#4682B4'],
        ['ime' => 'U20', 'link' => 'u20.php', 'barva' => '#FFA500'],
        ['ime' => 'U18', 'link' => 'u18.php', 'barva' => '#4682B4'],
        ['ime' => 'U16', 'link' => 'u16.php', 'barva' => '#FFA500'],
        ['ime' => 'U14', 'link' => 'u14.php', 'barva' => '#4682B4'],
        ['ime' => 'U12', 'link' => 'u12.php', 'barva' => '#FFA500'],
    ];
    ?>
    
    <div class="selekcije-container">
        <?php foreach ($selekcije as $sel): ?>
            <a href="<?= htmlspecialchars($sel['link']) ?>" style="text-decoration:none;">
                <div class="selekcija-kvadrat">
                    <div class="selekcija-inner">
                        <div class="selekcija-front">
                            <div class="kvadrat-bg" style="background:<?= $sel['barva'] ?>"></div>
                            <span><?= htmlspecialchars($sel['ime']) ?></span>
                        </div>
                        <div class="selekcija-back">
                            <img src="<?= htmlspecialchars($sel['slika']) ?>" alt="<?= htmlspecialchars($sel['ime']) ?>">
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php
    include 'noga.php';
?>