<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ===================== Gestion des ÉTUDIANTS =====================

    /**
     * Récupérer un étudiant par CNE ou C_MASSAR
     */
    public function get_etudiant_by_identifier($identifier) {
        if (ctype_alpha(substr($identifier, 0, 1))) {
            $query = $this->db->get_where('etudiants', array('C_MASSAR' => $identifier));
        } else {
            $query = $this->db->get_where('etudiants', array('CNE' => $identifier));
        }
        return $query->row_array();
    }

    /**
     * Récupérer un étudiant par ID
     */
    public function get_etudiant_by_id($id) {
        $query = $this->db->get_where('etudiants', array('ID' => $id));
        return $query->row_array();
    }

    /**
     * Récupérer un étudiant par CNE
     */
    public function get_etudiant_by_cne($cne) {
        $query = $this->db->get_where('etudiants', array('CNE' => $cne));
        return $query->row_array();
    }

    /**
     * Récupérer tous les étudiants (pour admin)
     */
    public function get_all_etudiants() {
        $query = $this->db->get('etudiants');
        return $query->result_array();
    }

    /**
     * Vérifie si un étudiant est autorisé à se connecter
     */
    public function get_autorisation($cne) {
        $query = $this->db->get_where('autorise', array('CNE' => $cne));
        return $query->row_array();
    }

    /**
     * CRUD Étudiants
     */
    public function create_etudiant($etudiant_data) {
        return $this->db->insert('etudiants', $etudiant_data);
    }

    public function update_etudiant($id, $etudiant_data) {
        $this->db->where('ID', $id);
        return $this->db->update('etudiants', $etudiant_data);
    }

    public function delete_etudiant($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('etudiants');
    }

    // ===================== Données académiques =====================

    /**
     * Récupérer les notes d'un étudiant
     */
    public function get_notes_etudiant($cne) {
        $this->db->where('CNE', $cne);
        $query = $this->db->get('examens');
        return $query->result_array();
    }

    /**
     * Récupérer les inscriptions d'un étudiant
     */
    public function get_inscriptions_etudiant($cne) {
        $this->db->where('CNE', $cne);
        $query = $this->db->get('inscription');
        return $query->result_array();
    }

    // ===================== Connexion =====================    
        /**
     * Enregistrer la connexion d'un étudiant
     */
    public function set_connecte($cne) {
        $data = array(
            'CNE' => $cne,
            'DATE' => date('Y-m-d'),
            'HEURE' => date('H:i:s')
        );
        $this->db->insert('CONNECTES', $data);
    }

}
?>