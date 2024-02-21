
    <!-- insertion de message si existant -->
        <h2 class="connection-title">Se connecter avec un compte administrateur</h2>

        <form class="generic-form" action="index.php?action=connexionAdmin" method="POST">
            <fieldset>
                <label for="adminName">pseudo :</label>
                <input id="adminName" type="text" name="adminName" placeholder="Pseudo">
            </fieldset>

            <fieldset>                    
                <label for="password">Mot de passe :</label>
                <input id="password" type="password" name="password" placeholder="Mot de passe">
            </fieldset> 
                                
            <input class="btnSubmit" name="submit" type="submit" value="Connexion" id="connexion">
        </form>
