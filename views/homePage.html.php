

<section class="top-banner">
    <a href="index.php?action=articlePage&id=<?= urlencode($randomBook['book_id']) ?>">
    <img src="./assets/image/upload/<?= $randomBook['image'] ?>" alt="couverture du livre">
    </a>
</section>

<section class="books">
    <h2>Derniers ajouts</h2>
    <?php foreach($books as $book) : ?>
        <a href="index.php?action=articlePage&id=<?= urlencode($book['book_id']) ?>" class="card-link">
            <article class="card book">
                <img src="./assets/image/upload/<?= $book['image'] ?>" alt="couverture du livre">
                <div class="card-content" >
                    <h3><?= $book['title'] ?></h3>
                    <p class="desc"><?= $book['description'] ?></p>
                </div>
                <p class="author"><?= $book['authorName'] ?></p>
            </article>
        </a>
    <?php endforeach; ?>
</section>