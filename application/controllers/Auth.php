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

/*    public function index() {
        // Affiche la page de connexion étudiant
        $this->load->view('auth/login');
    }
*/
    // Page de login principal avec onglets
    public function index() {
        // Affiche la page de connexion avec onglets
        $this->load->view('auth/login_tabs');
    }

    // Page de login admin
/*
    public function admin() {
        $this->load->view('auth/login_admin');
    }
*/

      // Traitement connexion étudiant via AJAX
      public function login_ajax() {
          // Activer l'affichage des erreurs
          error_reporting(E_ALL);
          ini_set('display_errors', 1);
          
          header('Content-Type: application/json');

          try {
              // Log des données reçues
              error_log("=== TENTATIVE CONNEXION ÉTUDIANT ===");
              
              $inputJSON = file_get_contents("php://input");
              error_log("Données brutes reçues: " . $inputJSON);
              
              $input = json_decode($inputJSON, true);
              error_log("Données JSON décodées: " . print_r($input, true));
              
              // Vérifier si le JSON est valide
              if (json_last_error() !== JSON_ERROR_NONE) {
                  throw new Exception('JSON invalide: ' . json_last_error_msg());
              }
              
              $identifiant = isset($input['identifiant']) ? trim($input['identifiant']) : '';
              $cin = isset($input['cin']) ? trim($input['cin']) : '';

              error_log("Identifiant: " . $identifiant);
              error_log("CIN: " . $cin);

              if (empty($identifiant) || empty($cin)) {
                  error_log("Champs vides détectés");
                  echo json_encode([
                      'success' => false,
                      'message' => 'CNE/Code Massar et CIN requis',
                      'clearFields' => true
                  ]);
                  return;
              }


              // Étape 1 : Vérification identifiant et CIN
              error_log("Recherche de l'étudiant avec identifiant: " . $identifiant);
              $etudiant = $this->Etudiant_model->get_etudiant_by_identifier($identifiant);
              error_log("Résultat recherche étudiant: " . print_r($etudiant, true));

              if (!$etudiant) {
                  error_log("Étudiant non trouvé");
                  echo json_encode([
                      'success' => false,
                      'message' => 'CNE/Massar ou CIN incorrect',
                      'clearFields' => true
                  ]);
                  return;
              }
              if (!$etudiant || $etudiant['CIN'] !== $cin) {
                  error_log("CIN incorrect. Attendu: " . $etudiant['CIN'] . ", Reçu: " . $cin);
                  echo json_encode([
                      'success' => false,
                      'message' => 'CNE/Massar ou CIN incorrect',
                      'clearFields' => true
                  ]);
                  return;
              }


              // Étape 2 : Vérification retrait définitif
              error_log("Vérification D_R_D: " . $etudiant['D_R_D']);
              if (!empty($etudiant['D_R_D'])) {
                  echo json_encode([
                      'success' => false,
                      'message' => 'Vous avez retiré définitivement votre dossier le : '.$etudiant['D_R_D'],
                      'clearFields' => true
                  ]);
                  return;
              }

              // Étape 3 : Vérification autorisation
              error_log("Vérification autorisation pour CNE: " . $etudiant['CNE']);
              $autorisation = $this->Etudiant_model->get_autorisation($etudiant['CNE']);
              error_log("Résultat autorisation: " . print_r($autorisation, true));

              if (!$autorisation) {
                  echo json_encode([
                      'success' => false,
                      'message' => 'Non autorisé à se connecter',
                      'clearFields' => true
                  ]);
                  return;
              }
              
              // Connexion réussie
              error_log("Connexion réussie pour: " . $etudiant['CNE']);
              
              $session_data = [
                  'loggedin' => true,
                  'cne' => $etudiant['CNE'],
                  'massar' => $etudiant['C_MASSAR'],
                  'cin' => $etudiant['CIN'],
                  'nom' => $etudiant['NOM'],
                  'prenom' => $etudiant['PRENOM'],
                  'date_naiss' => $etudiant['DATE_NAIS'],
                  'sexe' => $etudiant['SEXE'],
                  'tel' => $etudiant['TEL'],
                  'email' => $etudiant['EMAIL'],
                  'd_r_d' => $etudiant['D_R_D'],
                  'code_fil' => $autorisation['CODE_FIL']
              ];
              
              error_log("Données session: " . print_r($session_data, true));
              
              $this->session->set_userdata($session_data);

              // Enregistrer la connexion
              $this->Etudiant_model->set_connecte($etudiant['CNE']);

              echo json_encode([
                  'success' => true, 
                  'message' => 'Connexion réussie',
                  'redirect' => base_url('dashboard')
              ]);

          } catch (Exception $e) {
              error_log("ERREUR EXCEPTION: " . $e->getMessage());
              echo json_encode([
                  'success' => false,
                  'message' => 'Erreur serveur: ' . $e->getMessage()
              ]);
          }
      }

    // Traitement connexion Admin via AJAX

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