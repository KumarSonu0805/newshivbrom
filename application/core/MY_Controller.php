<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    var $bv=200000;
    var $min_deposit=0;
    var $direct=10;
    var $matching=10;
    
    public function __construct() {
        parent::__construct();
        // Load global models, check auth, etc.
        $this->load->library('template');
    }
    
    protected function set_flash($type, $msg) {
        $this->session->set_flashdata($type, $msg);
    }

    protected function check_login($role) {
        if ($this->session->userdata('role') !== $role) {
            show_error('Unauthorized: Access Denied', 403);
        }
    }

    protected function require_role($role) {
        if ($this->session->userdata('role') !== $role) {
            show_error('Unauthorized: Access Denied', 403);
        }
    }

    // Optional: support multiple allowed roles
    protected function require_roles($roles = []) {
        if (!in_array($this->session->userdata('role'), $roles)) {
            show_error('Unauthorized: Access Denied', 403);
        }
    }
    
}