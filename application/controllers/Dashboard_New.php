<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Etudiant_model'); // Ajouter le modèle pour récupérer les infos
        
        // Vérifier si l’utilisateur est connecté
        if (!$this->session->userdata('loggedin')) {
            redirect('auth'); // ou 'auth/login' ou 'auth' ou redirect(base_url()); si vous préférez
        }
        
        $this->load->model('Menu_model');
        $this->load->helper('menu');
        $this->menus_actifs = $this->Menu_model->get_menus_etudiant_actifs();
        
    }        
    
    
    public function index() {
        // Récupération du CNE depuis la session
        $cne = $this->session->userdata('cne');
        // Charger les infos de l'étudiant
        $data['etudiant'] = $this->Etudiant_model->get_etudiant_by_identifier($cne);

        $data['title'] = "Tableau de bord";
        
            $data['page_title'] = 'Tableau de Bord Étudiant';
            $data['active_menu'] = 'dashboard';
            $data['menus_actifs'] = $this->Menu_model->get_menus_etudiant_actifs();

        // Charger une seule vue qui contient toute la structure du template
        //$this->load->view('dashboard/index', $data);
        $this->load->view('etudiant/dashboard_etudiant', $data);
        
    }
}

