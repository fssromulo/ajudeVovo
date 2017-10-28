<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagSeguroLib {

	private $email_pagseguro;
	private $token_pagamento;
	protected $CI;

	public function __construct() {
		$this->CI =& get_instance();
		$this->email_pagseguro = 'fssromulo@gmail.com';
		$this->token_pagamento = '3482CDBFBE824205BD6843E721C46248';
	}

	public function getDadosCartao() {
		$this->CI->load->library('contratante');

		$arrCartaoContratante = $this->CI->contratante->getCartaoCreditoById(
			$this->CI->session->userdata('id_pessoa_fisica')
		);	

		return json_encode($arrCartaoContratante);
	}

	// Metodo que inicia a transação com o pagSeguro
	public function getSessaoPagSeguro()
	{

		$url_sanbox = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email='
			. $this->email_pagseguro
			. '&token='
			. $this->token_pagamento;

		$curl = curl_init($url_sanbox);

		// vamos ignorar o certificado de segurança utilizando o parâmetro abaixo. -- fazemos isso pq estamos em abiente de testes(sandbox)
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		// Informa que esta requisição terá quer ter um retorno
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// Vamos avisar ao cURL que esses dados será enviado via POST
		curl_setopt($curl, CURLOPT_POST, true);

		//O PagSeguro só irá aceitar a versão 1.1 do HTTP, logo devemos especificar isso tambem.
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

		$xml_resposta = curl_exec($curl);

		curl_close($curl);

		$xml_resposta = simplexml_load_string($xml_resposta);

		return ($xml_resposta->id);
	}

	// Metodo que envia os dados da compra do servico para o PAGSEGUROO
	public function realizaPagamentoPagSeguro( $arrCondicoes = null ) {
		$this->CI->load->library('prestador');
		$this->CI->load->library('contratante');

		$arrPrestador = $this->CI->prestador->getPrestador($arrCondicoes['id_servico_solicitacao']);
		$arrContratante = $this->CI->contratante->getContratante($arrCondicoes['id_servico_solicitacao']);

		(array)$arrDadosPagSeguro = json_decode(file_get_contents("php://input"), true);   

		$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';		

		$identificador_teste = date('d/m/Y H:i:s');

		$codigoAreaTelefone  = substr($arrContratante['celular'], 0, 2);
		$telefoneNumero 	   = substr($arrContratante['celular'], 2, strlen($arrContratante['celular']) );

		$data['email'] 						  = $this->email_pagseguro;
		$data['token']    					  = $this->token_pagamento;
		$data['currency'] 					  = 'BRL';
		$data['itemId1']  					  = '1';
		$data['paymentMethod']   			  = 'creditCard';
		$data['creditCardToken'] 		     = $arrCondicoes['tokenCartaoVovo'];
		$data['creditCardHolderName']      = $arrContratante['nome'];
		$data['creditCardHolderCPF']       = $arrContratante['cpf'];
		$data['creditCardHolderBirthDate'] = $arrContratante['dt_nascimento'];
		$data['creditCardHolderAreaCode']  = $codigoAreaTelefone;
		$data['creditCardHolderPhone']	  = $telefoneNumero;
		$data['reference']					  = $arrPrestador['id_servico_solicitacao'];
		$data['installmentQuantity'] 		  = 1;
		$data['installmentValue']			  = $arrPrestador['valor'];
		$data['itemDescription1']			  = $arrPrestador['descricao_servico'];
		$data['itemAmount1']					  = $arrPrestador['valor'];
		$data['itemQuantity1']				  = 1;
		$data['itemWeight1']					  = 0;
		$data['senderName']					  = $arrContratante['nome'];
		$data['senderAreaCode']				  = $codigoAreaTelefone;
		$data['senderPhone'] 				  = $telefoneNumero;
		$data['senderEmail']					  = 'c50891760423331506798@sandbox.pagseguro.com.br';
		$data['senderCPF']					  = $arrContratante['cpf'];

		// Shipping - Dados do ajudante
		$data['shippingType'] 				  = '1';
		$data['shippingAddressStreet'] 	  = $arrPrestador['rua'];
		$data['shippingAddressNumber'] 	  = $arrPrestador['numero'];
		$data['shippingAddressComplement'] = $arrPrestador['complemento'];
		$data['shippingAddressDistrict']   = $arrPrestador['bairro'];
		$data['shippingAddressCity'] 		  = $arrPrestador['cidade'];
		$data['shippingAddressState']      = $arrPrestador['estado_sigla'];
		$data['shippingAddressCountry']    = 'BRA';
		$data['shippingAddressPostalCode'] = $arrPrestador['cep'];

		// Billing - Dados do VOVO
		$data['billingAddressStreet']      = $arrContratante['rua'];
		$data['billingAddressNumber']      = $arrContratante['numero'];
		$data['billingAddressComplement']  = $arrContratante['complemento'];
		$data['billingAddressDistrict']    = $arrContratante['bairro'];
		$data['billingAddressCity']        = $arrContratante['cidade'];
		$data['billingAddressState']       = $arrContratante['estado_sigla'];
		$data['billingAddressCountry']     = 'BRA';
		$data['billingAddressPostalCode']  = $arrContratante['cep'];

	   $data = http_build_query($data);

		$curl = curl_init($url);
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		$xml_resposta = curl_exec($curl);

		print_r($xml_resposta);die;
		if ( $xml_resposta == 'Unauthorized' ) {
			//VALIDAr se a requisicao nao for aceita
			print_r(json_encode($xml_resposta));
			print_r('erro --- Unauthorized ---');
			exit;
		}

		curl_close($curl);

		$xml_resposta = simplexml_load_string($xml_resposta);

		echo('xml_resposta');
		echo($xml_resposta);

	}
}