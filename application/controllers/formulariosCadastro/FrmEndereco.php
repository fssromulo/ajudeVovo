<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrmEndereco extends CI_Controller {

	public function __construct(){
		parent::__construct();		
	}
	/* Controller da view que mantem o cadastro de endereco */
	public function index()
	{
		$this->load->view('formulariosCadastro/FrmEndereco');
	}

}