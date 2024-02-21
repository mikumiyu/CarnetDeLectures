

<section class="presentation" id="bookSection" data-book-id="<?= $_GET['id']; ?>">

    <h2><?= $book['title'] ?></h2>
    <div class="hr"></div>
    <p class="author"><?= $book['authorName'] ?></p>
    <p class="category"><?= $book['categoryName'] ?></p>
    <img src="./assets/image/upload/<?= $book['image'] ?>" alt="couverture du livre">
    <p class="desc"><?= $book['description'] ?></p>

</section>

<section class="comment-section">
    <h3>Commentaires</h3>
    <div id="comments"></div>
    <?php if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?> 
        <a href="http://localhost/Projet%20final/backend/index.php?action=loginPage">Connectez vous pour partager votre avis</a>
    <?php elseif(isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>

        

        <form action="http://localhost/Projet%20final/backend/index.php?action=commentAjax">
            <label for="newCommentContent">Laisser un commentaire :</label>
            <input type="text" name="newCommentContent" id="newCommentContent">
            <input type="submit" value="Envoyer" id="submitCommentFormBtn">
        </form>

    <?php endif; ?>

</section>

