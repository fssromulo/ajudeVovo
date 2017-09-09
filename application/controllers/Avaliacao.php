<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AvaliacaoDB');		
	}

	public function index()
	{
		$this->load->view('avaliacao');
	}


	public function salvar() {
		(array)$dados = json_decode(file_get_contents("php://input"), true);   
   	
		$id_servico = $dados['id_servico'];
		$id_contratante = $dados['id_contratante'];

		unset($dados['id_servico']);
		unset($dados['id_contratante']);

		$this->AvaliacaoDB->inserir_avaliacao($dados);

		$insert_id = $this->db->insert_id();

		$dados['id_avaliacao'] = $insert_id;
		unset($dados['nota']);
		unset($dados['comentario']);

		if ($id_servico != null) {
			$dados['id_servico'] = $id_servico;
			$this->AvaliacaoDB->inserir_avaliacao_servico($dados);
		} else {
			$dados['id_contratante'] = $id_contratante;
			$this->AvaliacaoDB->inserir_avaliacao_contratante($dados);
		}
	}
}
