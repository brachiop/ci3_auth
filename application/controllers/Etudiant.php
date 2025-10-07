<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant extends CI_Controller {
    private $annee_univ;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Etudiant_model'); // Ajouter le modèle pour récupérer les infos
        
        // Vérifier si l’utilisateur est connecté
        if (!$this->session->userdata('loggedin')) {
            redirect(base_url()); // ou 'auth/login' si vous préférez
        }
        
        $this->config->load('parametrage');
        $this->annee_univ = $this->config->item('annee_univ_format');
      }

      public function infos_privees() {
          $cne = $this->session->userdata('cne');      // vérifier que la session contient bien 'CNE'
            if (!$cne) {
                redirect('auth'); // pas de CNE → renvoyer vers la connexion
            }
          $data['etudiant'] = $this->Etudiant_model->get_etudiant_by_identifier($cne);
          $this->load->view('etudiant/infos_privees', $data);
      }

      public function infos_scolaires() {
          $cne = $this->session->userdata('cne');
            if (!$cne) {
                redirect('auth'); // pas de CNE → renvoyer vers la connexion
            }          
          $data['etudiant'] = $this->Etudiant_model->get_etudiant_by_identifier($cne);
          //$data['annee_univ'] = date('Y') . '/' . (date('Y')+1);
          $data['annee_univ'] = $this->annee_univ;
          //$data['semestre_actuel'] = session_value('semestre_actuel', 'S1');
          $data['code_fil'] = $this->session->userdata('code_fil'); // filière depuis session
          
          $this->load->view('etudiant/infos_scolaires', $data);
      }

      public function modules_inscription()
      {
          if (!$this->session->userdata('loggedin')) {
              redirect('auth/login');
          }

          $data['page_title'] = 'État d\'Inscription';
          $data['active_menu'] = 'modules_inscription';
          $data['annee_univ'] = $this->annee_univ;
          
          // Récupérer le CNE de l'étudiant connecté depuis la session
          $cne = $this->session->userdata('cne');
          
          $this->load->model('Etudiant_model');
          $data['infos_etudiant'] = $this->Etudiant_model->get_infos_etudiant_complet($cne);
          
          $this->load->view('etudiant/modules_inscription', $data);
      }

}

