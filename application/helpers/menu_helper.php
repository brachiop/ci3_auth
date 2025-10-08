<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generer_menu_etudiant')) {
    function generer_menu_etudiant($menus_actifs) {
        $html = '';
        
        foreach ($menus_actifs as $menu) {
            $html .= '
            <li class="nav-item menu-items">
                <a class="nav-link" href="' . site_url($menu['menu_url']) . '">
                    <span class="menu-icon">
                        <i class="mdi ' . $menu['menu_icon'] . '"></i>
                    </span>
                    <span class="menu-title">' . $menu['menu_nom'] . '</span>
                </a>
            </li>';
        }
        
        return $html;
    }
}

if (!function_exists('est_menu_actif')) {
    function est_menu_actif($menu_code) {
        $CI =& get_instance();
        $CI->load->model('Menu_model');
        $menus = $CI->Menu_model->get_menus_etudiant_actifs();
        
        foreach ($menus as $menu) {
            if ($menu['menu_code'] == $menu_code) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
?>