<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Vérifie la connexion administrateur/enseignant/gestionnaire
     * @param string $login
     * @param string $motdepasse
     * @return array|false
     */
    public function login($login, $motdepasse) {
        $this->db->where('LOGIN', $login);
        $this->db->where('MOTDEPASSE', $motdepasse); 
        // ⚠️ si tu veux du hashage : $this->db->where('MOTDEPASSE', md5($motdepasse));

        $query = $this->db->get('users');
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }
        return false;
    }
}
