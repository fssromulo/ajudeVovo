<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalheServico extends CI_Controller {

	private $id_servico;


	public function __construct(){
		parent::__construct();
		$this->load->model('DetalheServicoDB');
		$this->id_servico=5;
		$this->load->helper('formatarDatas');		
	}

	public function index() {
		$this->load->view('DetalheServico');
	}


	public function buscaServico(){
		$listaDetalheServico = $this->DetalheServicoDB->getDetalheServico($this->id_servico)->result_array();

		echo json_encode($listaDetalheServico[0]);

	}

	public function buscaDiaHorarioDisponivel(){
		$listaDiaHorario = $this->DetalheServicoDB->getListaDiaHorarioServico($this->id_servico)->result_array();

		echo json_encode($listaDiaHorario);
	}

	public function salvarSolicitacao(){
		

		(array)$dados = json_decode(file_get_contents("php://input"), true); 

		$dados['dia_solicitacao'] = formatarDatas($dados['dia_solicitacao'], 'Y-m-d');
		$this->DetalheServicoDB->inserirSolicitacao($dados);

	}
}


