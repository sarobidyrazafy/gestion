<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('resultCount');
    }

    public function toForm() {
        $this->load->view("saisir-nombre");
    }

    public function getResultat(){
        $nombre = $this->input->post("nombre");
		$marge = $this->input->post("marge");
        $tabRusult = (new ResultCount())->constructeur($nombre);
        $data = array();
        $data["resultCount"] = $tabRusult;

		$seuil = $this->resultCount->seuilRentabilite($nombre,$marge,$tabRusult->coutPiece);
		$data["seuil"] = $seuil;
        $this->load->view("tab-final-result",$data);

    }
}
