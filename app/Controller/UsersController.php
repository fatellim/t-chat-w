<?php

namespace Controller;

use Model\UtilisateursModel;


class UsersController extends BaseController
{

	/**
	*Cette fonction sert à afficher la liste des utilisateurs.
	*/
	public function listUsers(){
		//La ligne suivante affiche la vu présente dans app/views/users/List.php
		//Et y inject le tableau $userList sous un nouveau nom $listUsers

		/*
			Commentaires : 

				> Ici j'instancie depuis  l'action du controlleur un modele d'utilisateurs pour pouvoir accéder à la liste des utilisateurs.



		*/
		$userModel = new UtilisateursModel();

		$usersList = $userModel->findAll();

		$this->show('Users/liste', array('listUsers' => $usersList));
	}

}