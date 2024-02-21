<h2 class="create-account-title" >Création de compte utilisateur</h2>

<form action="http://localhost/Projet%20final/backend/index.php?action=createUser" method="POST" class="generic-form">

    <fieldset>
        <label for="userName">Nom d'utilisateur</label>
        <input type="text" name="userName" placeholder="Nom d'utilisateur">
    </fieldset>
    <fieldset>
        <label for="userMail">Adresse e-mail</label>
        <input type="mail" name="userMail" placeholder="Mail">
    </fieldset>
    <fieldset>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" placeholder="Mot de passe">
    </fieldset>
    <fieldset>
        <label for="password2">Confirmation de mot de passe</label>
        <input type="password" name="password2" placeholder="Confirmation de mot de passe">
    </fieldset>
    <input type="submit" value="S'inscrire">

</form>