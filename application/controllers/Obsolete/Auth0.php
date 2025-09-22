<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
        $this->login();
    }

    public function login_ajax()
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        $username = isset($data['username']) ? trim($data['username']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';

        // Étape 1 : Vérification identifiant
        $user = $this->User_model->get_by_identifier($username);

        if (!$user || $user['motdepasse'] !== $password) {
            echo json_encode(array(
                'success' => false,
                'message' => 'CNE/MASSAR ou CIN incorrect',
                'clearFields' => true
            ));
            return;
        }

        // Étape 2 : Vérification retrait définitif
        if (!empty($user['D_R_D'])) {
            echo json_encode(array(
                'success' => false,
                'message' => 'Vous avez retiré définitivement votre dossier le : '.$user['D_R_D'],
                'clearFields' => true
            ));
            return;
        }

        // Étape 3 : Vérification autorisation
        $autorisation = $this->User_model->get_autorisation($user['CNE']);
        if (!$autorisation) {
            echo json_encode(array(
                'success' => false,
                'message' => 'Non autorisé à se connecter',
                'clearFields' => true
            ));
            return;
        }

        // Étape 4 : Connexion réussie → mise en session
        $this->session->set_userdata(array(
            'loggedin' => true,
            'cne'      => $user['CNE'],
            'nom'      => $user['nom'],
            'code_fil' => $autorisation['CODE_FIL']
        ));

        echo json_encode(array(
            'success' => true,
            'message' => 'Connexion réussie'
        ));
    }

    public function login()
    {
        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());  // Redirige vers la racine
    }

}
