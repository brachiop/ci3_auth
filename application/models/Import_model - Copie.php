<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

public function importer_filieres_csv($fichier_path) {
    $resultat = array('importes' => 0, 'erreurs' => 0, 'ignores' => 0);
    
    echo "<p>DEBUG: Chemin fichier: " . $fichier_path . "</p>";
    
    // Vérifier que le fichier existe
    if (!file_exists($fichier_path)) {
        echo "<p>DEBUG: Fichier non trouvé</p>";
        return $resultat;
    }
    
    echo "<p>DEBUG: Fichier trouvé, taille: " . filesize($fichier_path) . " bytes</p>";
    
    if (($file = fopen($fichier_path, "r")) === FALSE) {
        echo "<p>DEBUG: Impossible d'ouvrir le fichier</p>";
        return $resultat;
    }
    
    // Lire les entêtes
    $entetes = fgetcsv($file, 1000, ",");
    echo "<p>DEBUG: Entêtes: " . implode(', ', $entetes) . "</p>";
    
    if (!$entetes) {
        echo "<p>DEBUG: Aucune entête trouvée</p>";
        fclose($file);
        return $resultat;
    }
    
    // Normaliser les entêtes
    $entetes = array_map('trim', $entetes);
    $entetes = array_map('strtoupper', $entetes);
    
    $ligne_num = 1;
    
    while (($ligne = fgetcsv($file, 1000, ",")) !== FALSE) {
        $ligne_num++;
        echo "<p>DEBUG: Ligne $ligne_num: " . implode(', ', $ligne) . "</p>";
        
        // Ignorer les lignes vides
        if (count(array_filter($ligne)) === 0) {
            echo "<p>DEBUG: Ligne vide ignorée</p>";
            continue;
        }
        
        // Vérifier le nombre de colonnes
        if (count($ligne) != count($entetes)) {
            echo "<p>DEBUG: Nombre de colonnes incorrect (attendu: " . count($entetes) . ", trouvé: " . count($ligne) . ")</p>";
            $resultat['erreurs']++;
            continue;
        }
        
        $data = array_combine($entetes, $ligne);
        $data = array_map('trim', $data);
        
        echo "<p>DEBUG: Données combinées: " . print_r($data, true) . "</p>";
        
        // Validation des champs requis
        if (empty($data['CODE_FIL']) || empty($data['LIBEL_FIL'])) {
            echo "<p>DEBUG: Champs CODE_FIL ou LIBEL_FIL manquants</p>";
            $resultat['erreurs']++;
            continue;
        }
        
        // Vérifier si la filière existe déjà
        $this->db->where('CODE_FIL', $data['CODE_FIL']);
        $existe = $this->db->get('filieres')->row();
        
        if ($existe) {
            echo "<p>DEBUG: Filière existe déjà: " . $data['CODE_FIL'] . "</p>";
            $resultat['ignores']++;
        } else {
            echo "<p>DEBUG: Insertion nouvelle filière: " . $data['CODE_FIL'] . "</p>";
            $this->db->insert('filieres', $data);
            $resultat['importes']++;
            
            // Vérifier l'erreur SQL
            if ($this->db->error()['code']) {
                echo "<p>DEBUG: Erreur SQL: " . $this->db->error()['message'] . "</p>";
            }
        }
    }
    
    fclose($file);
    echo "<p>DEBUG: Import terminé - Total: " . $resultat['importes'] . "</p>";
    return $resultat;
}

}
?>