<?php
    include 'glava.php';
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
    
    <div class="ekipa-blok razpored-container">
        <h2>Razpored tekem</h2>
        <div class="kontakti-ureditev1">
            <img src="slike/igra.jpg" alt="Razpored tekem">
            <div class="razpored-opis">
                Spremljajte rezultate preteklih in urnik <br> 
                prihajajočih srečanj članske ekipe v <br> 
                vseh tekmovanjih.
            </div>
            <div>
                <a class="rezultati-btn" href="https://www.kzs.si/ekipa/17578?tekmovanje=582&tab=splosno">
                    REZULTATI IN SPORED
                </a>
            </div>
        </div>
    </div>
    
    <div class="ekipa-blok">
        <h2>Ekipa</h2>
        <ul class="igralci-lista">
            <?php foreach ($igralci as $igralec): ?>
                <li><?php echo htmlspecialchars($igralec); ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="trener">Trener: <?php echo htmlspecialchars($trener); ?></div>
        <div class="trener">Pomočnik trenerja: <?php echo htmlspecialchars($pomocnik); ?></div>
        <div class="trener">
            <a class="statistike-btn" href="https://www.kzs.si/ekipa/17578?tekmovanje=582&tab=seznam">
                Statistike igralcev
            </a>
        </div>
    </div>
</div>

<?php
    include 'noga.php';
?>
