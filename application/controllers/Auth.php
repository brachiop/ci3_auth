<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form', 'session_helper', 'data_helper'));
    }

    // Page de login étudiant
    public function index() {
        // Affiche la page de connexion étudiant
        $this->load->view('auth/login');
    }

    // Traitement connexion étudiant via AJAX
    public function login_ajax() {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);
        $username = isset($input['username']) ? trim($input['username']) : '';
        $password = isset($input['password']) ? trim($input['password']) : '';

        // Vérifier étudiant avec User_model
        $etudiant = $this->User_model->get_etudiant_by_identifier($username);

        if (!$etudiant || $etudiant['CIN'] !== $password) {
            echo json_encode(['success' => false, 'message' => 'CNE/MASSAR ou CIN incorrect', 'clearFields' => true]);
            return;
        }

        // Vérifier retrait définitif
        if (!empty($etudiant['D_R_D'])) {
            echo json_encode(['success' => false, 'message' => 'Vous avez retiré définitivement votre dossier le : ' . $etudiant['D_R_D'], 'clearFields' => true]);
            return;
        }

        // Vérifier autorisation
        $autorisation = $this->User_model->get_autorisation($etudiant['CNE']);
        if (!$autorisation) {
            echo json_encode(['success' => false, 'message' => 'Non autorisé à se connecter', 'clearFields' => true]);
            return;
        }

        // Connexion réussie → mise en session (variables en minuscules)
        $this->session->set_userdata([
            'loggedin'     => true,
            'cne'           => $etudiant['CNE'],
            'nom'           => $etudiant['NOM'],
            'prenom'        => $etudiant['PRENOM'],
            'cin'           => $etudiant['CIN'],
            'email'         => $etudiant['EMAIL'],
            'tel'           => $etudiant['TEL'],
            'date_naiss'    => $etudiant['DATE_NAIS'],
            'sexe'          => $etudiant['SEXE'],
            'code_fil'      => $autorisation['CODE_FIL']
            // d'autres champs utiles si besoin
        ]);

        echo json_encode(['success' => true, 'message' => 'Connexion réussie']);
    }

    // Page de login admin
    public function admin() {
        $this->load->view('auth/login_admin');
    }

    // Traitement connexion admin via AJAX
    public function login_admin_ajax() {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);
        $login = isset($input['login']) ? trim($input['login']) : '';
        $motdepasse = isset($input['motdepasse']) ? trim($input['motdepasse']) : '';

        $user = $this->User_model->get_user_by_login($login);

        if (!$user || $user['MOTDEPASSE'] !== $motdepasse) {
            echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect', 'clearFields' => true]);
            return;
        }

        // Connexion réussite pour admin
        $this->session->set_userdata([
            'admin_loggedin' => true,
            'login'          => $user['LOGIN'],
            'nom'            => $user['NOM'],
            'prenom'         => $user['PRENOM'],
            'role'           => $user['ROLE'],
            'email'          => $user['EMAIL']
        ]);

        echo json_encode(['success' => true, 'message' => 'Connexion admin réussie']);
    }

    // Déconnexion (étudiant ou admin)
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
