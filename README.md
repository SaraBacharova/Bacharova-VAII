# Čitateľský denník

Sára Bachárová

5ZYI35

## Stručný opis projektu
Čitateľský denník je webová aplikácia pre ľudí, ktorí chcú mať prehľad o knihách, ktoré prečítali, práve čítajú alebo si chcú prečítať.

Aplikácia ponúka katalóg kníh, ktorý spravujú moderátori, a k nemu osobný denník každého používateľa. Používateľ si knihy zaraďuje do zoznamov (chcem čítať, čítam, prečítané), pridáva im hodnotenie a súkromné poznámky a tiež sleduje štatistiku svojho čítania. Pri každej knihe v katalógu môžu používatelia pridávať verejné komentáre a vidieť priemerné hodnotenie. Používatelia môžu tiež navrhovať nové knihy, ktoré schvaľuje moderátor.

## Role v projekte
Návštevník: Prezerá katalóg kníh, detaily kníh, priemerné hodnotenia a verejné komentáre. Nemôže vytvárať obsah. Môže sa zaregistrovať a prihlásiť.

Čitateľ: Vedie si vlastný súkromný denník (zoznamy, hodnotenia, poznámky), pridáva a spravuje vlastné komentáre ku knihám, navrhuje nové knihy, upravuje profil a avatar, vidí svoju štatistiku.

Moderátor: Má práva čitateľa. Navyše spravuje katalóg: schvaľuje alebo zamieta navrhnuté knihy, upravuje a maže knihy, autorov kníh a žánre, maže nevhodné komentáre. Nemá prístup k správe používateľov.

Admin: Má práva moderátora. Navyše spravuje používateľov: mení im roly, blokuje alebo maže účty.

## Prípady použitia podľa rolí
Návštevník:
    prezrie si katalóg kníh,
    vyhľadá knihu podľa názvu, autora alebo žánru,
    zobrazí detail knihy s priemerným hodnotením a komentármi,
    zaregistruje/prihlási sa do systému.

Čitateľ:
    pridá knihu do svojho denníka a zaradí ju do zoznamu (chcem čítať/čítam/prečítané),
    zmení stav knihy v denníku,
    ohodnotí knihu hviezdičkami,
    napíše si ku knihe súkromnú poznámku,
    odstráni knihu zo svojho denníka,
    pridá, upraví alebo zmaže vlastný komentár pod knihou,
    navrhne novú knihu,
    zobrazí si svoju štatistiku čítania,
    upraví svoj profil a nahrá avatar.

Moderátor:
    schváli alebo zamietne navrhnutú knihu,
    vytvorí, upraví alebo zmaže knihu v katalógu,
    pridá, upraví alebo zmaže autora knihy/žáner,
    zmaže nevhodné komentáre.

Admin:
    zobrazí zoznam používateľov,
    zmení používateľovi rolu,
    zablokuje alebo zmaže používateľa,
    zobrazí základné štatistiky aplikácie (počet používateľov, kníh, komentárov).

## Plánované entity
users 
    účel: uchováva údaje o všetkých registrovaných osobách. 
    atribúty: id, name, email (UNIQUE), password_hash, role, avatar_path, created_at. vzťahy: users 1:N diary_entries, 
            users 1:N comments, 
            users 1:N books (navrhnuté knihy)

authors
    účel: autori kníh v katalógu. 
    atribúty: id, name, bio.
    vzťahy: authors 1:N books

genres
    účel: zaradenie kníh do žánrov. 
    atribúty: id, name (UNIQUE). 
    vzťahy: books M:N genres (cez book_genres).

books 
    účel: centrálna entita katalógu. 
    atribúty: id, title, author_id, description, year, pages, cover_path, status, created_by, created_at. 
    vzťahy: authors 1:N books, 
            books M:N genres, 
            books 1:N comments, 
            books 1:N diary_entries, 
            users 1:N books

book_genres (asociačná tabuľka) 
    účel: realizuje vzťah M:N medzi knihami a žánrami. 
    atribúty: book_id, genre_id (PFK).

diary_entries 
    účel: osobný záznam používateľa o knihe.
    atribúty: id, user_id, book_id, status, rating, private_note, started_at, finished_at. Dvojica user_id + book_id je UNIQUE. 
    vzťahy: users 1:N diary_entries, 
            books 1:N diary_entries

comments 
    účel: verejné komentáre pod knihami. 
    atribúty: id, book_id, user_id, text, created_at. 
    vzťahy: books 1:N comments, 
            users 1:N comments

## Vzťahy medzi entitami
authors 1:N books: jeden autor má viac kníh
books M:N genres: realizované cez asociačnú tabuľku book_genres
users M:N books (denník): realizované cez diary_entries
books 1:N comments: jedna kniha má viac komentárov
users 1:N comments: jeden používateľ napíše viac komentárov
users 1:N books (navrhol): jeden používateľ navrhne viac kníh

## Hlavné stránky aplikácie
Domovská stránka: predstavenie aplikácie, najnovšie a najlepšie hodnotené knihy, vyhľadávanie.
Registrácia a prihlásenie: vytvorenie účtu a autentifikácia.
Katalóg kníh: zoznam schválených kníh s filtrovaním podľa žánru a autora, vyhľadávaním a stránkovaním, formulár na návrh novej knihy vrátane uploadu obálky.
Detail knihy: obálka, popis, autor, žánre, priemerné hodnotenie, komentáre, tlačidlo na pridanie do denníka.
Môj denník: knihy rozdelené do zoznamov (chcem čítať / čítam / prečítané), zmena stavu, hodnotenie a súkromná poznámka.
Štatistika čítania: počet prečítaných kníh, rozdelenie podľa rokov a žánrov.
Správa katalógu (moderátor): schvaľovanie návrhov kníh, správa kníh, autorov a žánrov, moderovanie komentárov.
Administrátorský panel (admin): správa používateľov a rolí, základné štatistiky aplikácie.

## Rozdelenie funkcionality
Základné funkcie:
- registrácia, prihlásenie, odhlásenie, hashovanie hesiel, autorizácia podľa rolí,
- katalóg kníh s vyhľadávaním, filtrovaním a stránkovaním,
- plné CRUD nad knihami (moderátor) a komentármi (čitateľ, moderátor),
- upload a zobrazenie obálok kníh s validáciou typu a veľkosti,
- denník: pridanie knihy, zmena stavu, hodnotenie, súkromná poznámka, odobratie,
- návrh knihy čitateľom a jej schválenie moderátorom,
- štatistika čítania z dát denníka,
- správa používateľov a rolí (admin),
- AJAX: zmena stavu knihy a hodnotenie v denníku, pridávanie a mazanie komentárov, filtrovanie katalógu,
- validácia vstupov na klientovi aj serveri, prepared statements,
- responzívny dizajn a import ukážkových dát pri prvom spustení v Dockeri.

Rozširujúce funkcie
- ročný čitateľský cieľ s ukazovateľom pokroku,
- grafy v štatistike (podľa žánrov a mesiacov),
- profil používateľa s avatarom a zmenou hesla,
- tmavý režim.