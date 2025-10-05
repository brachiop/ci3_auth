<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parametrage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_loggedin') || 
            !in_array($this->session->userdata('role'), ['SUPER_ADMIN', 'ADMIN'])) {
            redirect('auth/login');
        }
        $this->load->model('Parametrage_model');
    }

    public function index()
    {
        $data['page_title'] = 'Paramétrage de l\'Application';
        $data['active_menu'] = 'parametrage';
        $data['parametres'] = $this->Parametrage_model->get_parametrage();
        $data['config_file'] = file_get_contents(APPPATH . 'config/parametrage.php');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('admin/parametrage');
        $this->load->view('templates/footer');
    }

    public function sauvegarder()
    {
        if ($this->input->post()) {
            $data = array(
                'an_inscr' => $this->input->post('an_inscr'),
                'tbl_inscription' => $this->input->post('tbl_inscription'),
                'tbl_modules' => $this->input->post('tbl_modules'),
                'tbl_filieres' => $this->input->post('tbl_filieres'),
                'tbl_parcours' => $this->input->post('tbl_parcours'),
                'tbl_Fetudg' => $this->input->post('tbl_Fetudg'),
                'tbl_autorise' => $this->input->post('tbl_autorise'),
                'prefix_oletud' => $this->input->post('prefix_oletud'), 
                'nbr_modules' => $this->input->post('nbr_modules'),
                'nbr_tent' => $this->input->post('nbr_tent'),
                'updated_by' => $this->session->userdata('login')
            );
            if ($this->Parametrage_model->update_parametrage($data)) {
                // Regénérer le fichier de configuration
                if ($this->Parametrage_model->generate_config_file()) {
                    $this->session->set_flashdata('success', 'Paramètres sauvegardés et fichier de configuration régénéré avec succès!');
                } else {
                    $this->session->set_flashdata('warning', 'Paramètres sauvegardés mais erreur lors de la régénération du fichier de configuration.');
                }
            } else {
                $this->session->set_flashdata('error', 'Erreur lors de la sauvegarde des paramètres.');
            }

            redirect('parametrage');
        }
    }
}