<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Activer l'affichage des erreurs (temporairement)
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // CHARGER LES DEUX MODÈLES
        $this->load->model('Etudiant_model');  // Pour étudiants
        $this->load->model('User_model');      // Pour admins
    
        $this->load->library('session');
        $this->load->helper(array('url', 'form', 'session_helper', 'data_helper'));
    }

    // Page de login étudiant
    public function index() {
        // Affiche la page de connexion étudiant
        $this->load->view('auth/login');
    }

    // Page de login admin
    public function admin() {
        $this->load->view('auth/login_admin');
    }


    // Traitement connexion étudiant via AJAX
    public function login_ajax() {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);
        $username = isset($input['username']) ? trim($input['username']) : '';
        $password = isset($input['password']) ? trim($input['password']) : '';

        // Vérifier étudiant avec Etudiant_model
        $etudiant = $this->Etudiant_model->get_etudiant_by_identifier($username);

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
        $autorisation = $this->Etudiant_model->get_autorisation($etudiant['CNE']);
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


    // Traitement connexion étudiant via AJAX

public function login_admin_ajax() {
    header('Content-Type: application/json');

    $inputJSON = file_get_contents("php://input");
    $input = json_decode($inputJSON, true);
    
    $login = isset($input['login']) ? trim($input['login']) : '';
    $motdepasse = isset($input['motdepasse']) ? trim($input['motdepasse']) : '';

    // Debug
    error_log("Tentative de connexion admin: " . $login);

    if (empty($login) || empty($motdepasse)) {
        echo json_encode(['success' => false, 'message' => 'Login et mot de passe requis']);
        return;
    }

    // Charger le User_model si pas déjà fait
    if (!isset($this->User_model)) {
        $this->load->model('User_model');
    }

    $user = $this->User_model->get_user_by_login($login);

    if (!$user) {
        error_log("Utilisateur non trouvé: " . $login);
        echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect']);
        return;
    }

    // Vérification mot de passe
    if ($user['MOTDEPASSE'] !== $motdepasse) {
        error_log("Mot de passe incorrect pour: " . $login);
        echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect']);
        return;
    }

    // Connexion réussie
    error_log("Connexion réussie pour: " . $login);
    
    $this->session->set_userdata([
        'admin_loggedin' => true,
        'login'          => $user['LOGIN'],
        'nom'            => $user['NOM'],
        'prenom'         => $user['PRENOM'],
        'role'           => $user['ROLE'],
        'email'          => $user['EMAIL']
    ]);

    echo json_encode([
        'success' => true, 
        'message' => 'Connexion admin réussie',
        'redirect' => base_url('dashboard_admin')
    ]);
}

    // Déconnexion (étudiant ou admin)
    public function logout() {
        $this->session->sess_destroy();
        //redirect('auth');
        redirect(base_url()); // Redirige vers la racine
    }
}