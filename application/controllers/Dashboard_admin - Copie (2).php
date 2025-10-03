<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends CI_Controller {

      public function __construct()
      {
          parent::__construct();
          $this->load->library('session');
          $this->load->model('User_model');
          $this->load->model('Etudiant_model');
          
          // Vérifier connexion admin
          if (!$this->session->userdata('admin_loggedin')) {
              redirect('auth/admin');
          }
          
          // Vérifier rôle autorisé (SUPER_ADMIN ou ADMIN)
          $role = $this->session->userdata('role');
          if (!in_array($role, ['SUPER_ADMIN', 'ADMIN'])) {
              redirect('auth/admin');
          }
      }

    public function index()
    {
        // Récupérer les données de l'admin
        $login = $this->session->userdata('login');
        $user = $this->User_model->get_user_by_login($login);

        // Statistiques simples
        $data['stats'] = $this->get_stats();
        $data['admin'] = $user;
        $data['title'] = "Tableau de bord Admin";

        $this->load->view('admin/dashboard_admin', $data);
    }

    /**
     * Récupérer les statistiques basiques
     */
    private function get_stats()
    {
        // Nombre total d'étudiants
        $total_etudiants = $this->Etudiant_model->get_total_etudiants();
        
        // Nombre d'étudiants connectés aujourd'hui
        $connectes_aujourdhui = $this->Etudiant_model->get_connectes_aujourdhui();
        
        // Dernières connexions
        $dernieres_connexions = $this->Etudiant_model->get_dernieres_connexions(5);

        return [
            'total_etudiants' => $total_etudiants,
            'connectes_aujourdhui' => $connectes_aujourdhui,
            'dernieres_connexions' => $dernieres_connexions
        ];
    }
}
