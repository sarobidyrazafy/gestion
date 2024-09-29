<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RubriqueController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rubrique'); // Chargement du modèle Rubrique
        $this->load->model('secteur');  // Chargement du modèle Secteur
        $this->load->model('rubsect');  // Chargement du modèle RubSect
    }

    public function index() {
        // Affiche un message d'accueil
        echo "Vous êtes dans l'index de rubriqueController";
    }

    public function insertRubrique() {
        // Exemples de variables pour l'insertion d'une rubrique
        $nom = $this->input->post("nom");
        $total = $this->input->post("total");
        $uniteOeuvre = $this->input->post("uniteOeuvre");
        $idNature = $this->input->post("idNature");

        // Insertion de la rubrique dans la base de données
        $this->rubrique->insertRubrique($nom, $total, $uniteOeuvre, $idNature);
    }

    public function testRubSect() {
        $data = array();
		$rubSectInstance = (new RubSect())->constructeur();
        
        $data["tabRubrique"] = $this->rubrique->getTableauInfoRubrique();
        $data["secteurs"] = $this->secteur->getAllSecteur();
		$data['totalRubrique'] =  $this->rubrique->getTotalRubrique();
        $data["rubsecteurs"] = $rubSectInstance->rubSecteurs;
        $data['coutTotalSecteur'] = $rubSectInstance->coutTotalSecteur;
		$data['coutParNature'] = $rubSectInstance->coutTotalSecteurParNature;
		$data['coutTotalFV'] = $rubSectInstance->getTotalCoutFV();

        $this->load->view("tab-rubrique", $data);
    }

    public function testInsert() {
        // Test d'insertion dans la table 'rubriqueSecteur'
        //$this->rubrique->insertRubriqueSecteur(4,2,40);
    }

    public function input() {
        // Charger la vue 'input'
        $this->load->view("input");
    }
}
