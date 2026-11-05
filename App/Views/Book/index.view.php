<?php

/** @var \App\Models\Book[] $books */
/** @var \Framework\Support\LinkGenerator $link */
?>
    <h1>Katalóg kníh</h1>

    <p><a href="<?= $link->url('book.add') ?>" class="btn">Pridať knihu</a></p>

<?php if (count($books) === 0) { ?>
    <p>V katalógu zatiaľ nie sú žiadne knihy.</p>
<?php } else { ?>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Názov</th>
                <th>Autor</th>
                <th>Rok</th>
                <th>Strán</th>
                <th>Popis</th>
                <th>Akcie</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td><?= e($book->getTitle()) ?></td>
                    <td><?= e($book->getAuthor()) ?></td>
                    <td><?= $book->getYear() ?></td>
                    <td><?= $book->getPages() ?></td>
                    <td><?= e($book->getDescription()) ?></td>
                    <td class="actions">
                        <a href="<?= $link->url('book.edit', ['id' => $book->getId()]) ?>" class="btn">Upraviť</a>
                        <form method="post" action="<?= $link->url('book.delete') ?>">
                            <input type="hidden" name="id" value="<?= $book->getId() ?>">
                            <button type="submit">Zmazať</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>