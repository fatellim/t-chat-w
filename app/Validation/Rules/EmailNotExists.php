<?php 

/*
	Commentaires: 

		>Cette classe sert à etendre les focntionnalitées de la bibliothèque respect/validation
		en y ajoutant un nouveau validateur. 
*/

namespace Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use W\Model\UsersModel;


class EmailNotExists extends AbstractRule
{
	
	public function validate($email){

		$usersModel = new UsersModel;

		return !$usersModel->emailExists($email);
	}
	
}



