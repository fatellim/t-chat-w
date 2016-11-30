<?php

namespace Controller;

use Model\UtilisateursModel;
use Model\UsersModel;
use W\Security\AuthentificationModel;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;


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


			public function login(){

		// On va utiliser le model d'authenfication et plus particulierement 
		// la méthode isValidLoginInfos à laquelle on passera en param
		// le pseudo/email  et le password envoyées en post par l'utilisateur
		// une fois cette vérification faite, on récupère l'utilisateur en bdd
		// et on le redirige vers la page d'acceuil.


				if(!empty($_POST)){
		//Si le pseudo est vide on ajoute un message d'erreur .
					if(empty($_POST['pseudo'])){

						$this->getFlashMessenger()->error('veuillez rentrer un pseudo');
					}

		//Si le mot de passe est vide on ajoute un message d'erreur
					if(empty($_POST['mot_de_passe'])){

					$this->getFlashMessenger()->error('veuillez rentrer un Mot de passe');

					}

					$auth = new AuthentificationModel();

					if(!$this->getFlashMessenger()->hasErrors()){

						$idUser = $auth->isValidLoginInfo($_POST['pseudo'], $_POST['mot_de_passe']);

						if($idUser !== 0 ){

							$utilisateurModel = new UtilisateursModel();

							//... je récupère les infos de l'utilisateur et je m'en sert pour le connecter au site à l'aide de $auth->logUserIn
							$userInfos = $utilisateurModel->find($idUser);
							$auth->logUserIn($userInfos);
							$this->redirectToRoute('default_home');

						}else{

							$this->getFlashMessenger()->error('Vos informations de connexion sont incorrect !');
						}

					}

				}
				
			$this->show('users/login', array('datas' => isset($_POST) ? $_POST : array()));

	}

	public function logout(){
		$auth = new AuthentificationModel();
		$auth->logUserOut();
		$this->redirectToRoute('login');
	}


	public function register(){

		if(!empty($_POST)){

			//On indique à respecter validation que nos règles de validation seront accesible depuis le namespace Rules
			v::with('Validation\Rules');

			$Validators = array(


				'pseudo' => v::length(3,50)->alnum()->usernameNotExists()->noWhiteSpace()->setName('Nom d\'utilisateur'),
				'email'  => v::email()->emailNotExists()->setName('Email'),
				'mot_de_passe' => v::length(3,20)->noWhiteSpace()->alnum()->setName('Mot de Passe'),
				'sexe'   => v::in(['femme', 'homme', 'non-defini']),
				'avatar' => v::optional(v::image()->size('1MB')->uploaded())
			);
			

			$datas = $_POST;

			if(!empty($_FILES['avatar']['tmp_name'])){

				//Je stock en donnée a valider le chemin vers la localisation temporairede l'avatar.
				$datas['avatar'] = $_FILES['avatar']['tmp_name'];
			}else{

				//Sinon je laisse le champs vide 
				//realpath('avatars/default.png') --> Chemin réel
				$datas['avatar']= '';
			}

			foreach ($Validators as $field => $validator){

				//La methode assert renvoie une exeption de type NESTEDVALIDATIONEXCEPTION qui nous permet de récupérer le ou les messages d'erreurs en cas d'erreurs.

				try{
					
				//On essaye de valider la donnée et si une exeption se produit le bloc cath sera executé ; 

				$validator->assert(isset($datas[$field]) ? $datas[$field] : '' );

				}catch(NestedValidationException $ex){

					$fullMessage = $ex->getFullMessage();

					$this->getFlashMessenger()->error($fullMessage);

				}//Fin try/Catch

			}//Fin foreach

			if(!$this->getFlashMessenger()->hasErrors()){
				//Si on n'a pas rencontre d'erreurs on procède à l'insertion du nouvel utilisateur et deplace l'avatar, puis hacher le mot de passe.

				//On hache le mdp, on utilise pour cela le model AuthentificationModel pour rester cohérent avec le framework.
				$auth = new AuthentificationModel();

				$datas['mot_de_passe'] = $auth->hashPassword($datas['mot_de_passe']);

				//On deplace l'avatar vers le dossier avatar.
				if(!empty($_FILES['avatar']['tmp_name'])){

					$initialAvatar =  $_FILES['avatar']['tmp_name']

					$avatarNewName = md5(time().uniqid());

					//realpath : prend le chemin relatif actuel 
					$targetPath = realpath('assets/uploads/');

					//deplace le dossier en apache vers une destination !
					move_uploaded_file($initialAvatar, $targetPath .'/'.$avatarNewName);

					//on met a jour le nouveau nom de l'avatar dans $datas

					$datas['avatar']= $avatarNewName;
				}else{

					$datas['avatar']='default.png';
				}
				


				$utilisateurModel = new UtilisateursModel();

				unset($datas['send']);

				$userInfos = $utilisateurModel->insert($datas);

				$auth->logUserIn($userInfos);

				$this->getFlashMessenger()->success('Vous vous ête bien inscrit à tchat ! ');

				$this->redirectToRoute('default_home');


			}

		}//Fin $post



		//je parcours la liste de mes validateurs, en récupérant aussi le nom du champs en clées.
		$this->show('users/register');


	}//Fin fonction 


}