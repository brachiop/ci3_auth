<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Pedago_model extends CI_Model {

          public function get_all_filieres()
          {
                $query = $this->db->get('filieres');
                return $query->result_array(); 
          }

          public function get_all_parcours()
          {
              $query = $this->db->get('parcours');
              return $query->result_array();
          }

          public function get_all_modules()
          {
              $query = $this->db->get('modules');
              return $query->result_array();
          }
    }
?>
