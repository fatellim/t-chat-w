<!DOCTYPE html>

<html lang="fr">
<head>
	<title><?= $this->e($title)?> </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- $this->assetUrl('css/reset.css') vaudra 'assets/css/reset.css' -->

	<link rel="stylesheet" href="<?= $this->assetUrl('css/reset.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css'); ?>" type="text/css" />
</head>
<body>
	<header>
		<h1><?= $this->e($title) ?></h1>
	</header>
	<aside>
		<h3><a href="<?= $this->url('default_home');?> " title="Revenir à l'acceuil du site">Les salons</a></h3>
		<nav>
		    <ul id="menu-salons">
			    <li>
				    <a href="<?= $this->url('users_list') ?>" title="Liste des utilisateurs ">Liste des utilisateurs</a>		    	
			    </li>
			    <li>
			    	<a href="deconexion.php" title="Se deconnecter de T'chat">Deconnexion</a>		    	
			    </li>
		    </ul>
		</nav>
	</aside><main>
	<section>
		<?= $this->section('main_content') ?>
	</section>
	</main>
	<footer>

	</footer>
</body>
</html>