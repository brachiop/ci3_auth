<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model'); // Ajouter le modèle pour récupérer les infos
        
        // Vérifier si l’utilisateur est connecté
        if (!$this->session->userdata('loggedin')) {
            redirect(base_url()); // ou 'auth/login' si vous préférez
        }
      }

      public function infos_privees() {
          $cne = $this->session->userdata('CNE');      // vérifier que la session contient bien 'CNE'
            if (!$cne) {
                redirect('auth'); // pas de CNE → renvoyer vers la connexion
            }
          $data['etudiant'] = $this->User_model->get_etudiant_by_identifier($cne);
          $this->load->view('etudiant/infos_privees', $data);
      }

      public function infos_scolaires() {
          $cne = $this->session->userdata('CNE');
          $data['etudiant'] = $this->User_model->get_etudiant_by_identifier($cne);
          $data['annee_univ'] = date('Y') . '/' . (date('Y')+1);
          $data['semestre_actuel'] = session_value('semestre_actuel', 'S1');
          $data['code_fil'] = $this->session->userdata('code_fil'); // filière depuis session
          
          $this->load->view('etudiant/infos_scolaires', $data);
      }

}

