<?php

namespace Controller;


class DefeultController extends BaseController
{

/**
 * Page d'accueil par défaut
 */
public function home()
{
	$this->show('default/home');
}

}