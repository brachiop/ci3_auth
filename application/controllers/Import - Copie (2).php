<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Vérifier les permissions admin - AVEC LA BONNE VARIABLE DE SESSION
        if (!$this->session->userdata('admin_loggedin') || $this->session->userdata('role') !== 'SUPER_ADMIN') {
            redirect('auth/admin'); // Redirige vers la page admin d'auth
        }
        
        $this->load->model('Import_model');
    }

public function filieres() {
    $data['title'] = 'Import Filières - CSV';
    
    if ($this->input->post()) {
        echo "<h3>DEBUG: Formulaire reçu</h3>";
        
        $config['upload_path'] = './uploads/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 5120;
        
        // Créer le dossier
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
            echo "<p>DEBUG: Dossier créé</p>";
        }
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('fichier_csv')) {
            $upload_data = $this->upload->data();
            echo "<p>DEBUG: Fichier uploadé: " . $upload_data['full_path'] . "</p>";
            
            $resultat = $this->Import_model->importer_filieres_csv($upload_data['full_path']);
            echo "<p>DEBUG: Résultat - Importés: " . $resultat['importes'] . ", Erreurs: " . $resultat['erreurs'] . "</p>";
            
            // Nettoyer
            unlink($upload_data['full_path']);
            
            echo "<hr><a href='" . site_url('import/filieres') . "'>Retour</a>";
            return;
            
        } else {
            echo "<p>DEBUG: Erreur upload: " . $this->upload->display_errors() . "</p>";
        }
    }
    
    $this->load->view('admin/import_filieres', $data);
}

// Créez un contrôleur test temporaire
public function test_path() {
    echo "<h3>Informations serveur :</h3>";
    echo "<p>DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
    echo "<p>SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "</p>";
    echo "<p>PHP_SELF: " . $_SERVER['PHP_SELF'] . "</p>";
    
    // Test d'écriture
    $test_path = $_SERVER['DOCUMENT_ROOT'] . '/ci3_auth/uploads/';
    echo "<p>Test path: " . $test_path . "</p>";
    echo "<p>Dossier existe? " . (is_dir($test_path) ? 'OUI' : 'NON') . "</p>";
    
    if (!is_dir($test_path)) {
        mkdir($test_path, 0777, true);
        echo "<p>Dossier créé</p>";
    }
}

public function test() {
    echo "<h1>TEST - Contrôleur Import accessible</h1>";
    echo "<p>Si vous voyez ce message, le contrôleur fonctionne</p>";
    echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";
    
    // Test de la session
    echo "<h2>Session data:</h2>";
    echo "<pre>";
    print_r($this->session->all_userdata());
    echo "</pre>";
    
    // Test de la base de données
    echo "<h2>Test base de données:</h2>";
    $query = $this->db->get('filieres');
    echo "Nombre de filières: " . $query->num_rows();
}

public function test_upload() {
    echo "<h1>TEST UPLOAD SIMPLIFIÉ</h1>";
    
    if ($_POST) {
        echo "<h2>POST Data:</h2>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        echo "<h2>FILES Data:</h2>";
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        
        if (isset($_FILES['fichier_csv'])) {
            echo "<h2>Détails du fichier:</h2>";
            echo "Nom: " . $_FILES['fichier_csv']['name'] . "<br>";
            echo "Taille: " . $_FILES['fichier_csv']['size'] . "<br>";
            echo "Type: " . $_FILES['fichier_csv']['type'] . "<br>";
            echo "Erreur: " . $_FILES['fichier_csv']['error'] . "<br>";
            
            // Test d'upload manuel
            $upload_dir = './uploads/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            
            if (move_uploaded_file($_FILES['fichier_csv']['tmp_name'], $upload_dir . $_FILES['fichier_csv']['name'])) {
                echo "<p style='color: green;'>SUCCÈS: Fichier uploadé manuellement</p>";
            } else {
                echo "<p style='color: red;'>ÉCHEC: Upload manuel</p>";
            }
        }
        
        echo "<hr><a href='" . site_url('import/test_upload') . "'>Retour</a>";
        return;
    }
    ?>
    
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="fichier_csv" required>
        <button type="submit">TEST Upload</button>
    </form>
    
    <?php
}

public function test_upload_debug() {
    echo "<h1>TEST UPLOAD DEBUG COMPLET</h1>";
    
    // Afficher toutes les infos serveur
    echo "<h2>Server Info:</h2>";
    echo "PHP Version: " . phpversion() . "<br>";
    echo "Max Upload: " . ini_get('upload_max_filesize') . "<br>";
    echo "Max Post: " . ini_get('post_max_size') . "<br>";
    
    // Vérifier si on a une soumission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2 style='color: green;'>✅ FORMULAIRE SOUMIS (POST détecté)</h2>";
        
        echo "<h3>Données POST:</h3>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        echo "<h3>Données FILES:</h3>";
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        
        if (empty($_FILES)) {
            echo "<p style='color: red;'>❌ Aucun fichier dans \$_FILES - problème avec enctype?</p>";
        }
        
        if (isset($_FILES['fichier_csv'])) {
            echo "<h3>Détails du fichier:</h3>";
            echo "Nom: " . $_FILES['fichier_csv']['name'] . "<br>";
            echo "Taille: " . $_FILES['fichier_csv']['size'] . " bytes<br>";
            echo "Type: " . $_FILES['fichier_csv']['type'] . "<br>";
            echo "Temp: " . $_FILES['fichier_csv']['tmp_name'] . "<br>";
            echo "Erreur: " . $_FILES['fichier_csv']['error'] . "<br>";
            
            // Vérifier l'erreur
            if ($_FILES['fichier_csv']['error'] > 0) {
                echo "<p style='color: red;'>❌ Erreur upload: " . $this->get_upload_error($_FILES['fichier_csv']['error']) . "</p>";
            } else {
                echo "<p style='color: green;'>✅ Fichier reçu sans erreur</p>";
                
                // Test d'upload manuel
                $upload_dir = './uploads/test/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
                
                $destination = $upload_dir . $_FILES['fichier_csv']['name'];
                if (move_uploaded_file($_FILES['fichier_csv']['tmp_name'], $destination)) {
                    echo "<p style='color: green;'>✅ SUCCÈS: Fichier sauvegardé à: " . $destination . "</p>";
                    
                    // Lire le contenu
                    $contenu = file_get_contents($destination);
                    echo "<h3>Contenu du fichier (premières 500 caractères):</h3>";
                    echo "<pre>" . htmlspecialchars(substr($contenu, 0, 500)) . "</pre>";
                } else {
                    echo "<p style='color: red;'>❌ ÉCHEC: Impossible de sauvegarder le fichier</p>";
                }
            }
        }
    } else {
        echo "<h2 style='color: orange;'>En attente de soumission formulaire (GET)</h2>";
    }
    ?>

    <h2>Formulaire de test:</h2>
    <form method="post" enctype="multipart/form-data" onsubmit="console.log('Formulaire soumis')">
        <div>
            <label>Sélectionnez un fichier CSV:</label><br>
            <input type="file" name="fichier_csv" accept=".csv" required>
        </div>
        <br>
        <button type="submit" onclick="console.log('Bouton cliqué')">TESTER L'UPLOAD</button>
    </form>

    <script>
    console.log('Page test_upload_debug chargée');
    
    // Surveiller la soumission
    document.querySelector('form').addEventListener('submit', function(e) {
        console.log('🔔 FORMULAIRE SOUMIS - Fichier:', document.querySelector('input[type="file"]').files[0]);
    });
    
    // Surveiller les changements de fichier
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        console.log('📁 Fichier sélectionné:', e.target.files[0]);
    });
    </script>

    <?php
}

private function get_upload_error($error_code) {
    $errors = array(
        0 => 'Aucune erreur',
        1 => 'Fichier trop volumineux (upload_max_filesize)',
        2 => 'Fichier trop volumineux (MAX_FILE_SIZE)',
        3 => 'Fichier partiellement uploadé',
        4 => 'Aucun fichier uploadé',
        6 => 'Dossier temporaire manquant',
        7 => 'Échec écriture disque',
        8 => 'Extension PHP arrêtée'
    );
    return isset($errors[$error_code]) ? $errors[$error_code] : 'Erreur inconnue';
}

}
?>