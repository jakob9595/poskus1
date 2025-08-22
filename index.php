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
    transition: all 0.3s;
}

.glavni_naslov {
    max-width: 95vw;
    width: 100%;
    margin: 35px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    box-sizing: border-box;
}

.glavna_vsebina {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    position: relative;
    gap: 40px;
}

.slike_desno {
    position: relative;
    min-width: 260px;
    width: 320px;
    height: 420px;
    margin-left: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-start;
}

.slike_desno img {
    width: 220px;
    height: 300px;
    object-fit: cover;
    border-radius: 18px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    position: absolute;
    transition: all 0.3s;
}

.slike_desno img:first-child {
    top: -105px;
    right: 200px;
    z-index: 2;
    height: 500px;    
    width: 270px;      
}

.slike_desno img:last-child {
    top: 310px;
    right: 340px;
    z-index: 1;
    opacity: 0.93;
    height: 300px;
    width: 220px;
}

.naslov {
    text-align: center;
    font-size: 3em;
    font-weight: bold;
    color: black;
    margin-bottom: 10px;
    letter-spacing: 2px;
    background: linear-gradient(90deg, #222 0%, #FFA500 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

p {
    line-height: 1.6;
    font-size: 1.1rem;
}

h2 {
    margin-top: 2rem;
    font-size: 1.6rem;
}

.sponzorji-wrapper {
    width: 100%;
    overflow: hidden; 
    background: transparent;
}

.sponzorji-track {
    display: flex;
    animation: premik 20s linear infinite; 
}

.kontakti-ureditev1 {
    flex: 0 0 auto;
    margin: 0 50px;
    background: rgba(255,255,255,0.07);
    border-radius: 8px;
    padding: 10px;
}

.kontakti-ureditev1 img {
    width: 150px;
    height: auto;
    object-fit: contain;
}

@keyframes premik {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-50%);
    }
}

/* Responsive design */
@media (min-width: 600px) {
    .glavni_del {
        max-width: 1500px;
    }
    .glavni_naslov {
        max-width: 1100px;
    }
}

@media (max-width: 1500px) {
    .glavna_vsebina {
        flex-direction: column;
        align-items: stretch;
    }
    .slike_desno {
        position: static;
        width: 100%;
        height: auto;
        margin: 30px auto 0 auto;
        flex-direction: row;
        justify-content: center;
        min-width: 0;
        gap: 20px;
    }
    .slike_desno img {
        position: static;
        width: 48vw;
        max-width: 220px;
        height: 180px;
        margin: 0 10px;
        opacity: 1;
    }
}

@media (max-width: 1200px) {
    .glavni_del,
    .glavni_naslov {
        margin-left: auto !important;
        margin-right: auto !important;
        max-width: 98vw !important;
    }
    .glavni_del {
        margin-top: 25px !important;
    }
}

@media (max-width: 768px) {
    .glavni_del,
    .glavni_naslov {
        padding: 20px;
        margin: 20px auto !important;
        max-width: 95vw !important;
    }
    
    .naslov {
        font-size: 2.2em !important;
        letter-spacing: 1px;
    }
    
    h2 {
        font-size: 1.4rem;
        margin-top: 1.5rem;
    }
    
    p {
        font-size: 1rem;
        line-height: 1.5;
    }
    
    .glavna_vsebina {
        gap: 20px;
    }
    
    .slike_desno {
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin: 20px auto 0 auto;
    }
    
    .slike_desno img {
        width: 80vw;
        max-width: 280px;
        height: 180px;
        margin: 5px;
    }
    
    .kontakti-ureditev1 {
        margin: 0 20px;
    }
    
    .kontakti-ureditev1 img {
        width: 120px;
    }
}

@media (max-width: 480px) {
    .glavni_del,
    .glavni_naslov {
        padding: 15px;
        margin: 15px auto !important;
    }
    
    .naslov {
        font-size: 1.8em !important;
    }
    
    h2 {
        font-size: 1.3rem;
    }
    
    .slike_desno img {
        width: 90vw;
        max-width: 250px;
        height: 160px;
    }
    
    .kontakti-ureditev1 {
        margin: 0 15px;
    }
    
    .kontakti-ureditev1 img {
        width: 100px;
    }
}
</style>

<div class="glavni_naslov">
    <h1 class="naslov">Dobrodošli na spletni strani KK Vojnik</h1>
</div>

<div class="glavna_vsebina">
    <div style="flex:1; min-width:320px;">
        <div class="glavni_del" style="max-width: 600px; margin-left: 200px;margin-top:10px">
            <h2>Kdo smo?</h2>
            <p>Smo klub z bogato tradicijo in jasno vizijo – razvijati domače talente, omogočati kakovostno treniranje vsem generacijam ter ustvarjati okolje, kjer šport pomeni rast in zabavo.</p>
        </div>
        <div class="glavni_del" style="max-width: 800px; margin-left: 450px;margin-top:-60px">
            <h2>Kaj ponujamo?</h2>
            <p>
                - Organizirane selekcije za otroke, mladino in člane<br>
                - Usposobljen trenerski kader<br>
                - Redna tekmovanja, turnirji in priprave<br>
                - Druženje, navdušenje in nepozabni trenutki na parketu
            </p>
        </div>
        <div class="glavni_del" style="max-width: 750px; margin-left: 300px;margin-top:-55px;">
            <h2>Pridruži se nam!</h2>
            <p>Iščeš klub, kjer boš napredoval kot igralec in kot oseba? KK Vojnik je pravo mesto zate.<br>
            Obišči naše treninge, spremljaj novice ali stopi v stik z nami – vedno smo odprti za nove člane in podpornike!</p>
        </div>
        <div class="glavni_del" style="max-width: 1700px; margin-left: 150px;">
            <h2>Naši sponzorji</h2>
            <p>Hvala vsem našim sponzorjem, ki podpirajo KK Vojnik in omogočajo razvoj mladih talentov.</p>

            <div class="sponzorji-wrapper">
                <div class="sponzorji-track">
                    <div class="kontakti-ureditev1">
                        <a href="https://pizzerijalimbo.si/"><img src="slike/limbo.jpg" alt="Pizzeria Limbo"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://www.harveynorman.si/"><img src="slike/harvey norman.png" alt="Harvey Norman"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://gradbena-trgovina.si/"><img src="slike/g7.png" alt="G7"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://stagoj.si/"><img src="slike/stagoj.png" alt="Stagoj"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.spotgradnje.com/"><img src="slike/spot.png" alt="Spot gradnje"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.emo-frite.si/"><img src="slike/emo.png" alt="Emo frite"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://pizzerijalimbo.si/"><img src="slike/limbo.jpg" alt="Pizzeria Limbo"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://www.harveynorman.si/"><img src="slike/harvey norman.png" alt="Harvey Norman"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://gradbena-trgovina.si/"><img src="slike/g7.png" alt="G7"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://stagoj.si/"><img src="slike/stagoj.png" alt="Stagoj"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.spotgradnje.com/"><img src="slike/spot.png" alt="Spot gradnje"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.emo-frite.si/"><img src="slike/emo.png" alt="Emo frite"></a>
                    </div>
                     <div class="kontakti-ureditev1">
                        <a href="https://pizzerijalimbo.si/"><img src="slike/limbo.jpg" alt="Pizzeria Limbo"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://www.harveynorman.si/"><img src="slike/harvey norman.png" alt="Harvey Norman"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://gradbena-trgovina.si/"><img src="slike/g7.png" alt="G7"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://stagoj.si/"><img src="slike/stagoj.png" alt="Stagoj"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.spotgradnje.com/"><img src="slike/spot.png" alt="Spot gradnje"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.emo-frite.si/"><img src="slike/emo.png" alt="Emo frite"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://pizzerijalimbo.si/"><img src="slike/limbo.jpg" alt="Pizzeria Limbo"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://www.harveynorman.si/"><img src="slike/harvey norman.png" alt="Harvey Norman"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://gradbena-trgovina.si/"><img src="slike/g7.png" alt="G7"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="https://stagoj.si/"><img src="slike/stagoj.png" alt="Stagoj"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.spotgradnje.com/"><img src="slike/spot.png" alt="Spot gradnje"></a>
                    </div>
                    <div class="kontakti-ureditev1">
                        <a href="http://www.emo-frite.si/"><img src="slike/emo.png" alt="Emo frite"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slike_desno">
        <img src="slike/slika1.jpg" alt="KK Vojnik 1">
        <img src="slike/logo.png" alt="KK Vojnik 2">
    </div>
</div>

<?php
    include 'noga.php';
?>