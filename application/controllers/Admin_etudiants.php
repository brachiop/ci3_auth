<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_etudiants extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Etudiant_model');
        $this->load->library('form_validation');
        
        // Vérifier les droits admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('ROLE') != 'ADMIN') {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['etudiants'] = $this->Etudiant_model->get_all_etudiants();
        $data['title'] = 'Gestion des étudiants - Admin';
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin_etudiants/liste', $data);
        $this->load->view('templates/footer');
    }

    // Ajouter les méthodes ajouter(), modifier(), supprimer() ici...
}
?>