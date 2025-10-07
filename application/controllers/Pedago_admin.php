<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedago_admin extends CI_Controller {
            private $tbl_filieres;
            private $tbl_parcours;
            private $tbl_modules;
        public function __construct() {
            parent::__construct();
            
            // Vérifier les permissions pour SUPER_ADMIN et ADMIN
            if (!$this->session->userdata('admin_loggedin') || 
                !in_array($this->session->userdata('role'), ['SUPER_ADMIN', 'ADMIN'])) {
                redirect('auth/admin'); // Redirige vers la page admin d'auth
            }
            
              $this->config->load('parametrage');
              $this->tbl_filieres = $this->config->item('tbl_filieres');
              $this->tbl_parcours = $this->config->item('tbl_parcours');
              $this->tbl_modules = $this->config->item('tbl_modules');
            
              $this->load->model('Pedago_model');
        }
        
        public function filieres()
        {
            if (!$this->session->userdata('admin_loggedin')) {
                redirect('auth/login');
            }

            $data['page_title'] = 'Gestion des Filieres';
            $data['active_menu'] = 'filieres';
            
            // Récupérer toutes les filières
            $data['filieres'] = $this->Pedago_model->get_all_filieres();
            
            $this->load->view('admin/liste_filieres', $data);
        }


        public function parcours()
        {
            if (!$this->session->userdata('admin_loggedin')) {
                redirect('auth/login');
            }

            $data['page_title'] = 'Gestion des Parcours';
            $data['active_menu'] = 'parcours';
            
            // Récupérer tous les parcours
            $data['parcours'] = $this->Pedago_model->get_all_parcours();
            
            $this->load->view('admin/liste_parcours', $data);
        }

        public function modules()
        {
            if (!$this->session->userdata('admin_loggedin')) {
                redirect('auth/login');
            }

            $data['page_title'] = 'Gestion des Modules';
            $data['active_menu'] = 'modules';
            
            // Récupérer tous les modules
            $data['modules'] = $this->Pedago_model->get_all_modules();
            
            $this->load->view('admin/liste_modules', $data);
        }
}
?>