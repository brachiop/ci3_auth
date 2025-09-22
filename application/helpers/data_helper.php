<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('display_value')) {
    /**
     * Affiche une valeur si elle existe, sinon une valeur par défaut.
     *
     * @param mixed  $data     Objet ou tableau contenant la donnée
     * @param string $key      Nom de la propriété/clé à récupérer
     * @param string $default  Valeur par défaut (optionnelle)
     * @return string
     */
    function display_value($data, $key, $default = '') {
        if (is_array($data) && isset($data[$key])) {
            return htmlspecialchars($data[$key]);
        }
        if (is_object($data) && isset($data->$key)) {
            return htmlspecialchars($data->$key);
        }
        return $default;
    }
}
