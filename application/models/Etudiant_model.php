<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_model extends CI_Model {
    
    private $tbl_filieres;
    private $tbl_parcours;
    private $tbl_modules;
    private $tbl_inscription;
    private $nbr_modules;
    
    public function __construct() {
        parent::__construct();
                // Charger la configuration
                $this->config->load('parametrage');        
    
          // Récupérer les noms de tables
          $this->tbl_filieres = $this->config->item('tbl_filieres');
          $this->tbl_parcours = $this->config->item('tbl_parcours');
          $this->tbl_modules = $this->config->item('tbl_modules');
          $this->tbl_inscription = $this->config->item('tbl_inscription');
          $this->nbr_modules = $this->config->item('nbr_modules');
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
          $query = $this->db->get($this->tbl_inscription);
          return $query->result_array();
      }         

      public function get_infos_etudiant_complet($cne)
      {
          
          // Utiliser les variables dans les requêtes
          $this->db->where('CNE', $cne);
          $query_inscription = $this->db->get($this->tbl_inscription); 
          
          if ($query_inscription->num_rows() > 0) {
              $inscription_data = $query_inscription->row_array();
              $code_fil = $inscription_data['CODE_FIL'];
              $code_parc = $inscription_data['CODE_PARC'];
              
              // Récupérer infos filière
              $this->db->where('CODE_FIL', $code_fil);
              $filiere = $this->db->get($this->tbl_filieres)->row_array();
              
              // Récupérer infos parcours si différent
              $parcours = null;
              if ($code_parc != $code_fil) {
                  $this->db->where('CODE_FIL', $code_fil);
                  $this->db->where('CODE_PARC', $code_parc);
                  $parcours = $this->db->get($this->tbl_parcours)->row_array();
              }
              
              $modules_automne = array();
              $modules_printemps = array();
              
              // Parcourir les modules M1 à M42
              for ($i = 1; $i <= $this->nbr_modules; $i++) {
                  $module_key = 'M' . $i;
                  $ni_key = 'M' . $i . '_NI';
                  
                  if (isset($inscription_data[$module_key]) && $inscription_data[$module_key] == 'I') {
                      // Calculer le semestre
                      $semestre = ceil($i / 7);
                      
                      // Chercher les détails du module avec conditions différentes selon le semestre
                      $this->db->where('CODE_FIL', $code_fil);
                      
                      if ($semestre >= 5) {
                          // Semestres 5-6 : chercher avec parcours
                          $this->db->where('CODE_PARC', $code_parc);
                      }
                      // Semestres 1-4 : pas de condition CODE_PARC (recherche seulement par filière)
                      
                      $this->db->where('SEMESTRE', $semestre);
                      $this->db->where('CODE_MAPG', 'M' . $i);
                      $query_module = $this->db->get($this->tbl_modules);
                      
                      $module_details = array(
                          'module_num' => 'M' . $i,
                          'semestre' => $semestre,
                          'ni' => isset($inscription_data[$ni_key]) ? $inscription_data[$ni_key] : 0,
                          'code_mod' => 'N/A',
                          'libelle_mod' => 'Module M' . $i,
                          'recherche_par' => ($semestre >= 5) ? 'filiere_parcours' : 'filiere_seule'
                      );
                      
                      if ($query_module->num_rows() > 0) {
                          $module_data = $query_module->row_array();
                          $module_details['code_mod'] = $module_data['CODE_MOD'];
                          $module_details['libelle_mod'] = $module_data['LIBEL_MOD'];
                          $module_details['periode'] = $module_data['PERIODE'];
                      } else {
                          // Debug: voir pourquoi la recherche échoue
                          $module_details['debug'] = "Recherche: CODE_FIL=$code_fil, SEMESTRE=$semestre, CODE_MAPG=M$i" . 
                                                    ($semestre >= 5 ? ", CODE_PARC=$code_parc" : "");
                      }
                      
                      // Séparer par période
                      if (isset($module_details['periode']) && $module_details['periode'] == 'A') {
                          $modules_automne[] = $module_details;
                      } else {
                          $modules_printemps[] = $module_details;
                      }
                  }
              }
              
              return array(
                  'filiere' => $filiere,
                  'parcours' => $parcours,
                  'modules_automne' => $modules_automne,
                  'modules_printemps' => $modules_printemps,
                  'code_fil' => $code_fil,
                  'code_parc' => $code_parc,
                  'etudiant_info' => array(
                      'cne' => $inscription_data['CNE'],
                      'nom_prenom' => $inscription_data['NOM_PRENOM'],
                      'c_massar' => $inscription_data['C_MASSAR']
                  )
              );
          }
          
          return null;
      }

      public function get_sections_etudiant($cne)
      {
          $this->db->where('CNE', $cne);
          $this->db->order_by('SEMESTRE', 'ASC');
          return $this->db->get('sections')->result_array();
      }

}
?>