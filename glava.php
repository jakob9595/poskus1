<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$adminGeslo = 'skrivnogeslo123';

if (isset($_GET['admin']) && $_GET['admin'] === $adminGeslo) {
    $_SESSION['admin'] = true;
}

if (isset($_GET['odjava'])) {
    unset($_SESSION['admin']);
    session_destroy();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

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
} catch (PDOException $e) {
    die("Povezava z bazo ni uspela: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css.css">
    <title>KKVOJNIK</title>
    <style>
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    width: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background:	#e4e4e4ff;
}

.navbar {
    width: 100%; 
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 1rem;
    background: #005B8F;
    min-height: 120px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    flex-wrap: wrap;
    font-size: 1.25em;
    margin: 0;
}

.navbar-left .club-name {
    font-size: 1.6em;
    font-weight: bold;
    letter-spacing: 2px;
    color: white;
}

.navbar-center {
    flex: 1;
    display: flex;
    justify-content: center;
}

.nav-menu {
    list-style: none;
    display: flex;
    gap: 30px;
    margin: 0;
    padding: 0;
    flex-wrap: wrap;
}

.nav-menu li {
    position: relative;
}

.nav-menu li a {
    text-decoration: none;
    color: white;
    font-size: 1.1em;
    font-weight: 500;
    transition: color 0.2s;
    display: block;
    padding: 8px 0;
}

.nav-menu li a:hover {
    color: #F7941D;
    transition: color 0.4s;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: rgb(20, 99, 145);
    box-shadow: 0 100px 150px rgba(0,0,0,0.08);
    list-style: none;
    padding: 0;
    margin: 0;
    min-width: 190px;
    z-index: 100;
}

.dropdown-menu li a {
    display: block;
    padding: 10px 20px;
    color: white;
    font-size: 1em;
    font-weight: 400;
    white-space: nowrap;
}

.dropdown-menu li a:hover {
    background: #F7941D;
    color: #fff;
    font-size: 1.05em;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.navbar-right {
    width: 120px;
    text-align: center;
}

#kontakt-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0; top: 0;
    width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
}
#kontakt-modal.active {
    display: flex;
}
.kontakt-content {
    background: #fff;
    padding: 2rem 1.2rem;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    min-width: 260px;
    max-width: 550px;
    min-height: 620px;
    position: relative;
    text-align: center;
}
.kontakt-content h2 {
    margin-bottom: 1rem;
    color: #005B8F;
}
.kontakt-content input,
.kontakt-content textarea {
    width: 100%;
    padding: 0.6em;
    margin-bottom: 1em;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1em;
}
.kontakt-content button {
    background: #005B8F;
    color: #fff;
    border: none;
    padding: 0.7em 2em;
    border-radius: 6px;
    font-size: 1em;
    cursor: pointer;
    margin-right: 0.5em;
}
.kontakt-content button:hover {
    background: #F7941D;
}
.kontakt-close {
    position: absolute;
    top: 10px; right: 15px;
    font-size: 1.5em;
    color: #888;
    background: none;
    border: none;
    cursor: pointer;
}
.kontakt-success {
    color: green;
    margin-bottom: 1rem;
}

@media (max-width: 900px) {
    .nav-menu {
        gap: 18px;
    }
    .navbar-left .club-name img {
        height: 80px;
    }
    .navbar {
        min-height: 80px;
    }
    .navbar-right {
        width: 80px;
        text-align: center;
    }
}

@media (max-width: 700px) {
    .navbar {
        flex-direction: column;
        align-items: stretch;
        min-height: unset;
        position: relative;
    }
    .navbar-left,
    .navbar-center,
    .navbar-right {
        width: 100%;
        justify-content: center;
        display: flex;
        text-align: center;
    }
    .navbar-center {
        margin-top: 10px;
    }
    .nav-menu {
        flex-direction: column;
        gap: 0;
        align-items: center;
        display: none;
    }
    .nav-menu.active {
        display: flex;
        animation: slideDown 0.3s ease-in-out;
    }
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .nav-menu li {
        width: 100%;
        text-align: center;
    }
    .dropdown-menu {
        position: static;
        box-shadow: none;
        min-width: unset;
    }
    .dropdown:hover .dropdown-menu,
    .dropdown:focus-within .dropdown-menu {
        display: block;
    }
    
    .hamburger {
        display: block;
        cursor: pointer;
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        padding: 10px;
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }
    
    .hamburger:focus {
        outline: none;
    }
    
    .hamburger:hover {
        color: #F7941D;
    }
}

@media (min-width: 701px) {
    .hamburger {
        display: none;
    }
}

@media (max-width: 500px) {
    .navbar-left .club-name img {
        height: 50px;
    }
    .navbar-right {
        width: 100%;
    }
    .nav-menu li a {
        font-size: 1em;
    }
    .kontakt-content {
        padding: 1rem 0.5rem;
        min-width: unset;
    }
}

    </style>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="navbar-left">
            <span class="club-name"><img src="slike/logo.png" alt="KK Vojnik" height="120px"></span>
        </div>
        <button class="hamburger" id="hamburger" aria-label="Menu">☰</button>
        <div class="navbar-center">
            <ul class="nav-menu" id="nav-menu">
                <li><a href="index.php">O NAS</a></li>
                <li><a href="galerija.php">GALERIJA</a></li>                
                <li class="dropdown">
                    <a href="selekcije.php">SELEKCIJE</a>
                    <ul class="dropdown-menu">
                        <li><a href="clani.php">Člani</a></li>
                        <li><a href="u20.php">U20</a></li>
                        <li><a href="u18.php">U18</a></li>
                        <li><a href="u16.php">U16</a></li>
                        <li><a href="u14.php">U14</a></li>
                        <li><a href="u12.php">U12</a></li>
                        <li><a href="u10.php">U10</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="ostalo.php">OSTALO</a>
                    <ul class="dropdown-menu">
                        <li><a href="novice.php">NOVICE</a></li>
                        <li><a href="dogodki.php">DOGODKI</a></li>
                        <li><a href="trenerji.php">VODSTVO KLUBA</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <a href="#" id="kontakt-btn" style="color: white;text-decoration: none;">KONTAKT</a>
        </div>
    </nav>
</header>

<div id="kontakt-modal">
    <div class="kontakt-content">
        <button class="kontakt-close" title="Zapri" onclick="closeKontaktModal()">&times;</button>
        <h2>KONTAKT</h2>
        <div id="kontakt-success" class="kontakt-success" style="display:none;"></div>
        <form action="https://api.web3forms.com/submit" method="POST" id="kontakt-form" autocomplete="off">
            <input type="hidden" name="access_key" value="5ed56d32-3034-4fe5-a50d-d82f2db58188">
            <input type="text" name="ime" placeholder="Vaše ime" required>
            <input type="email" name="email" placeholder="Vaš e-poštni naslov" required>
            <input type="tel" name="telefon" placeholder="Vaša telefonska številka" required>
            <input type="text" name="zadeva" placeholder="Zadeva" required>
            <textarea name="sporocilo" rows="5" placeholder="Vaše sporočilo" required></textarea>
            <button type="submit">Pošlji</button>
            <button type="button" onclick="closeKontaktModal()">Prekliči</button>
        </form>
    </div>
</div>

<script>
function openKontaktModal() {
    document.getElementById('kontakt-modal').classList.add('active');
}
function closeKontaktModal() {
    document.getElementById('kontakt-modal').classList.remove('active');
    document.getElementById('kontakt-success').style.display = 'none';
    document.getElementById('kontakt-form').reset();
}

function toggleMenu() {
    const navMenu = document.getElementById('nav-menu');
    navMenu.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function() {
    const kontaktBtn = document.getElementById('kontakt-btn');
    const hamburger = document.getElementById('hamburger');
    
    if (kontaktBtn) {
        kontaktBtn.addEventListener('click', function(e){
            e.preventDefault();
            openKontaktModal();
        });
    }
    
    if (hamburger) {
        hamburger.addEventListener('click', toggleMenu);
    }
    
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            const navMenu = document.getElementById('nav-menu');
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
            }
        });
    });
});

if (window.location.hash === "#success") {
    openKontaktModal();
    document.getElementById('kontakt-success').innerText = "Sporočilo je bilo poslano!";
    document.getElementById('kontakt-success').style.display = 'block';
    setTimeout(closeKontaktModal, 2500);
}
</script>
