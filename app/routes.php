<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/user', 'Users#listUsers', 'users_list'],
		['GET|POST', '/salon/[i:id]', 'Salons#viewSalon', 'view_salon'],
	);