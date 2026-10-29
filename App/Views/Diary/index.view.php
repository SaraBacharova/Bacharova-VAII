<?php

$books = [
    ['title' => "A Good Girl's Guide to Murder", 'author' => 'Holly Jackson', 'rating' => 0],
    ['title' => 'Good Girl, Bad Blood',          'author' => 'Holly Jackson', 'rating' => 2],
    ['title' => 'As Good As Dead',               'author' => 'Holly Jackson', 'rating' => 4],
    ['title' => "A Good Girl's Guide to Murder", 'author' => 'Holly Jackson', 'rating' => 0],
    ['title' => 'Good Girl, Bad Blood',          'author' => 'Holly Jackson', 'rating' => 2],
    ['title' => 'As Good As Dead',               'author' => 'Holly Jackson', 'rating' => 4],
];
$statuses = ['Chcem čítať', 'Čítam', 'Prečítané'];
?>
<h1>Môj denník</h1>

<nav class="tabs" aria-label="Zoznamy denníka">
    <a href="#">Chcem čítať</a>
    <a href="#" class="active">Čítam</a>
    <a href="#">Prečítané</a>
</nav>

<section class="book-list">
    <?php foreach ($books as $i => $book) { ?>
        <article class="book">
            <div class="cover">Obálka<?= $i + 1 ?></div>

            <div class="book-info">
                <h2><?= e($book['title']) ?></h2>
                <p><?= e($book['author']) ?></p>
            </div>

            <select aria-label="Stav knihy">
                <?php foreach ($statuses as $status) { ?>
                    <option<?= $status === 'Čítam' ? ' selected' : '' ?>><?= e($status) ?></option>
                <?php } ?>
            </select>

            <p class="rating"><?= str_repeat('★', $book['rating']) . str_repeat('☆', 5 - $book['rating']) ?></p>

            <textarea placeholder="Súkromná poznámka..." aria-label="Súkromná poznámka"></textarea>

            <button type="button">Odstrániť</button>
        </article>
    <?php } ?>
</section>