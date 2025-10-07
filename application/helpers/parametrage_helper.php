<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// UTILISATION
// Dans les modèles
/*
    $tbl_inscription = get_table('tbl_inscription');
    $nbr_modules = get_au_param('nbr_modules');
*/
// Utilisation directe
/*
    $this->db->get($tbl_inscription);
*/

if (!function_exists('get_table')) {
    function get_table($table_name) {
        $CI =& get_instance();
        $CI->config->load('parametrage');
        return $CI->config->item($table_name);
    }
}

if (!function_exists('get_au_param')) {
    function get_au_param($param_name) {
        $CI =& get_instance();
        $CI->config->load('parametrage');
        return $CI->config->item($param_name);
    }
}