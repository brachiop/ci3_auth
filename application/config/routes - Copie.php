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
/*
$route['default_controller'] = 'auth';
$route['etudiant/infos_privees'] = 'etudiant/infos_privees';
$route['etudiant/infos_scolaires'] = 'etudiant/infos_scolaires';
$route['admin/dashboard'] = 'dashboard_admin/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
*/

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// Étudiant
$route['auth'] = 'auth/index';
$route['auth/login_ajax'] = 'auth/login_ajax';
// Admin
$route['auth/admin'] = 'auth/admin';
$route['auth/login_admin_ajax'] = 'auth/login_admin_ajax';
// Dashboard Étudiant
$route['etudiant/dashboard'] = 'dashboard/index';  // ou le nom de ton contrôleur/vues existant
// Dashboard Admin
$route['admin/dashboard_admin'] = 'dashboard_admin/index'; // si tu as un contrôleur Dashboard_admin

// Routes pour le Dashboard Etudiant  
$route['dashboard'] = 'dashboard/index';              // Étudiant
$route['dashboard/index'] = 'dashboard/index';        // Étudiant

// Routes pour le Dashboard ADMIN  
$route['dashboard_admin'] = 'dashboard_admin/index';  // Admin
$route['dashboard_admin/index'] = 'dashboard_admin/index'; // Admin

// Routes pour les étudiants (assurez-vous qu'elles existent)
//$route['etudiants/profil'] = 'etudiants/profil';
$route['etudiants/infos_privees'] = 'etudiants/infos_privees';
$route['etudiants/infos_scolaires'] = 'etudiants/infos_scolaires';

// Logout
$route['auth/logout'] = 'auth/logout';
// Ajout
$route['admin/etudiants'] = 'admin_etudiants/index';
$route['admin/etudiants/ajouter'] = 'admin_etudiants/ajouter';

$route['etudiants_admin'] = 'etudiants_admin/index';
$route['etudiants_admin/index'] = 'etudiants_admin/index';
$route['etudiants_admin/index/(:num)'] = 'etudiants_admin/index/$1';
$route['etudiants_admin/voir/(:num)'] = 'etudiants_admin/voir/$1';

$route['etudiants_admin/voir/(:num)'] = 'etudiants_admin/voir/$1';

// Routes pour le guichet
$route['dashboard_guichet'] = 'dashboard_guichet/index';

// Routes pour la gestion des utilisateurs (SUPER_ADMIN)
$route['utilisateurs_admin'] = 'utilisateurs_admin/index';
$route['utilisateurs_admin/creer'] = 'utilisateurs_admin/creer';
$route['utilisateurs_admin/modifier/(:num)'] = 'utilisateurs_admin/modifier/$1';

// Routes pour la gestion des utilisateurs
$route['utilisateurs_admin'] = 'utilisateurs_admin/index';
$route['utilisateurs_admin/index'] = 'utilisateurs_admin/index';
$route['utilisateurs_admin/index/(:num)'] = 'utilisateurs_admin/index/$1';
$route['utilisateurs_admin/creer'] = 'utilisateurs_admin/creer';
$route['utilisateurs_admin/modifier/(:num)'] = 'utilisateurs_admin/modifier/$1';
$route['utilisateurs_admin/changer_statut/(:num)'] = 'utilisateurs_admin/changer_statut/$1';