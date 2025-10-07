<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {
      
            private $tbl_filieres;
            private $tbl_parcours;
            private $tbl_modules;
                  
      public function __construct() {
          parent::__construct();
              $this->config->load('parametrage');
              $this->tbl_filieres = $this->config->item('tbl_filieres');
              $this->tbl_parcours = $this->config->item('tbl_parcours');
              $this->tbl_modules = $this->config->item('tbl_modules');
      }

      public function importer_csv($fichier_path, $type) {
          $resultat = array('importes' => 0, 'erreurs' => 0, 'ignores' => 0, 'details_erreurs' => []);
          $config = [
              'filieres' => [
                  'table' => $this->tbl_filieres,
                  'champ_cle' => 'CODE_FIL',
                  'champs_requis' => ['CODE_FIL'],
                  'success_message' => 'filière(s) importée(s)'
              ],
              'parcours' => [
                  'table' => $this->tbl_parcours, 
                  'champ_cle' => 'CODE_PARC',
                  'champs_requis' => ['CODE_PARC'],
                  'success_message' => 'parcours importé(s)'
              ],
              'modules' => [
                  'table' => $this->tbl_modules, 
                  'champ_cle' => 'CODE_MOD',
                  'champs_requis' => ['CODE_MOD'],
                  'success_message' => 'module(s) importé(s)'
              ]
          ];
          
          if (!array_key_exists($type, $config)) {
              $resultat['erreurs']++;
              $resultat['details_erreurs'][] = "Type d'import non reconnu";
              return $resultat;
          }
          
          $current_config = $config[$type];
          
          // Vérifications du fichier
          if (!file_exists($fichier_path)) {
              $resultat['details_erreurs'][] = "Fichier non trouvé";
              return $resultat;
          }
          
          $delimiter = defined('CSV_DELIMITER') ? CSV_DELIMITER : ',';
          
          if (($file = fopen($fichier_path, "r")) === FALSE) {
              $resultat['details_erreurs'][] = "Impossible d'ouvrir le fichier";
              return $resultat;
          }
          
          // Lire et valider les entêtes
          $entetes = fgetcsv($file, 1000, $delimiter);
          if (!$entetes || empty(array_filter($entetes))) {
              fclose($file);
              $resultat['details_erreurs'][] = "Fichier CSV vide ou entêtes manquantes";
              return $resultat;
          }
          
          $entetes = array_map('trim', $entetes);
          $entetes = array_map('strtoupper', $entetes);
          
          $ligne_num = 1; // Compteur de lignes pour les erreurs
          
          while (($ligne = fgetcsv($file, 1000, $delimiter)) !== FALSE) {
              $ligne_num++;
              
              // Ignorer les lignes vides
              if (count(array_filter($ligne)) === 0) {
                  continue;
              }
              
              // Vérifier le nombre de colonnes
              if (count($ligne) != count($entetes)) {
                  $resultat['erreurs']++;
                  $resultat['details_erreurs'][] = "Ligne $ligne_num: Nombre de colonnes incorrect";
                  continue;
              }
              
              $data = array_combine($entetes, $ligne);
              $data = array_map('trim', $data);
              
              // Validation des champs requis
              $champs_manquants = [];
              foreach ($current_config['champs_requis'] as $champ) {
                  if (empty($data[$champ])) {
                      $champs_manquants[] = $champ;
                  }
              }
              
              if (!empty($champs_manquants)) {
                  $resultat['erreurs']++;
                  $resultat['details_erreurs'][] = "Ligne $ligne_num: Champs requis manquants: " . implode(', ', $champs_manquants);
                  continue;
              }
              
              // Vérifier si l'entrée existe déjà
              $this->db->where($current_config['champ_cle'], $data[$current_config['champ_cle']]);
              $existe = $this->db->get($current_config['table'])->row();
              
              if (!$existe) {
                  $this->db->trans_start();
                  if ($this->db->insert($current_config['table'], $data)) {
                      $this->db->trans_complete();
                      $resultat['importes']++;
                  } else {
                      $this->db->trans_rollback();
                      $resultat['erreurs']++;
                      $resultat['details_erreurs'][] = "Ligne $ligne_num: Erreur base de données";
                  }
              } else {
                  $resultat['ignores']++;
              }
          }
          
          fclose($file);
          return $resultat;
      }

      // Récuperer les entetes des tables pour les templates à télécharger
      public function get_table_headers($table_name) {
          // Validation pour éviter les injections SQL
          $allowed_tables = [$this->tbl_filieres, $this->tbl_parcours, $this->tbl_modules]; // ← Ajoutez ici les nouvelles tables
          if (!in_array($table_name, $allowed_tables)) {
              return [];
          }
          
          $query = $this->db->query("SHOW COLUMNS FROM " . $table_name);
          $columns = $query->result_array();
          
          $headers = [];
          foreach ($columns as $column) {
              $headers[] = $column['Field'];
          }
          
          return $headers;
      } 
      
      public function vider_filieres()
      {
          return $this->db->empty_table($this->tbl_filieres);
      }

      public function vider_parcours()
      {
          return $this->db->empty_table($this->tbl_parcours);
      }

      public function vider_modules()
      {
          return $this->db->empty_table($this->tbl_modules);
      }                          
}
?>
