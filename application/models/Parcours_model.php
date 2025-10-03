<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parcours_model extends CI_Model {
    
    // Pas besoin de constructeur
    public function importer_parcours_csv($fichier_path) {
        // $this->db est disponible directement
        $this->db->insert('parcours', $data);
        // ...
    }
}
?>