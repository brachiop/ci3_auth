<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant extends CI_Controller {
        private $annee_univ;

        public function __construct() {
            parent::__construct();
            $this->load->library('session');
            $this->load->model('Etudiant_model');
            
            if (!$this->session->userdata('loggedin')) {
                redirect(base_url());
            }
            
            $this->config->load('parametrage');
            $this->annee_univ = $this->config->item('annee_univ_format');
            
        }

        public function index() {
            if (!$this->session->userdata('loggedin')) {
                redirect('auth/login');
            }
            
            $data['page_title'] = 'Tableau de Bord';
            $data['active_menu'] = 'dashboard';

            // Charger les données du dashboard si nécessaire
            $cne = $this->session->userdata('cne');
            $data['etudiant'] = $this->Etudiant_model->get_etudiant_by_identifier($cne);
            
            $this->load_etudiant_view('etudiant/dashboard_etudiant', $data);
        }
        
        public function infos_privees() {
            if (!$this->session->userdata('loggedin')) {
                redirect('auth/login');
            }           
            $cne = $this->session->userdata('cne');      
              if (!$cne) {
                  redirect('auth'); 
              }
            $data['etudiant'] = $this->Etudiant_model->get_etudiant_by_identifier($cne);
            $this->load_etudiant_view('etudiant/infos_privees', $data);
        }

        public function infos_scolaires() {
            if (!$this->session->userdata('loggedin')) {
                redirect('auth/login');
            }          
            $cne = $this->session->userdata('cne');
              if (!$cne) {
                  redirect('auth'); // pas de CNE → renvoyer vers la connexion
              }          
            $data['etudiant'] = $this->Etudiant_model->get_etudiant_by_identifier($cne);
            $data['annee_univ'] = $this->annee_univ;
            $data['code_fil'] = $this->session->userdata('code_fil'); // filière depuis session
            
            $this->load_etudiant_view('etudiant/infos_scolaires', $data);
        }

        public function modules_inscription() {
            if (!$this->session->userdata('loggedin')) {
                redirect('auth/login');
            }
            
            $data['annee_univ'] = $this->annee_univ;
            $data['page_title'] = 'État Inscription';
            $data['active_menu'] = 'mes_modules';
            
            $cne = $this->session->userdata('cne');
            $data['infos_etudiant'] = $this->Etudiant_model->get_infos_etudiant_complet($cne);
            
            // UTILISEZ load_etudiant_view()
            $this->load_etudiant_view('etudiant/modules_inscription', $data);
        }

       public function mes_groupes() {
            if (!$this->session->userdata('loggedin')) {
                redirect('auth/login');
            }            
            $data['annee_univ'] = $this->annee_univ;
            $data['page_title'] = 'Mes Groupes et Sections';
            $data['active_menu'] = 'mes_groupes';            
          
            $cne = $this->session->userdata('cne');
            $sections = $this->Etudiant_model->get_sections_etudiant($cne);
            $data['sections'] = $sections;
            $data['etudiant_info'] = array(
                'cne' => $this->session->userdata('cne'),
                'nom_prenom' => $this->session->userdata('nom') . ' ' . $this->session->userdata('prenom'),
                'code_fil' => !empty($sections) ? $sections[0]['CODE_FIL'] : '',
                'code_parc' => !empty($sections) ? $sections[0]['CODE_PARC'] : ''
            );
            
            // UTILISEZ la méthode helper au lieu de charger les vues manuellement
            $this->load_etudiant_view('etudiant/mes_groupes', $data);
        }

      private function load_etudiant_view($view, $data = array()) {

        if (!isset($data['menus_etudiant'])) {
            $this->load->model('Menu_model');
            $data['menus_etudiant'] = $this->Menu_model->get_menus_etudiant_actifs();
        }          
          
          $this->load->view('templates/header', $data);
          $this->load->view('templates/student_sidebar', $data);
          $this->load->view('templates/navbar', $data);
          $this->load->view($view, $data);
          $this->load->view('templates/footer', $data);
        
      }
}
