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
        
            // Charger les menus actifs pour toutes les méthodes
        $this->load->model('Menu_model');
        $this->load->helper('menu');
        $this->menus_actifs = $this->Menu_model->get_menus_etudiant_actifs();
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

      public function modules_inscription() {
          $data['page_title'] = 'État d\'Inscription';
          $data['active_menu'] = 'modules_inscription';
          $data['annee_univ'] = $this->annee_univ;
          
          $cne = $this->session->userdata('cne');
          $this->load->model('Etudiant_model');
          $data['infos_etudiant'] = $this->Etudiant_model->get_infos_etudiant_complet($cne);
          
          $this->load_etudiant_view('etudiant/modules_inscription', $data);
      }

      public function mes_groupes() {
          $data['page_title'] = 'Mes Groupes et Sections';
          $data['active_menu'] = 'mes_groupes';
          $data['annee_univ'] = $this->annee_univ;
          
          $cne = $this->session->userdata('cne');
          $this->load->model('Etudiant_model');
          $sections = $this->Etudiant_model->get_sections_etudiant($cne);
          $data['sections'] = $sections;
          
          $data['etudiant_info'] = array(
              'cne' => $this->session->userdata('cne'),
              'nom_prenom' => $this->session->userdata('nom') . ' ' . $this->session->userdata('prenom'),
              'code_fil' => !empty($sections) ? $sections[0]['CODE_FIL'] : '',
              'code_parc' => !empty($sections) ? $sections[0]['CODE_PARC'] : ''
          );
          
          $this->load_etudiant_view('etudiant/mes_groupes', $data);
      }

      private function load_etudiant_view($view, $data = array())
      {
          // Toujours charger les menus actifs
          $data['menus_actifs'] = $this->Menu_model->get_menus_etudiant_actifs();
          
          $this->load->view('templates/header', $data);
          $this->load->view('templates/student_sidebar', $data); // ← Passer $data ici aussi
          $this->load->view($view, $data);
          $this->load->view('templates/footer');
      } 
      
}

