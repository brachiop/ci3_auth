<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parametrage_model extends CI_Model {

    public function get_parametrage()
    {
        $query = $this->db->get('parametrage_app');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return null;
    }

    public function update_parametrage($data)
    {
        // S'assurer qu'il n'y a qu'un seul enregistrement
        $existing = $this->get_parametrage();
        
        if ($existing) {
            $this->db->where('id', $existing['id']);
            return $this->db->update('parametrage_app', $data);
        } else {
            return $this->db->insert('parametrage_app', $data);
        }
    }

    public function generate_config_file()
    {
        $parametres = $this->get_parametrage();
        if (!$parametres) return false;

        $config_content = "<?php\n";
        $config_content .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";
        $config_content .= "/*\n|--------------------------------------------------------------------------\n| Paramétrage de l'Application\n|--------------------------------------------------------------------------\n*/\n\n";

        // Champs configurables
        $config_content .= "\$config['an_inscr'] = {$parametres['an_inscr']};\n";
        $config_content .= "\$config['tbl_inscription'] = \"{$parametres['tbl_inscription']}\";\n";
        $config_content .= "\$config['tbl_modules'] = \"{$parametres['tbl_modules']}\";\n";
        $config_content .= "\$config['tbl_filieres'] = \"{$parametres['tbl_filieres']}\";\n";
        $config_content .= "\$config['tbl_parcours'] = \"{$parametres['tbl_parcours']}\";\n";
        $config_content .= "\$config['tbl_Fetudg'] = \"{$parametres['tbl_Fetudg']}\";\n";
        $config_content .= "\$config['tbl_autorise'] = \"{$parametres['tbl_autorise']}\";\n";
        $config_content .= "\$config['prefix_oletud'] = \"{$parametres['prefix_oletud']}\";\n";
        $config_content .= "\$config['nbr_modules'] = {$parametres['nbr_modules']};\n";
        $config_content .= "\$config['nbr_tent'] = {$parametres['nbr_tent']};\n";

        // Champs calculés automatiquement
        $config_content .= "\n// Champs calculés automatiquement\n";
        $config_content .= "\$config['xAU'] = substr(\$config['an_inscr'], 2, 2);\n";
        $config_content .= "\$config['tbl_oletud'] = \$config['prefix_oletud'] . \$config['xAU'];\n";
        $config_content .= "\$config['DebMod'] = 1;\n";
        $config_content .= "\$config['FinMod'] = \$config['nbr_modules'];\n";
        $config_content .= "\$config['annee_univ_format'] = (\$config['an_inscr'] - 1) . '/' . \$config['an_inscr'];\n";

        $config_content .= "\n?>";

        $file_path = APPPATH . 'config/parametrage.php';
        return file_put_contents($file_path, $config_content);
    }
}