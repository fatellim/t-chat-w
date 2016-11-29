<?php 
namespace Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailNotExistsException extends ValidationException 
{

	public static $defaultTemplates = array(

		self::MODE_DEFAULT => [

			'L\' email existe déja '
		],

		self::MODE_NEGATIVE => [

			'L\'utilisateur existe déja '

		]

		);


}
