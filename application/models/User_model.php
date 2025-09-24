<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ===================== Étudiants =====================

    /**
     * Récupérer un étudiant par CNE ou C_MASSAR
     */
    public function get_etudiant_by_identifier($identifier) {
        if (ctype_alpha(substr($identifier, 0, 1))) {
            // Commence par lettre → MASSAR
            $query = $this->db->get_where('etudiants', array('C_MASSAR' => $identifier));
        } else {
            // Commence par chiffre → CNE
            $query = $this->db->get_where('etudiants', array('CNE' => $identifier));
        }
        return $query->row_array(); // null si pas trouvé
    }

    /**
     * Vérifie si un étudiant est autorisé à se connecter
     */
    public function get_autorisation($cne) {
        $query = $this->db->get_where('autorise', array('CNE' => $cne));
        return $query->row_array(); // null si non autorisé
    }

    // ===================== Admins / Users =====================

    /**
     * Récupérer un user/admin par login
     */
    public function get_user_by_login($login) {
        $query = $this->db->get_where('users', array('LOGIN' => $login));
        return $query->row_array(); // null si pas trouvé
    }

    /**
     * Vérifier le mot de passe d'un user/admin
     */
    public function verify_user_password($login, $password) {
        $user = $this->get_user_by_login($login);
        if(!$user) return false;

        // Vérification du mot de passe (hashé)
        if(password_verify($password, $user['MOTDEPASSE'])) {
            return $user;
        }
        return false;
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

    /**
     * Enregistrer un admin connecté (optionnel)
     */
    public function set_admin_connecte($login) {
        // Ici tu peux créer une table CONNECTES_USERS si nécessaire
    }

}