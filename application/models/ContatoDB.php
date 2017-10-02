<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContatoDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function inserirContato($arrContatos) {
 		$this->db->insert(
 			'contato',
 			$arrContatos
 		);
  	}


}
?>
