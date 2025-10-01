<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateurs_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('pagination');
        
        // Vérifier que c'est un SUPER_ADMIN
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('role') !== 'SUPER_ADMIN') {
            redirect('auth/admin');
        }
    }
    
    public function index($offset = 0) {
        // Configurer la pagination
        $config = [
            'base_url' => site_url('admin/utilisateurs'),
            'total_rows' => $this->User_model->count_utilisateurs(),
            'per_page' => 10,
            'uri_segment' => 3
        ];
        
        $this->load->library('pagination', $config);
        
        $data['utilisateurs'] = $this->User_model->get_utilisateurs_pagines(10, $offset);
        $data['stats'] = $this->User_model->get_stats_utilisateurs();
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Gestion des Utilisateurs';
        
        $this->load->view('admin/utilisateurs_liste', $data);
    }
    



public function creer() {
    // Charger les librairies
    $this->load->library('form_validation');
    
    // Règles de validation
    $this->form_validation->set_rules('login', 'Login', 'required|min_length[3]|is_unique[users.LOGIN]');
    $this->form_validation->set_rules('cin', 'CIN', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.EMAIL]');
    $this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[8]');
    $this->form_validation->set_rules('password_confirm', 'Confirmation mot de passe', 'required|matches[password]');
    $this->form_validation->set_rules('prenom', 'Prénom', 'required');
    $this->form_validation->set_rules('nom', 'Nom', 'required');
    $this->form_validation->set_rules('role', 'Rôle', 'required');

    if ($this->form_validation->run() === TRUE) {
        $user_data = array(
            'LOGIN' => $this->input->post('login'),
            'CIN' => $this->input->post('cin'),
            'EMAIL' => $this->input->post('email'),
            'MOTDEPASSE' => $this->input->post('password'),
            'PRENOM' => $this->input->post('prenom'),
            'NOM' => $this->input->post('nom'),
            'ROLE' => $this->input->post('role'),
            'STATUT' => 1,
            'DATE_CREATION' => date('Y-m-d H:i:s'),
            'DERNIER_ACCES' => NULL,
            'PERMISSIONS' => ''
        );

        if ($this->User_model->creer_utilisateur($user_data)) {
            $this->session->set_flashdata('success', 'Utilisateur créé avec succès !');
            redirect('admin/utilisateurs', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de la création de l\'utilisateur.');
        }
    }

    $data['title'] = 'Créer un nouvel utilisateur';
    $data['roles'] = ['SUPER_ADMIN', 'ADMIN', 'GUICHET', 'ETUDIANT'];

    $this->load->view('admin/creer_utilisateur', $data);
}







public function editer($user_id) {
    // Formulaire pré-rempli
    // Validation + mise à jour
} 

public function changer_statut($user_id) {
    // Basculer entre ACTIF/INACTIF
    // Redirection avec message flash
} 

 
    
}