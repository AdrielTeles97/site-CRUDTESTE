<?php
            
/**
 * Customize o controller do objeto Usuario aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace GrudTeste\custom\controller;
use GrudTeste\controller\UsuarioController;
use GrudTeste\custom\dao\UsuarioCustomDAO;
use GrudTeste\custom\view\UsuarioCustomView;

class UsuarioCustomController  extends UsuarioController {
    

	public function __construct(){
		$this->dao = new UsuarioCustomDAO();
		$this->view = new UsuarioCustomView();
	}


	        
}
?>