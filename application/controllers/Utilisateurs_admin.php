<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateurs_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        
        // Vérifier que c'est un SUPER_ADMIN
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('role') !== 'SUPER_ADMIN') {
            redirect('auth/admin');
        }
    }

/*
    public function index() {
        $data['title'] = 'Gestion des Utilisateurs - SUPER ADMIN';
        
        // Charger selon votre structure template
        $this->load->view('templates/header', $data);
        $this->load->view('admin/utilisateurs_simple', $data); // Vue simple pour tester
        $this->load->view('templates/footer');
    }
*/
    
    public function index($offset = 0) {
        // Configurer la pagination
        $config = [
            'base_url' => site_url('utilisateurs_admin/index'),
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
    
}