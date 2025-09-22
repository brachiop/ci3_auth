<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form', 'session_helper'));
    }

    // Page de connexion étudiant
    public function index() {
        $this->load->view('auth/login'); // template Corona
    }

    // Page de connexion admin
    public function admin() {
        $this->load->view('auth/login_admin'); // vue séparée pour admin
    }

    // Connexion AJAX étudiant
    public function login_ajax() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        $username = isset($data['username']) ? trim($data['username']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';

        // Étape 1 : Vérification identifiant
        $etudiant = $this->User_model->get_etudiant_by_identifier($username);

        if (!$etudiant || $etudiant['CIN'] !== $password) {
            echo json_encode([
                'success' => false,
                'message' => 'CNE/MASSAR ou CIN incorrect',
                'clearFields' => true
            ]);
            return;
        }

        // Étape 2 : Vérification retrait définitif
        if (!empty($etudiant['D_R_D'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Vous avez retiré définitivement votre dossier le : '.$etudiant['D_R_D'],
                'clearFields' => true
            ]);
            return;
        }

        // Étape 3 : Vérification autorisation
        $autorisation = $this->User_model->get_autorisation($etudiant['CNE']);
        if (!$autorisation) {
            echo json_encode([
                'success' => false,
                'message' => 'Non autorisé à se connecter',
                'clearFields' => true
            ]);
            return;
        }

        // Étape 4 : Connexion réussie → mise en session
        $this->session->set_userdata([
            'loggedin' => true,
            'cne'      => $etudiant['CNE'],
            'nom'      => $etudiant['NOM'],
            'prenom'   => $etudiant['PRENOM'],
            'code_fil' => $autorisation['CODE_FIL']
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Connexion réussie'
        ]);
    }

    // Connexion AJAX admin
    public function login_admin_ajax() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        $login = isset($data['login']) ? trim($data['login']) : '';
        $motdepasse = isset($data['motdepasse']) ? trim($data['motdepasse']) : '';

        $user = $this->User_model->get_user_by_login($login);

        if (!$user || $user['MOTDEPASSE'] !== $motdepasse) {
            echo json_encode([
                'success' => false,
                'message' => 'Login ou mot de passe incorrect',
                'clearFields' => true
            ]);
            return;
        }

        // Connexion réussie → mise en session
        $this->session->set_userdata([
            'admin_loggedin' => true,
            'user_id'        => $user['ID'],
            'nom'            => $user['NOM'],
            'prenom'         => $user['PRENOM'],
            'role'           => $user['ROLE']
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Connexion administrateur réussie'
        ]);
    }

    // Déconnexion
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

