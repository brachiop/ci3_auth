<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function est_menu_actif($menu_code) {
    $CI =& get_instance();
    $CI->load->model('Menu_model');
    
    // Récupérer le menu spécifique
    $CI->db->where('menu_code', $menu_code);
    $menu = $CI->db->get('menus_etudiant')->row_array();
    
    if (!$menu) {
        return false;
    }
    
    // NOUVELLE LOGIQUE basée sur est_actif + dates
    if ($menu['est_actif'] != 1) {
        return false; // Menu désactivé
    }
    
    $current_date = date('Y-m-d');
    
    // Cas 1: Dates NULL ou vides → toujours visible
    if ((empty($menu['date_debut']) || $menu['date_debut'] == '0000-00-00') && 
        (empty($menu['date_fin']) || $menu['date_fin'] == '0000-00-00')) {
        return true;
    }
    
    // Cas 2: Dates remplies → vérifier la période
    if (!empty($menu['date_debut']) && !empty($menu['date_fin']) &&
        $menu['date_debut'] <= $current_date && 
        $menu['date_fin'] >= $current_date) {
        return true;
    }
    
    return false;
}