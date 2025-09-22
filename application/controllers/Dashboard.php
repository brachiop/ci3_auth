<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model'); // Ajouter le modèle pour récupérer les infos
        
        // Vérifier si l’utilisateur est connecté
        if (!$this->session->userdata('loggedin')) {
            redirect(base_url()); // ou 'auth/login' si vous préférez
        }
    }

    public function index() {
        // Récupération du CNE depuis la session
        $cne = $this->session->userdata('cne');
        // Charger les infos de l'étudiant
        $data['etudiant'] = $this->User_model->get_etudiant_by_identifier($cne);

        $data['title'] = "Tableau de bord";

        // Charger une seule vue qui contient toute la structure du template
        //$this->load->view('dashboard/index', $data);
        $this->load->view('etudiant/dashboard_etudiant', $data);
        
    }

}

