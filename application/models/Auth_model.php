<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ===================== JOURNAL DES CONNEXIONS =====================

    /**
     * Enregistrer la connexion d'un étudiant
     */
    public function log_connexion_etudiant($cne) {
        $data = array(
            'CNE' => $cne,
            'DATE' => date('Y-m-d'),
            'HEURE' => date('H:i:s')
        );
        return $this->db->insert('connectes', $data);
    }

    /**
     * Enregistrer la connexion d'un admin
     */
    public function log_connexion_admin($user_id) {
        // Si vous avez une table pour les logs admin
        $data = array(
            'user_id' => $user_id,
            'date_connexion' => date('Y-m-d H:i:s'),
            'ip_address' => $this->input->ip_address()
        );
        // return $this->db->insert('logs_connexion_admin', $data);
    }

    /**
     * Récupérer l'historique des connexions étudiant
     */
    public function get_historique_connexions($cne, $limit = 10) {
        $this->db->where('CNE', $cne);
        $this->db->order_by('DATE DESC, HEURE DESC');
        $this->db->limit($limit);
        $query = $this->db->get('connectes');
        return $query->result_array();
    }
}
?>