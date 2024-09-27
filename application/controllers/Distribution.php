<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('repartition');
    }
    public function testDistribution ()  {
        $data = array();
        $data["repartition"] = new Repartition();
        $this->load->view("tab-distribution",$data);
    }
}
