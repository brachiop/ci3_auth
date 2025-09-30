<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_guichet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        // Vérifier que c'est un GUICHET connecté
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('role') !== 'GUICHET') {
            redirect('auth/admin');
        }
    }

    public function index() {
        $data['title'] = "Tableau de bord - Guichet";
        $data['user'] = [
            'nom' => $this->session->userdata('nom'),
            'prenom' => $this->session->userdata('prenom'),
            'role' => $this->session->userdata('role')
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('guichet/dashboard_guichet', $data);
        // $this->load->view('templates/footer'); // RETIRÉ - Déjà dans le template
    }
}