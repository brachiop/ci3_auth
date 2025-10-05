<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Paramétrage de l'Application
|--------------------------------------------------------------------------
*/

$config['an_inscr'] = 2026;
$config['tbl_inscription'] = "inscription";
$config['tbl_modules'] = "modules24";
$config['tbl_filieres'] = "filieres24";
$config['tbl_parcours'] = "parc24";
$config['tbl_Fetudg'] = "fetudg";
$config['tbl_autorise'] = "autorise";
$config['prefix_oletud'] = "oletud";
$config['nbr_modules'] = 42;
$config['nbr_tent'] = 5;

// Champs calculés automatiquement
$config['xAU'] = substr($config['an_inscr'], 2, 2);
$config['tbl_oletud'] = $config['prefix_oletud'] . $config['xAU'];
$config['DebMod'] = 1;
$config['FinMod'] = $config['nbr_modules'];
$config['annee_univ_format'] = ($config['an_inscr'] - 1) . '/' . $config['an_inscr'];

?>