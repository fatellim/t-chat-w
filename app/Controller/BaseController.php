<?php

namespace Controller;

use \W\Controller\Controller;
use Model\SalonsModel;




class BaseController extends Controller
{

	/**
	* Ce champs va contenir l'engine de plates qui va servir a afficher mes vues.	
	*/
	protected $engine;


	public function __construct(){


		//Je stock dans la variable de class engine une instance de league\plates\engine alors que cetet instance etait crée directement dans la méthode show() de controller.

		$this->engine = new \League\Plates\Engine(self::PATH_VIEWS);


		//charge nos extensions (nos fonctions personnalisées)
		$this->engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		$app = getApp();

		$salonModels = new SalonsModel();

		// Rend certaines données disponibles à tous les vues
		// accessible avec $w_user & $w_current_route dans les fichiers de vue
		$this->engine->addData(
			[
				'w_user' 		  => $this->getUser(),
				'w_current_route' => $app->getCurrentRoute(),
				'w_site_name'	  => $app->getConfig('site_name'),
				'salons'		  => $salonModels->findAll()
			]
		);

	}

	public function show($file, array $data = array()){

		// Retire l'éventuelle extension .php
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $this->engine->render($file, $data);
		die();
	}


	/**
	* Cette fonction sert à ajouter toutes les vues qui seront disponible dans toutes
	* les vues fabriquée par $this->engine (donc par le base controller).
	* Exemple : Pour ajouter une liste d'utilisateur à mes vues, j'utilise $this->addGlobalData(array('users' => $users));
	*/

	public function addGlobalData(array $datas){
		$this->engine->addData($datas);
	}

}

/*
	Commentaires :

		> On instancie un nouveau model et on s'en sert pour instancier tous nos nouveaux Salons.

		> 


*/