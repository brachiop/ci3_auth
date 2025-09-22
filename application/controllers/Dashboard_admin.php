<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        // Vérifier que l’admin est connecté et a le bon rôle
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('role') !== 'ADMIN') {
            redirect('auth/admin');  // ou vers la page login admin
        }
    }

    public function index()
    {
        // Récupérer les données de l'admin
        $login = $this->session->userdata('LOGIN');
        $user = $this->User_model->get_user_by_login($login);

        $data['admin'] = $user;
        $data['title'] = "Tableau de bord Admin";

        $this->load->view('admin/dashboard_admin', $data);
    }
    
}
