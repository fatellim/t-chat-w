<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/users', 'Users#listUsers', 'users_list'],
		['GET|POST', '/salon/[i:id]', 'Salons#viewSalon', 'view_salon'],
		['GET|POST', '/login', 'Users#login', 'login'],
		['GET', '/logout', 'Users#logout', 'logout'],
		['GET|POST', '/register', 'Users#register', 'register'],
		//Cette route va être accesible en ajax et servira a renvoyer les messsages d'un salon qui ont été posté depuis un id donnée. 
		['GET', '/newmessages/[i:idSalon]/[i:idMessage]', 'Salons#newMessages', 'new_messages']
	);