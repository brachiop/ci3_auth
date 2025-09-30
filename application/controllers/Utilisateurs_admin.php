<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateurs_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        // Vérifier que c'est un SUPER_ADMIN
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('role') !== 'SUPER_ADMIN') {
            redirect('auth/admin');
        }
    }

    public function index() {
        $data['title'] = 'Gestion des Utilisateurs - SUPER ADMIN';
        
        // Charger selon votre structure template
        $this->load->view('templates/header', $data);
        $this->load->view('admin/utilisateurs_simple', $data); // Vue simple pour tester
        $this->load->view('templates/footer');
    }
}