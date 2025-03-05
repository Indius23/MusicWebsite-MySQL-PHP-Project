<?php

if(!is_admin())
{
	message("only admins can acces the admin page");
	redirect('login');
}
	$section = $URL[1] ?? null;
	$action = $URL[2] ?? null;
	$id = $URL[3] ?? null;

	switch ($section) {
		case 'dashboard':
			require page('admin/dashboard');
			break;

				case 'categories':
			require page('admin/categories');
			break;

				case 'songs':
			require page('admin/songs');
			break;

				case 'bands':
			require page('admin/bands');
			break;
		
			case 'users':
			require page('admin/users');
			break;

			case 'albums':
			require page('admin/albums');
			break;

			case 'artists':
			require page('admin/artists');
			break;

			case 'composers':
			require page('admin/composers');
			break;
		
		
		
		
		default:
			require page('admin/404');
			break;
	}




	