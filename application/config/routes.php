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

// Import des Tables CSV
// URL --> Controleur/méthode/paramètre
$route['import/(filieres|parcours|modules)'] = 'import/import/$1';
// Export des templates des Tables CSV
$route['download-template/(filieres|parcours|modules)'] = 'import/download_template/$1';
// Affichage filières, parcours, modules
$route['admin/filieres'] = 'Pedago_admin/filieres';
$route['admin/parcours'] = 'Pedago_admin/parcours';
$route['admin/modules'] = 'Pedago_admin/modules';

// inscription Etudiant
$route['etudiant/inscription_actuelle'] = 'etudiant/modules_inscription';
$route['etudiant/dashboard'] = 'dashboard';
//$route['etudiant/dashboard'] = 'etudiant/dashboard';

// Parametrage
$route['parametrage'] = 'parametrage/index';
$route['parametrage/sauvegarder'] = 'parametrage/sauvegarder';

// Mes Groupes
$route['etudiant/mes_groupes'] = 'etudiant/mes_groupes';

// Gestion Menus Etudiants
$route['admin_menus'] = 'admin_menus/index';
$route['admin_menus/activer'] = 'admin_menus/activer_menu';
$route['admin_menus/desactiver/(:any)'] = 'admin_menus/desactiver_menu/$1';

// Import CSV
// URL --> Controleur_méthode
/*
$route['import/filieres'] = 'import/import_filieres';
$route['import/template_filieres'] = 'import/download_template_filieres';
*/
//$route['import/import_parcours'] = 'import/import_parcours';
//$route['import/template_parcours'] = 'import/download_template_parcours';
/*
$route['import/parcours'] = 'import/import_parcours';
$route['import/download_template_parcours'] = 'import/download_template_parcours';
*/


//$route['import/modules'] = 'import/modules';

// dashboard admin
//$route['admin/dashboard'] = 'admin/dashboard';
//$route['admin'] = 'admin/dashboard'; // Page par défaut admin