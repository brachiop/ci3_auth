<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Import_model');
    }

public function filieres() {
    $data['title'] = 'Import Filières - CSV';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $config['upload_path'] = './uploads/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 5120;
        $config['file_name'] = 'filieres_' . date('Y-m-d_H-i-s');
        
        // Créer le dossier uploads
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('fichier_csv')) {
            $upload_data = $this->upload->data();
            
            // Importer les données
            $resultat = $this->Import_model->importer_filieres_csv($upload_data['full_path']);
            
            // Message de résultat
            $message = $resultat['importes'] . ' filière(s) importée(s) avec succès !';
            if ($resultat['ignores'] > 0) {
                $message .= ' ' . $resultat['ignores'] . ' doublon(s) ignoré(s).';
            }
            if ($resultat['erreurs'] > 0) {
                $message .= ' ' . $resultat['erreurs'] . ' erreur(s) de format.';
            }
            
            $this->session->set_flashdata('success', $message);
            
            // Nettoyer le fichier
            unlink($upload_data['full_path']);
            
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de l\'upload : ' . $this->upload->display_errors());
        }
        
        redirect('import/filieres');
    }
    
    $this->load->view('admin/import_filieres', $data);
}
    
public function download_template_filieres() {
    // En-têtes pour forcer le téléchargement
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=template_filieres.csv');
    
    // Créer le fichier CSV de sortie
    $output = fopen('php://output', 'w');
    
    // Entêtes du template
    fputcsv($output, array('CODE_FIL', 'LIBEL_FIL', 'TYPE', 'SEM_DEPART', 'NB_PARC', 'DISCIPLINE'));
    
    // Exemples de données
    fputcsv($output, array('INFO', 'Informatique', 'LICENCE', '1', '4', 'Sciences'));
    fputcsv($output, array('MATH', 'Mathématiques', 'LICENCE', '1', '3', 'Sciences'));
    fputcsv($output, array('PHYS', 'Physique', 'LICENCE', '1', '3', 'Sciences'));
    
    fclose($output);
    exit;
}    

    
}
?>