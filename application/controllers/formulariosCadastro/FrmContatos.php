<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrmContatos extends CI_Controller {

	public function __construct(){
		parent::__construct();		
	}
	/* Controller da view que mantem o cadastro dos dados pessoais da pessoais */
	public function index()
	{
		$this->load->view('formulariosCadastro/FrmContatos');
	}

}