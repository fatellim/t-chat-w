<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

	<h2>Hello wf3 <?php echo !empty($_SESSION['user']) ? $_SESSION['user']['pseudo'] : '!'; ?></h2>
	<p>Bienvenu sur le site de wf3, Ici vous verez :</p>
	<p>Attention a ne pas faire de conneries </p>
<?php $this->stop('main_content') ?>
