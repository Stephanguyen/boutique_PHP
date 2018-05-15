

<?php require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");


if(!internauteEstConnecteEtEstAdmin()) {
    header("location:../connexion.php");
    exit();
}


//--------------------- Liens produits -------------------------//


$content .= '<a href="?page=gestion_commandes&action=affichage">Affichage des commandes</a><br>';
$content .= '<a href="?page=gestion_commandes&action=ajout">Ajout d\'une commande</a><br><br><hr>'; 



//--------------------- Supression -------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'suppression'){
    $pdo->exec("DELETE FROM commande WHERE id_commande = $_GET[id_commande]");
}


//--------------------- Affichage -------------------------//
if(isset($_GET['action']) && $_GET['action'] == 'affichage'){

$resultat = $pdo->query('SELECT p.id_produit, p.reference, p.categorie, p.titre, p.description, p.couleur, p.taille, p.public, p.photo, p.prix, p.stock, d.id_details_commande, d.id_commande, d.quantite, c.id_membre, c.montant, c.date_enregistrement, c.etat FROM produit p, detail_commande d, commande c WHERE p.id_produit = d.id_produit AND d.id_commande = c.id_commande ORDER BY id_commande');
$content .= '<h2>Affichage des commandes</h2>';
$content .= 'Nombre de commande(s) dans la boutique : ' . $resultat->rowCount();


$content .= '<table class="table"><tr>';
for($i = 0; $i < $resultat->columnCount(); $i++) { // boucle sur les colonnes
	$colonne = $resultat->getColumnMeta($i); // getColumnMeta récupère les informations sur les colonnes
	$content .= "<th>$colonne[name]</th>";
}
$content .= '<th colspan="2">Actions</th>';
$content .= '</tr>';
while($produits = $resultat->fetch(PDO::FETCH_ASSOC)) { // boucle sur les données
	$content .= '<tr>';
	foreach($produits as $indice => $valeur) {
		if($indice == 'photo')
			$content .= "<td><img src=\"$valeur\" height=\"42\" width=\"42\"></td>";
		else
			$content .= "<td>$valeur</td>";
	}
    // $content .= '<td><a href="?page=gestion-des-produits&action=validation&id_details_commande=' . $produits['id_details_commande'] . '"><span class="glyphicon glyphicon-pencil"></span></a></td>'; // lien de validation
    $content .= '<td><form action="" method="post">
    <select id="status" name="status">
        <option value="En cour de traitement">En cour de traitement</option>
        <option value="envoyé">envoyé</option>
        <option value="livré">livré</option>
    </select>
    <select id="id_com" name="id_com">
        <option value="' . $produits['id_details_commande'] . '">id</option>
    </select>
    <button type="submit">Status</button>
    </form></td>';
	$content .= '<td><a href="?page=gestion-des-produits&action=suppression&id_commande=' . $produits['id_commande'] . '" onClick="return(confirm(\'En êtes vous certain ?\'))"><span class="glyphicon glyphicon-trash"></span></a></td>'; // lien suppression
}

$content .= '</table><br><hr><br>';
}

//--------------------- Validation Produits -------------------------//


if(isset($_POST['status'])){

    
    $pdo->exec("UPDATE commande SET etat = '$_POST[status]' WHERE id_commande = (SELECT id_commande FROM detail_commande WHERE id_details_commande = $_POST[id_com])");
}


echo $content;



require_once("../inc/bas.inc.php");

?>
