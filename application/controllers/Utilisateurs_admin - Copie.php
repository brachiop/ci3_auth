<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateurs_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Utilisateur_model');
        
        // Vérifier que c'est un SUPER_ADMIN
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('ROLE') !== 'SUPER_ADMIN') {
            redirect('auth/admin');
        }
    }

    /**
     * Liste des utilisateurs
     */
    public function index($offset = 0) {
        // Pagination
        $config = [
            'base_url' => site_url('utilisateurs_admin/index'),
            'total_rows' => $this->Utilisateur_model->count_utilisateurs(),
            'per_page' => 10,
            'uri_segment' => 3
        ];
        
        $this->load->library('pagination', $config);
        
        $data['utilisateurs'] = $this->Utilisateur_model->get_all_utilisateurs(10, $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Gestion des Utilisateurs';
        
        $this->load->view('admin/utilisateurs_liste', $data);
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function creer() {
        $this->load->library('form_validation');
        
        $data['title'] = 'Créer un Utilisateur';
        $data['roles'] = ['SUPER_ADMIN', 'ADMIN', 'GUICHET'];
        
        $this->form_validation->set_rules('login', 'Login', 'required|min_length[3]');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('role', 'Rôle', 'required');
        $this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[6]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/utilisateur_creer', $data);
        } else {
            // Vérifier si le login existe déjà
            if ($this->Utilisateur_model->login_existe($this->input->post('login'))) {
                $this->session->set_flashdata('error', 'Ce login existe déjà.');
                $this->load->view('admin/utilisateur_creer', $data);
                return;
            }
            
            $user_data = [
                'LOGIN' => $this->input->post('login'),
                'NOM' => $this->input->post('nom'),
                'PRENOM' => $this->input->post('prenom'),
                'EMAIL' => $this->input->post('email'),
                'ROLE' => $this->input->post('role'),
                'MOTDEPASSE' => $this->input->post('motdepasse'),
                'CIN' => $this->input->post('cin'),
                'STATUT' => 'ACTIF'
            ];
            
            if ($this->Utilisateur_model->creer_utilisateur($user_data)) {
                $this->session->set_flashdata('success', 'Utilisateur créé avec succès.');
                redirect('utilisateurs_admin');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors de la création.');
                $this->load->view('admin/utilisateur_creer', $data);
            }
        }
    }

    /**
     * Modifier un utilisateur
     */
    public function modifier($id) {
        $this->load->library('form_validation');
        
        $utilisateur = $this->Utilisateur_model->get_utilisateur_by_id($id);
        if (!$utilisateur) {
            show_404();
        }
        
        $data['utilisateur'] = $utilisateur;
        $data['title'] = 'Modifier ' . $utilisateur['PRENOM'] . ' ' . $utilisateur['NOM'];
        $data['roles'] = ['SUPER_ADMIN', 'ADMIN', 'GUICHET'];
        
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('role', 'Rôle', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/utilisateur_modifier', $data);
        } else {
            $user_data = [
                'NOM' => $this->input->post('nom'),
                'PRENOM' => $this->input->post('prenom'),
                'EMAIL' => $this->input->post('email'),
                'ROLE' => $this->input->post('role'),
                'CIN' => $this->input->post('cin')
            ];
            
            // Mot de passe optionnel
            if ($this->input->post('motdepasse')) {
                $user_data['MOTDEPASSE'] = $this->input->post('motdepasse');
            }
            
            if ($this->Utilisateur_model->modifier_utilisateur($id, $user_data)) {
                $this->session->set_flashdata('success', 'Utilisateur modifié avec succès.');
                redirect('utilisateurs_admin');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors de la modification.');
                $this->load->view('admin/utilisateur_modifier', $data);
            }
        }
    }

    /**
     * Changer le statut d'un utilisateur
     */
    public function changer_statut($id) {
        $utilisateur = $this->Utilisateur_model->get_utilisateur_by_id($id);
        if (!$utilisateur) {
            show_404();
        }
        
        $nouveau_statut = $utilisateur['STATUT'] == 'ACTIF' ? 'INACTIF' : 'ACTIF';
        
        if ($this->Utilisateur_model->changer_statut($id, $nouveau_statut)) {
            $this->session->set_flashdata('success', 'Statut modifié avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors du changement de statut.');
        }
        
        redirect('utilisateurs_admin');
    }
}
?>