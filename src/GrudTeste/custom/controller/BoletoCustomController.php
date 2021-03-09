<?php
            
/**
 * Customize o controller do objeto Boleto aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace GrudTeste\custom\controller;
use GrudTeste\controller\BoletoController;
use GrudTeste\custom\dao\BoletoCustomDAO;
use GrudTeste\custom\view\BoletoCustomView;

class BoletoCustomController  extends BoletoController {
    

	public function __construct(){
		$this->dao = new BoletoCustomDAO();
		$this->view = new BoletoCustomView();
	}


	        
}
?>