<?php

namespace Model;

use \W\Model\Model;
use \PDO;


class MessagesModel extends Model
{

	/**
	*Cette fonction selectionne tous les messages d'un salon en les associant avec les infos de leurs utilisateurs respectif;
	*@param int $idSalon l'id du salon dont on souhaite récupérer les messages
	*@return array la liste des messages avec les infos utilisateurs.
	*/

	public function searchAllWithUserInfos($idSalon, $idMessage = null){

		$query = "Select messages.*, utilisateurs.pseudo, utilisateurs.avatar FROM $this->table JOIN utilisateurs ON $this->table.id_utilisateur = utilisateurs.id WHERE id_salon = :id_salon";

		$idMessageExists = $idMessage !== null && ctype_digit($idMessage);

		if($idMessageExists){

			$query .=' AND messages.id > :id_message';
		}

		$query .=' ORDER BY messages.id ASC';
	
		$stmt = $this->dbh->prepare($query);

		$stmt->bindParam(':id_salon', $idSalon, PDO::PARAM_INT);

		if($idMessageExists){

			$stmt->bindParam(':id_message', $idMessage, PDO::PARAM_INT);
		}

		$stmt->execute();

		return $stmt->fetchAll();
	}

}