<?php if(isset($_SESSION['admin'])): ?> 
    <section class="admin-pannel-section">

        <h2>Panneau Administrateur</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Résumé</th>
                <th>Genre</th>
                <th>Auteur</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach($books as $book) : ?>
                <tr>
                    <td><?= $book['title'] ?></td>
                    <td> <span class="overflow"><?= $book['description'] ?></span></td>
                    <td><?= $book['categoryName'] ?></td>
                    <td><?= $book['authorName'] ?></td>
                    <td><a href="http://localhost/Projet%20final/backend/index.php?action=adminPannel&modal=true&id=<?= $book['book_id'] ?>"> modifier</a></td>
                    <td><a href="http://localhost/Projet%20final/backend/index.php?action=deleteBook&id=<?= $book['book_id'] ?>"> Supprimer</a></td>
                </tr>
            <?php endforeach ;?>
            <tr>
                <td class="addBookBtn"><a href="http://localhost/Projet%20final/backend/index.php?action=adminPannel&modal=true">Ajouter un livre</a></td>
                
            </tr>
        </table>

    </section>

    <?php if(isset($_GET['modal'])) : ?>

        <section class="addbook-form-modal">
            
            <h2><?= isset($_GET['id']) ? 'Modifier un livre' : 'Ajouter un livre'; ?></h2>

            <form class="generic-form admin-form" action="index.php?action=<?= isset($_GET['id']) ? 'modifBook&id=' . urlencode($_GET['id']) : 'addBook'; ?>" method="POST" enctype="multipart/form-data">

                <fieldset>
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?= isset($_GET['id']) ? $currentBook['title'] : "" ?>">
                </fieldset>
                <fieldset>
                    <label for="description">Résumé</label>
                    <!-- <input type="text" name="description" value="<?= isset($_GET['id']) ? $currentBook['description'] : "" ?>"> -->
                    <textarea id="description" name="description" maxlength="1200" cols="31" rows="9"><?= isset($_GET['id']) ? $currentBook['description'] : "" ?></textarea>
                </fieldset>
                <fieldset>
                    <label for="category">Genre</label>
                    <input id="category" type="text" name="category" value="<?= isset($_GET['id']) ? $currentBook['categoryName'] : "" ?>">
                </fieldset>
                <fieldset>
                    <label for="image">Image</label>
                    <input id="image" type="file" name="image">
                    <?php if(isset($_GET['id'])) : ?>
                        <input type="hidden" name="currentImage" value="<?= $currentBook['image']  ?>"> 
                        <img src="./assets/images/upload/<?= $currentBook['image'] ?>" alt=''>
                    <?php endif; ?>

                </fieldset>
                <fieldset>
                    <label for="authorName">Auteur</label>
                    <input type="text" name="authorName" value="<?= isset($_GET['id']) ? $currentBook['authorName'] : "" ?>">
                </fieldset>
                <input type="submit" name="submit">

            </form>

        </section>
    <?php endif; ?>
    
<?php endif; ?>