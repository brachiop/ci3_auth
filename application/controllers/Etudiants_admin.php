<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiants_admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Etudiant_model');
        
        if (!$this->session->userdata('admin_loggedin')) {
            redirect('auth/admin');
        }
    }

    /**
     * Liste des étudiants avec pagination
     */
    public function index($offset = 0)
    {
        $search = $this->input->get('search');
        
        if ($search) {
            // Mode recherche
            $data['etudiants'] = $this->Etudiant_model->rechercher_etudiants($search);
            $data['pagination'] = ''; // Pas de pagination en mode recherche
        } else {
            // Mode normal avec pagination
            $config = [
                'base_url' => site_url('etudiants_admin/index'),
                'total_rows' => $this->Etudiant_model->get_total_etudiants(),
                'per_page' => 10,
                'uri_segment' => 3
            ];
            
            $this->load->library('pagination', $config);
            $data['etudiants'] = $this->Etudiant_model->get_etudiants_pagines(10, $offset);
            $data['pagination'] = $this->pagination->create_links();
        }
        
        $data['title'] = 'Gestion des Étudiants';
        
        $this->load->view('admin/etudiants_liste', $data);
    }

    /**
     * Voir les détails d'un étudiant
     */
    public function voir($id)
    {
        $etudiant = $this->Etudiant_model->get_etudiant_by_id($id);
        
        if (!$etudiant) {
            show_404();
        }
        
        $data['etudiant'] = $etudiant;
        $data['title'] = 'Détails de ' . $etudiant['PRENOM'] . ' ' . $etudiant['NOM'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/etudiant_voir', $data);
        $this->load->view('templates/footer');
    }
}