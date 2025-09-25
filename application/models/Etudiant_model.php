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
    public function get_etudiant_by_id($id)
        {
            $this->db->where('ID', $id);
            $query = $this->db->get('etudiants');
            return $query->row_array();
        }

/*    public function get_etudiant_by_id($id) {
        $query = $this->db->get_where('etudiants', array('ID' => $id));
        return $query->row_array();
    }
*/    

    /**
     * Récupérer les étudiants paginés
     */
    public function get_etudiants_pagines($limit, $offset)
    {
        $this->db->order_by('NOM, PRENOM');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('etudiants');
        return $query->result_array();
    }

    /**
     * Rechercher des étudiants
     */
    public function rechercher_etudiants($term)
    {
        $this->db->like('NOM', $term);
        $this->db->or_like('PRENOM', $term);
        $this->db->or_like('CNE', $term);
        $this->db->or_like('C_MASSAR', $term);
        $this->db->order_by('NOM, PRENOM');
        $query = $this->db->get('etudiants');
        return $query->result_array();
    }

    /**
     * Récupérer un étudiant par CNE
     */
    public function get_etudiant_by_cne($cne) {
        $query = $this->db->get_where('etudiants', array('CNE' => $cne));
        return $query->row_array();
    }

    /**
     * Vérifie si un étudiant est autorisé à se connecter
     */
    public function get_autorisation($cne) {
        $query = $this->db->get_where('autorise', array('CNE' => $cne));
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
       * Compter le nombre total d'étudiants
       */
      public function get_total_etudiants()
      {
          return $this->db->count_all('etudiants');
      }

      /**
       * Compter les étudiants connectés aujourd'hui
       */
      public function get_connectes_aujourdhui()
      {
          $today = date('Y-m-d');
          $this->db->where('DATE', $today);
          $this->db->distinct('CNE');
          return $this->db->count_all_results('connectes');
      }

      /**
       * Récupérer les dernières connexions
       */
      public function get_dernieres_connexions($limit = 5)
      {
          $this->db->select('c.*, e.NOM, e.PRENOM');
          $this->db->from('connectes c');
          $this->db->join('etudiants e', 'c.CNE = e.CNE');
          $this->db->order_by('c.DATE DESC, c.HEURE DESC');
          $this->db->limit($limit);
          $query = $this->db->get();
          return $query->result_array();
      } 
      
      /**
       * Récupérer l'historique des connexions d'un étudiant
       */
      public function get_historique_connexions($cne, $limit = 10)
      {
          $this->db->where('CNE', $cne);
          $this->db->order_by('DATE DESC, HEURE DESC');
          $this->db->limit($limit);
          $query = $this->db->get('connectes');
          return $query->result_array();
      }
      
      // ===================== Données académiques =====================
      /**
       * Récupérer les notes d'un étudiant
       */
      public function get_notes_etudiant($cne)
      {
          $this->db->where('CNE', $cne);
          $this->db->order_by('ANNEE_UNIV DESC, CODE_MOD');
          $query = $this->db->get('examens');
          return $query->result_array();
      }

      /**
       * Récupérer les inscriptions d'un étudiant
       */

      public function get_inscriptions_etudiant($cne)
      {
          $this->db->where('CNE', $cne);
          $this->db->order_by('ANNEE_UNIV DESC, CODE_MOD');
          $query = $this->db->get('inscription');
          return $query->result_array();
      }         




    /**
     * Récupérer les notes d'un étudiant
     */
/*
    public function get_notes_etudiant($cne) {
        $this->db->where('CNE', $cne);
        $query = $this->db->get('examens');
        return $query->result_array();
    }
*/
    /**
     * Récupérer les inscriptions d'un étudiant
     */
/*     
    public function get_inscriptions_etudiant($cne) {
        $this->db->where('CNE', $cne);
        $query = $this->db->get('inscription');
        return $query->result_array();
    }
*/



}
?>