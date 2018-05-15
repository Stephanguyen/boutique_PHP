<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo URL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/bootstrap.min.css">

    <title></title>
  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">Boutique</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?= URL; ?>index.php">Accueil</a></li>
					<?php if(internauteEstConnecteEtEstAdmin()) : ?>
						<li><a href="<?= URL; ?>admin/">BackOffice</a></li>
					<?php endif; ?>
					<?php if(internauteEstConnecte()) : ?>
						<li><a href="<?= URL; ?>panier.php">Panier</a></li>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Membre</a>
							<ul class="dropdown-menu navbar-right">
								<li><a href="<?= URL ?>profil.php">Profil</a></li>
						<li><a href="<?= URL ?>connexion.php?action=deconnexion">Deconnexion</a></li>
					</ul>
				</li>
			<?php else: ?>
				<li><a href="<?= URL ?>panier.php">panier</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Membre <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?= URL ?>inscription.php">Inscription</a></li>
						<li><a href="<?= URL ?>connexion.php">Connexion</a></li>
					</ul>
				</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
