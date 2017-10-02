<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Geral extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('GeralDB');
	}

	public function index()
	{
		// Algo aqui ...
	}

	public function getListaPais() {
      (array)$dados = json_decode(file_get_contents("php://input"), true);   
   	
      if ( is_array($dados) ) {
      	die('!! é array  - tem parametros na busca !!');
      }

    	$listar = $this->GeralDB->getListaPais($dados)->result_array();

    	echo json_encode($listar);   	      
   }

	public function getListaEstado() {
      (array)$dados = json_decode(file_get_contents("php://input"), true);   
   	
      if ( is_array($dados) ) {
      	$id_pais = $dados['id_pais'];
      }

    	$listar = $this->GeralDB->getListaEstado($id_pais)->result_array();

    	echo json_encode($listar);   	      
   }

	public function getListaCidade() {
      (array)$dados = json_decode(file_get_contents("php://input"), true);   
   	
      if ( is_array($dados) ) {
      	$id_estado = $dados['id_estado'];
      }

    	$listar = $this->GeralDB->getListaCidade($id_estado)->result_array();

    	echo json_encode($listar);   	     
   }
   

}
