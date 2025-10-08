<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
            private $tbl_filieres;
            private $tbl_parcours;
            private $tbl_modules;
        public function __construct() {
            parent::__construct();
            
            // Vérifier les permissions pour SUPER_ADMIN et ADMIN
            if (!$this->session->userdata('admin_loggedin') || 
                !in_array($this->session->userdata('role'), ['SUPER_ADMIN', 'ADMIN'])) {
                redirect('auth/admin'); // Redirige vers la page admin d'auth
            }
            
            $this->load->model('Import_model');
                  $this->config->load('parametrage');
                  // Initialiser les variables pour toutes les méthodes
                  $this->tbl_filieres = $this->config->item('tbl_filieres');
                  $this->tbl_parcours = $this->config->item('tbl_parcours');
                  $this->tbl_modules = $this->config->item('tbl_modules');
        }

        public function import($type) {
            // Validation du type
            $types_autorises = ['filieres', 'parcours', 'modules'];     // ← Ajoutez ici les nouvelles tables
            if (!in_array($type, $types_autorises)) {
                show_404();
            }

            // Double vérification de sécurité
            if (!in_array($this->session->userdata('role'), ['SUPER_ADMIN', 'ADMIN'])) {
                $this->session->set_flashdata('error', "Permission insuffisante pour importer des $type.");
                redirect('dashboard_admin');
            }

            // Configuration selon le type
            $config = [                                            // ← Ajoutez ici les nouvelles tables
                'filieres' => [                                 
                    'title' => 'Import Filières - CSV',
                    'file_prefix' => 'filieres',
                    'success_message' => 'filière(s) importée(s)',
                    'view' => 'admin/import_filieres'
                ],
                'parcours' => [
                    'title' => 'Import Parcours - CSV',
                    'file_prefix' => 'parcours',
                    'success_message' => 'parcours importé(s)',
                    'view' => 'admin/import_parcours'
                ],
                'modules' => [                                 
                    'title' => 'Import Modules - CSV',
                    'file_prefix' => 'modules',
                    'success_message' => 'module(s) importé(s)',
                    'view' => 'admin/import_modules'
                ]
            ];

            $current_config = $config[$type];
            $data['title'] = $current_config['title'];
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $upload_config['upload_path'] = './uploads/csv/';
                $upload_config['allowed_types'] = 'csv';
                $upload_config['max_size'] = 5120;
                $upload_config['file_name'] = $current_config['file_prefix'] . '_' . date('Y-m-d_H-i-s');
                
                // Créer le dossier uploads
                if (!is_dir($upload_config['upload_path'])) {
                    mkdir($upload_config['upload_path'], 0777, true);
                }
                
                $this->load->library('upload', $upload_config);
                
                if ($this->upload->do_upload('fichier_csv')) {
                    $upload_data = $this->upload->data();
                    
                    // Importer les données avec la méthode appropriée
                    $resultat = $this->Import_model->importer_csv($upload_data['full_path'], $type);
                    
                    // Message de résultat
                    $message = $resultat['importes'] . ' ' . $current_config['success_message'] . ' avec succès !';
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
                
                redirect("import/$type");
            }
            
            $this->load->view($current_config['view'], $data);
        }

        public function download_template($type) {
            $this->load->model('Import_model');
            
            $config = [                                                 // ← Ajoutez ici les nouvelles tables
                'filieres' => [
                    'filename' => 'template_filieres.csv',
                    'table' => $this->tbl_filieres
                ],
                'parcours' => [
                    'filename' => 'template_parcours.csv',
                    'table' => $this->tbl_parcours
                ],
                'modules' => [
                    'filename' => 'template_modules.csv',
                    'table' => $this->tbl_modules
                ]
            ];
            
            if (!array_key_exists($type, $config)) {
                show_404();
            }
            
            $current_config = $config[$type];
            
            // Récupérer les headers dynamiquement
            $headers = $this->Import_model->get_table_headers($current_config['table']);
            
            // Téléchargement...
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $current_config['filename'] . '"');
            
            $output = fopen('php://output', 'w');
            //fputcsv($output, $headers);
            fputcsv($output, $headers, ','); // ← 3ème paramètre = séparateur
            fclose($output);
            exit;
        }
        
        /* ==============  Vidage des tables ============== */
        public function vider_filieres()
        {
            if (!$this->session->userdata('admin_loggedin')) {
                redirect('auth/login');
            }

            //$this->load->model('Import_model');
            
            if ($this->Import_model->vider_filieres()) {
                $this->session->set_flashdata('success', 'Table filières vidée avec succès!');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors du vidage de la table filières');
            }
            
            redirect('import/filieres');
        }

        public function vider_parcours()
        {
            if (!$this->session->userdata('admin_loggedin')) {
                redirect('auth/login');
            }

            //$this->load->model('Import_model');
            
            if ($this->Import_model->vider_parcours()) {
                $this->session->set_flashdata('success', 'Table parcours vidée avec succès!');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors du vidage de la table parcours');
            }
            
            redirect('import/parcours');
        }

        public function vider_modules()
        {
            if (!$this->session->userdata('admin_loggedin')) {
                redirect('auth/login');
            }

            //$this->load->model('Import_model');
            
            if ($this->Import_model->vider_modules()) {
                $this->session->set_flashdata('success', 'Table modules vidée avec succès!');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors du vidage de la table modules');
            }
            
            redirect('import/modules');
        }
        
}
?>