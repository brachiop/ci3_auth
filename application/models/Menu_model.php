<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

public function get_menus_etudiant_actifs()
{
    $current_date = date('Y-m-d');
    
    $this->db->where('est_actif', 1);
    
    $this->db->group_start();
    
    // Cas 1: Les DEUX dates sont NULL ou vides
    $this->db->where('date_debut IS NULL', null, false);
    $this->db->where('date_fin IS NULL', null, false);
    
    $this->db->or_group_start();
    
    // Cas 2: Les DEUX dates sont remplies ET dans la période
    $this->db->where('date_debut IS NOT NULL', null, false);
    $this->db->where('date_fin IS NOT NULL', null, false);
    $this->db->where('date_debut <=', $current_date);
    $this->db->where('date_fin >=', $current_date);
    
    $this->db->group_end();
    $this->db->group_end();
    
    $this->db->order_by('menu_nom', 'ASC');
    
    return $this->db->get('menus_etudiant')->result_array();
}
    
        // Pour l'interface admin - EXCLUT les menus fixes
    public function get_menus_pour_gestion()
    {
        // Seulement les menus qui peuvent être contrôlés (visible_toujours = 0)
        //$this->db->where('visible_toujours', 0);
        
            // SUPPRIMER l'ancien filtre :
        // $this->db->where('visible_toujours', 0);
        
        // OU MIEUX : Afficher TOUS les menus pour la gestion admin
        $this->db->order_by('menu_nom', 'ASC');
        return $this->db->get('menus_etudiant')->result_array();
        
    }

    public function get_all_menus()
    {
        return $this->db->get('menus_etudiant')->result_array();
    }

    public function update_menu($menu_code, $data)
    {
        $this->db->where('menu_code', $menu_code);
        return $this->db->update('menus_etudiant', $data);
    }

    public function activer_menu_periode($menu_code, $date_debut, $date_fin)
    {
        $data = array(
            'est_actif' => TRUE,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'visible_toujours' => FALSE
        );
        
        return $this->update_menu($menu_code, $data);
    }

    public function desactiver_menu($menu_code)
    {
        $data = array(
            'est_actif' => FALSE,
            'date_debut' => NULL,
            'date_fin' => NULL
        );
        
        return $this->update_menu($menu_code, $data);
    }
    
        public function get_menus_par_role($table, $role = null)
    {
        $this->db->where('est_actif', TRUE);
        
        if ($role) {
            $this->db->where('role_requis', $role);
        }
        
        return $this->db->get($table)->result_array();
    }
    
    // Utilisation :
    // $menus_etudiant = $this->Menu_model->get_menus_par_role('menus_etudiant');
    // $menus_guichet = $this->Menu_model->get_menus_par_role('menus_guichet', 'GUICHET');

public function menu_exists($menu_code) {
    $this->db->where('menu_code', $menu_code);
    return $this->db->get('menus_etudiant')->num_rows() > 0;
}

public function creer_menu($data) {
    return $this->db->insert('menus_etudiant', $data);
}
    
}
?>