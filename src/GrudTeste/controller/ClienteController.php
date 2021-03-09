<?php
            
/**
 * Classe feita para manipulação do objeto ClienteController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace GrudTeste\controller;
use GrudTeste\dao\ClienteDAO;
use GrudTeste\model\Cliente;
use GrudTeste\view\ClienteView;


class ClienteController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new ClienteDAO();
		$this->view = new ClienteView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new Cliente();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_cliente'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Cliente
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Cliente
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=cliente">';
    }



	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_cliente'])){
            $this->view->showInsertForm();
		    return;
		}
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['cnpj'] ) && isset ( $_POST ['endereco'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		$cliente = new Cliente ();
		$cliente->setNome ( $_POST ['nome'] );
		$cliente->setCnpj ( $_POST ['cnpj'] );
		$cliente->setEndereco ( $_POST ['endereco'] );
            
		if ($this->dao->insert ($cliente ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Cliente
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Cliente
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=cliente">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_cliente'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['cnpj'] ) && isset ( $_POST ['endereco'] ))) {
			echo ':incompleto';
			return;
		}
            
		$cliente = new Cliente ();
		$cliente->setNome ( $_POST ['nome'] );
		$cliente->setCnpj ( $_POST ['cnpj'] );
		$cliente->setEndereco ( $_POST ['endereco'] );
            
		if ($this->dao->insert ( $cliente ))
        {
			$id = $this->dao->getConnection()->lastInsertId();
            echo ':sucesso:'.$id;
            
		} else {
			 echo ':falha';
		}
	}
            
            

            
    public function edit(){
	    if(!isset($_GET['edit'])){
	        return;
	    }
        $selected = new Cliente();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_cliente'])){
            $this->view->showEditForm($selected);
            return;
        }
            
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['cnpj'] ) && isset ( $_POST ['endereco'] ))) {
			echo "Incompleto";
			return;
		}

		$selected->setNome ( $_POST ['nome'] );
		$selected->setCnpj ( $_POST ['cnpj'] );
		$selected->setEndereco ( $_POST ['endereco'] );
            
		if ($this->dao->update ($selected ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso 
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha 
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=cliente">';
            
    }
        

    public function main(){
        
        if (isset($_GET['select'])){
            echo '<div class="row">';
                $this->select();
            echo '</div>';
            return;
        }
        echo '
		<div class="row">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
        
        if(isset($_GET['edit'])){
            $this->edit();
        }else if(isset($_GET['delete'])){
            $this->delete();
	    }else{
            $this->add();
        }
        $this->fetch();
        
        echo '</div>';
        echo '</div>';
            
    }
    public function mainAjax(){

        $this->addAjax();
        
            
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