<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function get_menus_etudiant_actifs()
    {
        $now = date('Y-m-d H:i:s');
        
        $this->db->where('est_actif', TRUE);
        
        // Logique simplifiée : soit visible toujours, soit dans la période
        $this->db->where("(visible_toujours = 1 OR ('$now' BETWEEN COALESCE(date_debut, '1000-01-01') AND COALESCE(date_fin, '9999-12-31')))");
        
        $this->db->order_by('menu_nom', 'ASC');
        
        return $this->db->get('menus_etudiant')->result_array();
    }
    
        // Pour l'interface admin - EXCLUT les menus fixes
    public function get_menus_pour_gestion()
    {
        // Seulement les menus qui peuvent être contrôlés (visible_toujours = 0)
        $this->db->where('visible_toujours', 0);
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
    
}
?>