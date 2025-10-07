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


      // Page de login principal avec onglets
      public function index() {
          // Affiche la page de connexion avec onglets
          $this->load->view('auth/login_tabs');
      }

      public function admin() {
          // Rediriger vers la page de connexion principale qui a les onglets
          redirect('auth/login_admin');
      }    

     // Traitement connexion étudiant via AJAX
      public function login_ajax() {
          // Activer l'affichage des erreurs
          error_reporting(E_ALL);
          ini_set('display_errors', 1);
          
          header('Content-Type: application/json');

          try {
              
              $inputJSON = file_get_contents("php://input");
              
              $input = json_decode($inputJSON, true);
              
              // Vérifier si le JSON est valide
              if (json_last_error() !== JSON_ERROR_NONE) {
                  throw new Exception('JSON invalide: ' . json_last_error_msg());
              }
              
              $identifiant = isset($input['identifiant']) ? trim($input['identifiant']) : '';
              $cin = isset($input['cin']) ? trim($input['cin']) : '';

              if (empty($identifiant) || empty($cin)) {
                  echo json_encode([
                      'success' => false,
                      'message' => 'CNE/Code Massar et CIN requis',
                      'clearFields' => true
                  ]);
                  return;
              }


              // Étape 1 : Vérification identifiant et CIN
              $etudiant = $this->Etudiant_model->get_etudiant_by_identifier($identifiant);

              if (!$etudiant) {
                  echo json_encode([
                      'success' => false,
                      'message' => 'CNE/Massar ou CIN incorrect',
                      'clearFields' => true
                  ]);
                  return;
              }
              if (!$etudiant || $etudiant['CIN'] !== $cin) {
                  echo json_encode([
                      'success' => false,
                      'message' => 'CNE/Massar ou CIN incorrect',
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
              $autorisation = $this->Etudiant_model->get_autorisation($etudiant['CNE']);

              if (!$autorisation) {
                  echo json_encode([
                      'success' => false,
                      'message' => 'Non autorisé à se connecter',
                      'clearFields' => true
                  ]);
                  return;
              }
              
              // Connexion réussie
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
              
              $this->session->set_userdata($session_data);

              // Enregistrer la connexion
              $this->Etudiant_model->set_connecte($etudiant['CNE']);

              echo json_encode([
                  'success' => true, 
                  'message' => 'Connexion réussie',
                  'redirect' => base_url('dashboard')
              ]);

          } catch (Exception $e) {
              
              echo json_encode([
                  'success' => false,
                  'message' => 'Erreur serveur: ' . $e->getMessage()
              ]);
          }
      }

      public function login_admin_ajax() {
          header('Content-Type: application/json');
          
          $inputJSON = file_get_contents("php://input");
          $input = json_decode($inputJSON, true);
          
          $login = isset($input['login']) ? trim($input['login']) : '';
          $motdepasse = isset($input['motdepasse']) ? trim($input['motdepasse']) : '';

          if (empty($login) || empty($motdepasse)) {
              echo json_encode(['success' => false, 'message' => 'Login et mot de passe requis']);
              return;
          }

          $user = $this->User_model->get_user_by_login($login);

          if (!$user) {
              echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect']);
              return;
          }

          if ($user['MOTDEPASSE'] !== $motdepasse) {
              echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect']);
              return;
          }

          // Session
          $this->session->set_userdata([
              'admin_loggedin' => true,
              'login' => $user['LOGIN'],
              'nom' => $user['NOM'],
              'prenom' => $user['PRENOM'],
              'role' => $user['ROLE'],
              'email' => $user['EMAIL']
          ]);

          // Déterminer la redirection
          $redirect_url = $this->get_redirect_url_by_role($user['ROLE']);

          echo json_encode([
              'success' => true, 
              'message' => 'Connexion ' . $user['ROLE'] . ' réussie',
              'redirect' => $redirect_url
          ]);
          
      }

      private function get_redirect_url_by_role($role) {
          switch ($role) {
              case 'SUPER_ADMIN':
              case 'ADMIN':
                  return base_url('dashboard_admin');
              case 'GUICHET':
                  return base_url('dashboard_guichet');
              default:
                  return base_url('dashboard_admin');
          }
      }

    // Déconnexion (étudiant ou admin)
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url()); // Redirige vers la racine
    }
}