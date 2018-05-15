<?php require_once("../inc/init.inc.php");
//----------------------------------TRAITEMENTS PHP ----------------------------------------------------//
// ------- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin()) {
    header("location:../connexion.php");
    exit();
}

//------------------- ENREGISTREMENT D'UN MEMBRE ----------------------//
if(!empty($_POST)) {
	

    $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);


	$id_membre = (isset($_GET['id_membre'])) ? $_GET['id_membre'] : 'NULL'; // s'il y a un id_membre dans l'url c'est que nous sommes dans le cas d'une modification
	$pdo->exec("REPLACE INTO membre (id_membre, pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES ('$id_membre', '$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]', '$_POST[statut]')");
    $content .= '<div class="alert alert-success">Le membre a bien été ajouté ;-) !</div>';

    

}
    //-------------------- SUPPRESSION D'UN MEMBRE-------------------------------------------------//
if(isset($_GET['action']) && $_GET['action'] == 'suppression') {
    $pdo->exec("DELETE FROM membre WHERE id_membre = $_GET[id_membre]");
}

//-------------------- SUPPRESSION D'UN MEMBRE-------------------------------------------------//

//-------------------- LIENS MEMBRES -------------------------------------------------//
$content .= '<a href="?page=gestion_membres&action=affichage">Affichage des membres</a><br>'; // lien affichage
$content .= '<a href="?page=gestion_membres&action=ajout">Ajout d\'un administrateur</a><br><br><hr><br>'; // lien ajout


//------------------------------------- AFFICHAGE DES MEMBRES --------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "affichage") {
    $resultat = $pdo->query('SELECT * FROM membre');
    $content .= '<h2>Affichage des membres</h2>';
    $content .= 'Nombre de membres : ' . $resultat->rowCount();
    $content .='<table class="table"><tr>';
    for($i = 0; $i < $resultat->columnCount(); $i++) {// boucle sur les colonnes
      $colonne = $resultat->getColumnMeta($i); // getColumnMeta récupère les informations sur les colonnes
      $content .="<th>$colonne[name]</th>";
    }
    $content .='<th colspan="2">Actions</th>';
    $content .='</tr>';
    while($membres = $resultat->fetch(PDO::FETCH_ASSOC)) { // boucle sur les données
          $content .= '<tr>';
       
          foreach($membres as $indice => $valeur) {
            $content .= "<td>$valeur</td>";
          }
          $content .='<td><a href="?page=gestion-des-membres&action=modification&id_membre=' . $membres['id_membre'] . '"><span class="glyphicon glyphicon-pencil"></span></a></a></td>'; // lien modification
          $content .= '<td><a href="?page=gestion-des-membres&action=suppression&id_membre=' . $membres['id_membre'] . '" onClick="return(confirm(\'En êtes vous certain?\'))"><span class="glyphicon glyphicon-trash"></span></a></td>'; // lien suppression
    }
    $content .= '</table><br><hr><br>';
    }
	

?>



<?php require_once('../inc/haut.inc.php');

if(isset($_GET['action']) && ($_GET['action'] == 'ajout')) {
$content .=' 
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
  <select name="statut" id="statut">
        <option value=0>membre</option>
        <option value=1>administrateur</option>
  </select><br><br>

  <button type="submit" name="button">Inscrire</button>


</form>';
}


?>



<?php echo $content; ?>
<?php require_once('../inc/bas.inc.php'); ?>