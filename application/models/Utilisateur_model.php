<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Récupérer tous les utilisateurs (avec pagination)
     */
    public function get_all_utilisateurs($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('NOM, PRENOM');
        return $this->db->get('users')->result_array();
    }

    /**
     * Compter le nombre total d'utilisateurs
     */
    public function count_utilisateurs() {
        return $this->db->count_all('users');
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function creer_utilisateur($data) {
        // TEMPORAIREMENT : Pas de hashage du mot de passe
        // if (isset($data['MOTDEPASSE'])) {
        //     $data['MOTDEPASSE'] = password_hash($data['MOTDEPASSE'], PASSWORD_DEFAULT);
        // }
        
        $data['date_creation'] = date('Y-m-d H:i:s');
        return $this->db->insert('users', $data);
    }

    /**
     * Modifier un utilisateur
     */
    public function modifier_utilisateur($id, $data) {
        // TEMPORAIREMENT : Pas de hashage du mot de passe
        // if (isset($data['MOTDEPASSE']) && !empty($data['MOTDEPASSE'])) {
        //     $data['MOTDEPASSE'] = password_hash($data['MOTDEPASSE'], PASSWORD_DEFAULT);
        // } else {
        //     unset($data['MOTDEPASSE']);
        // }
        
        $this->db->where('ID', $id);
        return $this->db->update('users', $data);
    }

    /**
     * Changer le statut d'un utilisateur
     */
    public function changer_statut($id, $statut) {
        $this->db->where('ID', $id);
        return $this->db->update('users', ['STATUT' => $statut]);
    }

    /**
     * Vérifier si le login existe déjà
     */
    public function login_existe($login, $exclude_id = null) {
        $this->db->where('LOGIN', $login);
        if ($exclude_id) {
            $this->db->where('ID !=', $exclude_id);
        }
        return $this->db->count_all_results('users') > 0;
    }

    /**
     * Récupérer les logs des utilisateurs
     */
    public function get_logs_utilisateur($user_id, $limit = 10) {
        // À implémenter si vous avez une table de logs
        return [];
    }
    
    /**
     * Récupérer un utilisateur par son ID
     */
    public function get_utilisateur_by_id($id) {
        $this->db->where('ID', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }
}
?>