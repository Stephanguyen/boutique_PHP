<?php require_once("inc/init.inc.php");
//----------------------------------TRAITEMENTS PHP ----------------------------------------------------//
if(!internauteEstConnecte()) {
  header('location:connexion.php');
  exit();
}
if(internauteEstConnecteEtEstAdmin()) {
    $content .= "<h1>Vous êtes Administrateur du site</h1>";
}


$content .='<nav>
					<ul>';
					if(internauteEstConnecte()):
$content .= '<li><a href="'; 
   URL;  

$content .= 'membres.php?page=membres&action=modification&id_membre=' . $_SESSION['membre']['id_membre'] . '"">Mettre à jour mes informations</a></li>';
endif;

$content .= '</ul>
</nav>';


?>

<?php require_once("inc/haut.inc.php"); 

?>
<?= $content; ?>
Bonjour <?= $_SESSION['membre']['pseudo'] ?> vous êtes bien connecté !
<br>
Voici vos informations : <br>
Votre nom : <?= $_SESSION['membre']['nom'] ?><br>
Votre prénom : <?= $_SESSION['membre']['prenom'] ?><br>
Votre email : <?= $_SESSION['membre']['email'] ?><br>
<?php require_once("inc/bas.inc.php"); ?>
