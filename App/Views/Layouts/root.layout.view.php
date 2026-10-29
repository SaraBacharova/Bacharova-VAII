<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Čitateľský denník</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $link->asset('favicons/logo.svg') ?>">
    <link rel="stylesheet" href="<?= $link->asset('css/styl.css') ?>">
</head>
<body>
<header>
    <a href="<?= $link->url('home.index') ?>">
        <img src="<?= $link->asset('images/logo.svg') ?>" alt="Logo Čitateľského denníka" width="40" height="40">
    </a>

    <h2>Čitateľský denník</h2>

    <nav>
        <a href="#">Katalóg</a>
    </nav>

    <form class="search" action="#">
        <input type="search" placeholder="Vyhľadávanie" aria-label="Vyhľadávanie">
        <button type="submit">Hľadať</button>
    </form>

    <a href="<?= $link->url('diary.index') ?>" class="login">Prihlásiť</a>
</header>

<main>
    <?= $contentHTML ?>
</main>

<footer>
    <p>© Čitateľský denník</p>
</footer>
</body>
</html>