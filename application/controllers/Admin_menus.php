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
        $data['menus'] = $this->Menu_model->get_menus_pour_gestion();
        
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
    
    // NOUVELLE LOGIQUE :
    // - Si dates vides → menu toujours visible (visible_toujours = 1)
    // - Si dates remplies → menu visible seulement entre ces dates (visible_toujours = 0)
    
    $visible_toujours = (empty($date_debut) && empty($date_fin)) ? 1 : 0;
    
    $data = array(
        'est_actif' => TRUE,
        'visible_toujours' => $visible_toujours,
        'date_debut' => empty($date_debut) ? NULL : $date_debut,
        'date_fin' => empty($date_fin) ? NULL : $date_fin
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
        if ($this->Menu_model->desactiver_menu($menu_code)) {
            $this->session->set_flashdata('success', 'Menu désactivé avec succès!');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de la désactivation du menu.');
        }
        
        redirect('admin_menus');
    }
}
?>