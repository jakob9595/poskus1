# KK Vojnik - Galerija

## Opis
Galerija za košarkarski klub Vojnik z možnostjo dodajanja, brisanja in filtriranja slik po kategorijah.

## Nastavitev

### 1. Baza podatkov
- Ustvarite bazo podatkov `KKVojnik` v MySQL/phpMyAdmin
- Zaženite SQL skripto `ustvari_tabelo_galerija.sql` za ustvarjanje potrebne tabele

### 2. Struktura map
```
KKVojnik/
├── slike/           # Map za shranjevanje slik
├── galerija.php     # Glavna stran galerije
├── dodaj_sliko.php  # Skripta za dodajanje slik
├── izbrisi_slike.php # Skripta za brisanje slik
├── glava.php        # Header z navigacijo
└── noga.php         # Footer
```

### 3. Funkcionalnosti
- **Prikaz slik**: Vse slike se prikažejo v grid layoutu
- **Filtriranje**: Radio buttoni za filtriranje po kategorijah (Člani, U20, U18, U16, U14, U12, Ostalo)
- **Dodajanje slik**: Formular za dodajanje novih slik z opisom in kategorijo
- **Brisanje slik**: Možnost brisanja izbranih slik
- **Lightbox**: Klik na sliko odpre lightbox z navigacijo

### 4. Kategorije slik
- `clani` - Člani kluba
- `u20` - U20 selekcija
- `u18` - U18 selekcija
- `u16` - U16 selekcija
- `u14` - U14 selekcija
- `u12` - U12 selekcija
- `ostalo` - Ostale slike

### 5. Reševanje težav

#### Galerija se ne prikaže
1. Preverite, ali tabela `galerija` obstaja v bazi podatkov
2. Preverite, ali so PDO povezave pravilno nastavljene
3. Preverite konzolo brskalnika za JavaScript napake

#### Slike se ne naložijo
1. Preverite, ali ima map `slike/` pravilne dovoljenja za pisanje
2. Preverite, ali je velikost datoteke manjša od PHP limita (`upload_max_filesize` v php.ini)

#### CSS ne deluje
1. Preverite, ali so CSS selektorji pravilno nastavljeni
2. Preverite, ali se CSS datoteka `css.css` pravilno naloži

## Tehnologije
- PHP 7.4+
- MySQL 5.7+
- HTML5
- CSS3
- JavaScript (ES6+)

## Avtor
KK Vojnik - Košarkarski klub Vojnik
