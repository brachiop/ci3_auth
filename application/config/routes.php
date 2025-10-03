<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';

// ==================== ROUTES FONDAMENTALES ====================
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ==================== ROUTES AUTH PRINCIPALES ====================
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

// ==================== ROUTES ADMIN  ====================
// Gestion des utilisateurs - POINTE VERS LE BON CONTRÔLEUR !
$route['admin/utilisateurs'] = 'utilisateurs_admin/index';
$route['admin/utilisateurs/(:num)'] = 'utilisateurs_admin/index/$1';

// CRUD Utilisateurs - À CRÉER DANS Utilisateurs_admin.php
$route['admin/creer-utilisateur'] = 'utilisateurs_admin/creer';
$route['admin/editer-utilisateur/(:num)'] = 'utilisateurs_admin/editer/$1';
$route['admin/supprimer-utilisateur/(:num)'] = 'utilisateurs_admin/supprimer/$1';
$route['admin/changer-statut/(:num)'] = 'utilisateurs_admin/changer_statut/$1';

// Import CSV
$route['import/filieres'] = 'import/filieres';
$route['import/download_template_filieres'] = 'import/download_template_filieres';

