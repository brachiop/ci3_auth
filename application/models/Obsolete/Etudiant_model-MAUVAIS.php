<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Vérifie la connexion étudiant
     * @param string $username (CNE ou MASSAR)
     * @param string $password (CIN)
     * @return array|false
     */
    public function login($username, $password) {
        $this->db->where('CNE', $username);
        $this->db->or_where('C_MASSAR', $username);
        $this->db->where('CIN', $password);

        $query = $this->db->get('etudiants');
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return false;
    }
}
