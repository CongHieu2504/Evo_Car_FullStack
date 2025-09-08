<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index() {
        echo "Test controller is working!";
    }
    
    public function products() {
        echo "Test products method is working!";
    }
} 