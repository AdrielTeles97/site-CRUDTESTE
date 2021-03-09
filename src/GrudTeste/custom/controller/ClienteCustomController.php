<?php
            
/**
 * Customize o controller do objeto Cliente aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace GrudTeste\custom\controller;
use GrudTeste\controller\ClienteController;
use GrudTeste\custom\dao\ClienteCustomDAO;
use GrudTeste\custom\view\ClienteCustomView;
use GrudTeste\model\Cliente;

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
	
	
	
	public function select(){
	    if(!isset($_GET['select'])){
	        return;
	    }
	    $selected = new Cliente();
	    $selected->setCnpj($_GET['select']);
	    
	    $lista = $this->dao->fetchByCnpj($selected);
	    if(count($lista) == 0){
	        echo "CLiente não localizado";
	        return;
	    }
	    $selected = $lista[0];
	    
	    echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
	    echo '</div>';
	    
	    
	    $this->dao->fetchBoletos($selected);
	    echo '<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">';
	    $this->view->showBoletos($selected);
	    echo '</div>';
	    
	    
	    
	    
	}
}
?>