<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    // ===================== Page de connexion =====================
    public function index() {
        $this->load->view('auth/login'); // Vue unique avec choix Étudiant/Admin
    }

    // ===================== Connexion Étudiant =====================
    public function login_student() {
        $identifier = $this->input->post('identifier'); // CNE ou C_MASSAR

        // Vérifier si étudiant existe
        $student = $this->User_model->get_by_identifier($identifier);
        if (!$student) {
            $this->session->set_flashdata('error', "Étudiant introuvable !");
            redirect('auth');
        }

        // Vérifier s’il est autorisé
        $autorisation = $this->User_model->get_autorisation($student['CNE']);
        if (!$autorisation) {
            $this->session->set_flashdata('error', "Accès refusé : étudiant non autorisé !");
            redirect('auth');
        }

        // Enregistrer connexion
        $this->User_model->set_connecte($student['CNE']);

        // Créer session
        $this->session->set_userdata(array(
            'logged_in' => true,
            'role' => 'ETUDIANT',
            'cne' => $student['CNE'],
            'nom' => $student['NOM'],
            'prenom' => $student['PRENOM'],
            'filiere' => $student['CODE_FIL']
        ));

        redirect('etudiant/dashboard');
    }

    // ===================== Connexion Admin =====================
    public function login_admin() {
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $user = $this->User_model->verify_user_password($login, $password);
        if (!$user) {
            $this->session->set_flashdata('error', "Identifiants incorrects !");
            redirect('auth');
        }

        // Créer session
        $this->session->set_userdata(array(
            'logged_in' => true,
            'role' => $user['ROLE'],
            'login' => $user['LOGIN'],
            'nom' => $user['NOM'],
            'prenom' => $user['PRENOM']
        ));

        redirect('admin/dashboard');
    }

    // ===================== Déconnexion =====================
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
