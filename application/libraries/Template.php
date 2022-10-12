<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
    public $ci;
    private $default_layout;
    private $template_data = array();

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    function set_default_layout($layout_path) {
        $this->default_layout = $layout_path;
    }

    function set($name, $value) {
        $this->template_data[$name] = $value;
    }


    function get_template_data($name) {
        return $this->template_data[$name];
    }

    public function render($view, $data = NULL, $layout = NULL)
	{
       $this->set('content', $this->ci->load->view($view, $data, TRUE));
       $this->ci->load->view($layout ?? $this->default_layout, $this->template_data);
	}
}
