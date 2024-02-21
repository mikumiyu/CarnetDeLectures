<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="./assets/js/script.js" type="module"></script>
    <link rel="stylesheet" href="./assets/css/style.scss">
    <title>Document</title>
</head>
<body>
    <div class="header-background">
        <header id="top-header">
            <h1>Carnet de Lectures</h1>
            <nav>
                <!-- bouton de connexion en fonction de l'état de connexion -->
                <a href="index.php">Accueil</a>
                <a href="#">A propos</a>
                <?php 
                    if(isset($_SESSION['user'])){
                        echo "<a href='#' data-user-id='{$_SESSION['user']['id']}' id='connectedBurgerLink'>{$_SESSION['user']['username']}</a>";
                    }
                    elseif(isset($_SESSION['admin'])){
                        echo "<a href='#' data-user-id='{$_SESSION['admin']['id']}' id='connectedBurgerLink'>{$_SESSION['admin']['adminName']}</a>";
                    }
                    else{
                        echo "<a href='index.php?action=loginPage'>Se connecter</a>";
                        echo "<a href='index.php?action=createAccount'>S'inscrire</a>";
                    };
                ?>
                
            </nav>
        </header>
    </div>

    <main>

        <?php if(isset($_GET['message'])) : ?>
            <div class="infos message-banner">
                <i class="fa-solid fa-check"></i>
                <p><?= $_GET['message'] ?></p>
            </div>
        <?php elseif(isset($_GET['error'])) : ?>
            <div class="infos error-banner">
                <i class="fa-solid fa-xmark"></i>
                <p><?= $_GET['error'] ?></p>
            </div>
        <?php endif; ?>

        <?php require($template.'.html.php'); ?>

    </main>
    <div class="clear"></div>
    <footer>

        <ul>
            <li><a href="mailto:CarnetDeLectures@gmail.com">Me contacter</a></li>
            <li><a href="#">mention légales</a></li>
            <li><a href="#">Lorem, ipsum dolor.</a></li>
            <li><a href="#">Lorem, ipsum.</a></li>
        </ul>
        <a href="#top-header"><i class="fa-solid fa-arrow-up" id="backToTopBtn"></i></a>

    </footer>

</body>
</html>