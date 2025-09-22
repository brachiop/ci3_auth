<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('session_value')) {
    /**
     * Récupère une valeur en session avec une valeur par défaut
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function session_value($key, $default = null) {
        $CI =& get_instance();
        $value = $CI->session->userdata($key);
        return $value ? $value : $default;
    }
}
