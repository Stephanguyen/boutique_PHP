<?php require_once("inc/init.inc.php"); ?>
<?php
    if($_POST){
    //  debug($_POST);
    // debug($pdo);
          $erreur = '';
          if(strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) > 20)
         {
          $erreur .= '<div class="alert alert-danger" role="alert">Erreur taille pseudo</div>';
        }

        if(!preg_match('#^[a-zA-Z0-9.-_]+$#', $_POST['pseudo'])) {
          $erreur .= '<div class="alert alert-danger" role="alert">Erreur format pseudo</div>';
        }
        $r = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
        if($r->rowCount() >=1) {
          $erreur .= '<div class="alert alert-danger" role="alert">Pseudo indisponible !</div>';
        }
        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = addslashes($valeur);
        }
        $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        if(empty($erreur)) {
          $pdo->exec("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[cp]', '$_POST[adresse]')");
          $content .= '<div class="alert alert-success" role="alert">Inscription validée !</div>';
        }
        $content .= $erreur;
  }

 ?>
<?php require_once("inc/haut.inc.php"); ?>
<?= $content; ?>
<!-- Formulaire HTML
- pseudo - input type="text"
- mdp - input type="password"
- nom - input type="text"
- prnom - input type="text"
- civilite - input type="text"
- ville - input type="text"
- code_postal - input type="text"
- adresse - textarea

- bouton submit - input type="submit" -->

<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Formulaire</title>
  </head>
  <body>

<form class="" action="" method="post">
  <label for="pseudo">Pseudo : </label>
  <input type="text" class="form-control" placeholder="Votre pseudo" name="pseudo" id="pseudo" maxlength="20" pattern="[a-zA-Z0-9.-_.]{3,20}" title="caractères acceptés : a-z A-Z 0-9 .-_" required><br><br>
  <label for="mdp">Mot de passe : </label>
  <input type="password" class="form-control" placeholder="Votre mot de passe" name="mdp" id="mdp" required><br><br>
  <label for="nom">Nom : </label>
  <input type="text" class="form-control" placeholder="Votre nom" name="nom" id="nom" required><br>
  <label for="prenom">Prénom</label>
  <input type="text" class="form-control" placeholder="Votre prénom" name="prenom" id="prenom" required><br><br>
  <label for="email">Email : </label>
  <input type="email" class="form-control" placeholder="Votre email" name="email" id="email" required><br><br>
  <label for="civilite">Civilité</label>
  <input type="radio" name="civilite" id="civilite" value="m" checked>
  Homme
  <input type="radio" name="civilite" id="civilite" value="f">
  Femme<br><br>
  <label for="">Ville</label>
  <input type="text" class="form-control" placeholder="Votre ville" name="ville" id="ville" maxlength="20" pattern="[a-zA-Z0-9.-_.]{3,20}" title="caractères acceptés : a-z A-Z 0-9 .-_" required><br><br>
  <label for="">Code postal</label>
  <input type="text" class="form-control" placeholder="Votre cp" name="cp" id="cp" maxlength="20" pattern="[a-zA-Z0-9.-_.]{3,20}" title="caractères acceptés : a-z A-Z 0-9 .-_" required><br><br>
  <label for="adresse">Adresse</label>
  <textarea class="form-control" placeholder="Votre adresse" name="adresse" id="adresse" maxlength="200" pattern="[a-zA-Z0-9.-_.]{3,20}" title="caractères acceptés : a-z A-Z 0-9 .-_"></textarea>

  <button type="submit" name="button">S'inscrire</button>


</form>

  </body>
</html>


<?php require_once("inc/bas.inc.php"); ?>
