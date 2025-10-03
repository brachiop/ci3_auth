<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function importer_filieres_csv($fichier_path) {
        $resultat = array('importes' => 0, 'erreurs' => 0, 'ignores' => 0);
        
        if (!file_exists($fichier_path)) {
            return $resultat;
        }
        
        if (($file = fopen($fichier_path, "r")) === FALSE) {
            return $resultat;
        }
        
        // Lire les entêtes
        $entetes = fgetcsv($file, 1000, ",");
        if (!$entetes) {
            fclose($file);
            return $resultat;
        }
        
        // Normaliser les entêtes
        $entetes = array_map('trim', $entetes);
        $entetes = array_map('strtoupper', $entetes);
        
        while (($ligne = fgetcsv($file, 1000, ",")) !== FALSE) {
            // Ignorer les lignes vides
            if (count(array_filter($ligne)) === 0) {
                continue;
            }
            
            // Vérifier le nombre de colonnes
            if (count($ligne) != count($entetes)) {
                $resultat['erreurs']++;
                continue;
            }
            
            $data = array_combine($entetes, $ligne);
            $data = array_map('trim', $data);
            
            // Validation des champs requis
            if (empty($data['CODE_FIL']) || empty($data['LIBEL_FIL'])) {
                $resultat['erreurs']++;
                continue;
            }
            
            // Vérifier si la filière existe déjà
            $this->db->where('CODE_FIL', $data['CODE_FIL']);
            $existe = $this->db->get('filieres')->row();
            
            if (!$existe) {
                $this->db->insert('filieres', $data);
                $resultat['importes']++;
            } else {
                $resultat['ignores']++;
            }
        }
        
        fclose($file);
        return $resultat;
    }
}
?>
