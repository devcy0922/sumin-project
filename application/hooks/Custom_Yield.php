<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Custom_Yield
{
    function doYield()
    {
        global $OUT;
        $CI =& get_instance();
        $output = $CI->output->get_output();
        $CI->yield = isset($CI->yield) ? $CI->yield : TRUE;
        $CI->layout = isset($CI->layout) ? $CI->layout : 'default';
        $CI->APP_TITLE = "APP_TITLE"; // html title

        if ($CI->yield === TRUE) {
            if (!preg_match('/(.+).php$/', $CI->layout)) {
                $CI->layout .= '.php';
            }
            $requested = APPPATH . 'views/layouts/' . $CI->layout;
            $layout = $CI->load->file($requested, true);

            /**
             * APP_TITLE - 페이지 타이틀
             * yield - $this->load->view
             */
            $view = str_replace("{APP_TITLE}", $CI->APP_TITLE, $layout);
            $view = str_replace("{yield}", $output, $view);
        } else {
            $view = $output;
        }
        $OUT->_display($view);
    }
}
?>