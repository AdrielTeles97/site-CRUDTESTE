<?php
            
/**
 * Classe feita para manipulação do objeto BoletoController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace GrudTeste\controller;
use GrudTeste\dao\BoletoDAO;
use GrudTeste\model\Cliente;
use GrudTeste\dao\ClienteDAO;
use GrudTeste\model\Boleto;
use GrudTeste\view\BoletoView;


class BoletoController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new BoletoDAO();
		$this->view = new BoletoView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new Boleto();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_boleto'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Boleto
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Boleto
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=boleto">';
    }



	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_boleto'])){
            $clienteDao = new ClienteDAO($this->dao->getConnection());
            $listCliente = $clienteDao->fetch();            

            $this->view->showInsertForm($listCliente);
		    return;
		}
		if (! ( isset ( $_POST ['vencimento'] ) && isset ( $_POST ['valor'] ) && isset ( $_FILES ['arquivo'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['cliente'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		$boleto = new Boleto ();
		$boleto->setVencimento ( $_POST ['vencimento'] );
		$boleto->setValor ( $_POST ['valor'] );

        if($_FILES['arquivo']['name'] != null){

            if(!file_exists('uploads/boleto/arquivo/')) {
    		    mkdir('uploads/boleto/arquivo/', 0777, true);
    		}
    
    		if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/boleto/arquivo/'. $_FILES['arquivo']['name']))
    		{
    		    echo '
                    <div class="alert alert-danger" role="alert">
                        Failed to send file.
                    </div>
    		        
                    ';
    		    return;
    		}
            $boleto->setArquivo ( "uploads/boleto/arquivo/".$_FILES ['arquivo']['name'] );
        }
		$boleto->setStatus ( $_POST ['status'] );
        $cliente = new Cliente();
        $cliente->setId($_POST['cliente']);

            
		if ($this->dao->insert ($boleto, $cliente ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Boleto
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Boleto
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=boleto">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_boleto'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['vencimento'] ) && isset ( $_POST ['valor'] ) && isset ( $_FILES ['arquivo'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['cliente'] ))) {
			echo ':incompleto';
			return;
		}
            
		$boleto = new Boleto ();
		$boleto->setVencimento ( $_POST ['vencimento'] );
		$boleto->setValor ( $_POST ['valor'] );
        if($_FILES['arquivo']['name'] != null){
    		if(!file_exists('uploads/boleto/arquivo/')) {
    		    mkdir('uploads/boleto/arquivo/', 0777, true);
    		}
    		        
    		if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/boleto/arquivo/'. $_FILES['arquivo']['name']))
    		{
    		    echo ':falha';
    		    return;
    		}
            $boleto->setArquivo ( "uploads/boleto/arquivo/".$_FILES ['arquivo']['name'] );
        }
		$boleto->setStatus ( $_POST ['status'] );
        $cliente = new Cliente();
        $cliente->setId($_POST['cliente']);

            
		if ($this->dao->insert ( $boleto, $cliente ))
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
        $selected = new Boleto();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_boleto'])){
            $this->view->showEditForm($selected);
            return;
        }
            
		if (! ( isset ( $_POST ['vencimento'] ) && isset ( $_POST ['valor'] ) && isset ( $_POST ['arquivo'] ) && isset ( $_POST ['status'] ))) {
			echo "Incompleto";
			return;
		}

		$selected->setVencimento ( $_POST ['vencimento'] );
		$selected->setValor ( $_POST ['valor'] );
		$selected->setArquivo ( $_POST ['arquivo'] );
		$selected->setStatus ( $_POST ['status'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=boleto">';
            
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
        $selected = new Boleto();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);

        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>