<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalheServico extends CI_Controller {

	private $id_servico;

	public function __construct(){
		parent::__construct();
		$this->load->model('DetalheServicoDB');
		$this->load->helper('formatarDatas');		
		$this->id_servico = null;
	}

	public function index() {
		$this->load->view('DetalheServico');
	}

	public function buscaServico(){
		(array)$dados = json_decode(file_get_contents("php://input"), true); 

		$this->id_servico = $dados['id_servico'];

		if ( is_null( $this->id_servico ) ) {
			return null;
		}

		$listaDetalheServico = $this->DetalheServicoDB->getDetalheServico($this->id_servico)->result_array();

		echo json_encode($listaDetalheServico[0]);
	}

	public function buscaDiaHorarioDisponivel(){
		(array)$dados = json_decode(file_get_contents("php://input"), true); 

		$this->id_servico = $dados['id_servico'];

		if ( is_null( $this->id_servico ) ) {
			return null;
		}
		
		$listaDiaHorario = $this->DetalheServicoDB->getListaDiaHorarioServico($this->id_servico)->result_array();

		echo json_encode($listaDiaHorario);
	}

	public function salvarSolicitacao(){
		(array)$dados = json_decode(file_get_contents("php://input"), true); 

		$dados['dia_solicitacao'] = formatarDatas($dados['dia_solicitacao'], 'Y-m-d');
		$this->DetalheServicoDB->inserirSolicitacao($dados);
	}
}