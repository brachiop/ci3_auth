<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Pedago_model extends CI_Model {
            
            private $tbl_filieres;
            private $tbl_parcours;
            private $tbl_modules;
          public function __construct() {
              parent::__construct();
                  $this->config->load('parametrage');
                  // Initialiser les variables pour toutes les méthodes
                  $this->tbl_filieres = $this->config->item('tbl_filieres');
                  $this->tbl_parcours = $this->config->item('tbl_parcours');
                  $this->tbl_modules = $this->config->item('tbl_modules');
          }
          
          public function get_all_filieres()
          {
                $query = $this->db->get($this->tbl_filieres);
                return $query->result_array(); 
          }

          public function get_all_parcours()
          {
              $query = $this->db->get($this->tbl_parcours);
              return $query->result_array();
          }

          public function get_all_modules()
          {
              $query = $this->db->get($this->tbl_modules);
              return $query->result_array();
          }
    }
?>
