<?php

/** @var \App\Models\Book $book */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */
?>
<h1><?= $book->getId() ? 'Úprava knihy' : 'Nová kniha' ?></h1>

<?php if (count($errors) > 0) { ?>
    <div class="errors">
        <?php foreach ($errors as $error) { ?>
            <p><?= e($error) ?></p>
        <?php } ?>
    </div>
<?php } ?>

<form method="post" action="<?= $link->url('book.save') ?>" class="book-form">
    <input type="hidden" name="id" value="<?= $book->getId() ?>">

    <label for="title">Názov</label>
    <input type="text" id="title" name="title" maxlength="200" required value="<?= e($book->getTitle()) ?>">

    <label for="author">Autor</label>
    <input type="text" id="author" name="author" maxlength="150" required value="<?= e($book->getAuthor()) ?>">

    <label for="year">Rok vydania</label>
    <input type="number" id="year" name="year" min="1" max="<?= date('Y') ?>" required value="<?= $book->getYear() ?>">

    <label for="pages">Počet strán</label>
    <input type="number" id="pages" name="pages" min="1" required value="<?= $book->getPages() ?>">

    <label for="description">Popis</label>
    <textarea id="description" name="description" rows="5"><?= e($book->getDescription()) ?></textarea>

    <div class="form-buttons">
        <button type="submit">Uložiť</button>
        <a href="<?= $link->url('book.index') ?>" class="btn">Späť</a>
    </div>
</form>