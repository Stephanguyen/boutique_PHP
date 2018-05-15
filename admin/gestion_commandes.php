<?php require_once("../inc/init.inc.php");
//----------------------------------TRAITEMENTS PHP ----------------------------------------------------//
// ------- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin()) {
    header("location:../connexion.php");
    exit();
}

test

?>


<?php require_once('../inc/haut.inc.php'); ?>
<?php echo 'Bonjour'; ?>
<?php require_once('../inc/bas.inc.php'); ?>