<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_menus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_loggedin')) {
            redirect('auth/login');
        }
        $this->load->model('Menu_model');
    }

        public function index()
        {
            $data['page_title'] = 'Gestion des Menus Étudiant';
            $data['active_menu'] = 'admin_menus';
            //$data['menus'] = $this->Menu_model->get_all_menus();
            $data['menus'] = $this->Menu_model->get_menus_pour_gestion();// Doit retourner TOUS les menus
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/navbar');
            $this->load->view('admin/gestion_menus');
            $this->load->view('templates/footer');
        }

        public function activer_menu()
        {
            $menu_code = $this->input->post('menu_code');
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            
            // Validation des dates
            $validation_errors = $this->valider_dates_periode($date_debut, $date_fin);
            
            if (!empty($validation_errors)) {
                $this->session->set_flashdata('error', implode('<br>', $validation_errors));
                redirect('admin_menus');
                return;
            }
            
            // Nettoyer les dates : convertir les chaines vides en NULL
            $date_debut = empty($date_debut) ? NULL : $date_debut;
            $date_fin = empty($date_fin) ? NULL : $date_fin;
            
            $data = array(
                'est_actif' => 1,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin
            );
            
            if ($this->Menu_model->update_menu($menu_code, $data)) {
                $this->session->set_flashdata('success', 'Menu activé avec succès!');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors de l\'activation du menu.');
            }
            
            redirect('admin_menus');            
        }

        public function desactiver_menu($menu_code)
        {
            // Simplement désactiver le menu (est_actif = 0)
            $data = array('est_actif' => 0);
            
            if ($this->Menu_model->update_menu($menu_code, $data)) {
                $this->session->set_flashdata('success', 'Menu désactivé avec succès!');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors de la désactivation du menu.');
            }
            
            redirect('admin_menus');
        }
        
        // Méthode de validation des dates
        private function valider_dates_periode($date_debut, $date_fin) {
            $errors = [];
            
            // Si une seule date est remplie
            if ((!empty($date_debut) && empty($date_fin)) || (empty($date_debut) && !empty($date_fin))) {
                $errors[] = 'Veuillez remplir les deux dates ou laisser les deux vides.';
            }
            
            // Si les deux dates sont remplies
            if (!empty($date_debut) && !empty($date_fin)) {
                if ($date_debut > $date_fin) {
                    $errors[] = 'La date de début ne peut pas être postérieure à la date de fin.';
                }
                
                // Optionnel : empêcher les dates passées
                if ($date_debut < date('Y-m-d')) {
                    $errors[] = 'La date de début ne peut pas être dans le passé.';
                }
            }
            
            return $errors;
        }       
        
public function ajouter_menu() {
    if ($this->input->post()) {
        $menu_code = $this->input->post('menu_code');
        
        // Vérifier si le code existe déjà
        if ($this->Menu_model->menu_exists($menu_code)) {
            $this->session->set_flashdata('error', 'Ce code de menu existe déjà!');
            redirect('admin_menus');
            return;
        }
        
        $data = array(
            'menu_code' => $menu_code,
            'menu_nom' => $this->input->post('menu_nom'),
            'menu_icon' => $this->input->post('menu_icon'),
            'menu_url' => $this->input->post('menu_url'),
            'est_actif' => 0 // Désactivé par défaut
        );
        
        if ($this->Menu_model->creer_menu($data)) {
            $this->session->set_flashdata('success', 'Menu créé avec succès! Il est maintenant disponible dans la liste.');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de la création du menu.');
        }
        
        redirect('admin_menus');
    }
}        
         
    }
?>