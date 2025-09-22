<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Récupère un étudiant par identifiant (CNE ou MASSAR)
    public function get_by_identifier($identifier) {
        if (ctype_alpha(substr($identifier, 0, 1))) {
            // Commence par lettre → MASSAR
            $query = $this->db->get_where('etudiants', array('C_MASSAR' => $identifier));
        } else {
            // Commence par chiffre → CNE
            $query = $this->db->get_where('etudiants', array('CNE' => $identifier));
        }
        return $query->row_array(); // null si pas trouvé
    }

    // Vérifie si l'étudiant est autorisé
    public function get_autorisation($cne) {
        $query = $this->db->get_where('autorise', array('CNE' => $cne));
        return $query->row_array(); // null si non trouvé
    }
}
