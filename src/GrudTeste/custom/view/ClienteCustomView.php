<?php
            
/**
 * Classe de visao para Cliente
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace GrudTeste\custom\view;
use GrudTeste\view\ClienteView;
use GrudTeste\model\Cliente;


class ClienteCustomView extends ClienteView {

    ////////Digite seu código customizado aqui.
    
    
    
    public function showBoletos(Cliente $cliente){
        echo '
            
    	<div class="card o-hidden border-0 shadow-lg">
              <div class="card">
                <div class="card-header">
                  Boleto do Cliente
                </div>
                <div class="card-body">
            
            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>id</th>
						<th>Download</th>
						<th>Vencimento</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>id</th>
                        <th>Download</th>
                        <th>Vencimento</th>
                        
					</tr>
				</tfoot>
				<tbody>';
        
        foreach($cliente->getBoletos() as $element){
            echo '<tr>';
            echo '<td>'.$element->getId().'</td>';
            echo '<td><a href="'.$element->getArquivo().'">Download</a></td>';
            echo '<td>'.date("d/m/Y", strtotime($element->getVencimento())).'</td>';
            
        }
        
        echo '
				</tbody>
			</table>
		</div>
            
            
            
            
      </div>
  </div>
</div>
            
            
            
        ';
        
    }
    
    public function showList($lista){
        echo '
            
            
            
            
          <div class="card">
                <div class="card-header">
                  Lista Cliente
                </div>
                <div class="card-body">
            
            
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%"
				cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>Cnpj</th>
						<th>Endereco</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Cnpj</th>
                        <th>Endereco</th>
                        <th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
        
        foreach($lista as $element){
            echo '<tr>';
            echo '<td>'.$element->getId().'</td>';
            echo '<td>'.$element->getNome().'</td>';
            echo '<td>'.$element->getCnpj().'</td>';
            echo '<td>'.$element->getEndereco().'</td>';
            echo '<td>
                        <a href="?page=cliente&select='.$element->getCnpj().'" class="btn btn-info text-white">Select</a>
                        <a href="?page=cliente&edit='.$element->getId().'" class="btn btn-success text-white">Edit</a>
                        <a href="?page=cliente&delete='.$element->getId().'" class="btn btn-danger text-white">Delete</a>
                      </td>';
            echo '</tr>';
        }
        
        echo '
				</tbody>
			</table>
		</div>
            
            
            
            
  </div>
</div>
            
';
    }

}