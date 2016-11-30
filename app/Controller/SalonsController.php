<?php

namespace Controller;

use Model\SalonsModel;
use Model\MessagesModel;


class SalonsController extends BaseController
{

	public function viewSalon($id){
	
		$salonsModel = new SalonsModel();
		$salon = $salonsModel->find($id);

		$messagesModel = new MessagesModel();
		
			if(!empty($_POST['message'])){

				if($this->getUser()){

					$user = $this->getUser();

					$datas = [

						'corps' => $_POST['message'],
						'date_creation' => date('Y-m-d H:i:s'),
						'date_modification' => date('Y-m-d H:i:s'),
						'id_utilisateur' => $user['id'],
						'id_salon' => $id

						];
						
				$messagesModel->insert($datas);


				}else{

					$this->getFlashMessager()->error('Tu dois être connecter avant d\envoyer un message !');
				}
			}
		
		$messages = $messagesModel -> searchAllWithUserInfos($id);

		$this->show('salons/see', array('salon' => $salon, 'messages' => $messages));

		
	}

	public function newMessages($idSalon, $idMessage){

		$messagesModel = new MessagesModel;

		$messages = $messagesModel->searchAllWithUserInfos($idSalon, $idMessage);

		$this->show('salons/newmessages', array('messages' => $messages));


	}



}

			
	/*
		Commentaires :

			> Cette Action permet de voir la liste des messages d'un salons.

			> On instancie le model des salons de façon à récupérer les informations du salon dont l'id est $id (passé dans l'url);
			
			> On instancie le modèle des messages pour récupérer les messages du salons dont l'id est $id

			> Search est egale à = Select * From messages WHERE id_salon = id

			> J'utilise une methode propre au model message qui permet de recuperer les messages avec les infos utilisateurs associées.

	*/