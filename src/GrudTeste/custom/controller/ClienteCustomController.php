<?php
            
/**
 * Customize o controller do objeto Cliente aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace GrudTeste\custom\controller;
use GrudTeste\controller\ClienteController;
use GrudTeste\custom\dao\ClienteCustomDAO;
use GrudTeste\custom\view\ClienteCustomView;

class ClienteCustomController  extends ClienteController {
    

	public function __construct(){
		$this->dao = new ClienteCustomDAO();
		$this->view = new ClienteCustomView();
	}

	
	public function mainComum(){
	    
	    if (isset($_GET['select'])){
	        echo '<div class="row">';
	        $this->select();
	        echo '</div>';
	        return;
	    }
	}
}
?>