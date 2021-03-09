<?php
            
/**
 * Classe de visao para Cliente
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace GrudTeste\view;
use GrudTeste\model\Cliente;


class ClienteView {
    public function showInsertForm() {
		echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddCliente">
  Adicionar
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddCliente" tabindex="-1" role="dialog" aria-labelledby="labelAddCliente" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddCliente">Adicionar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="insert_form_cliente" class="user" method="post">
            <input type="hidden" name="enviar_cliente" value="1">                



                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control"  name="nome" id="nome" placeholder="Nome">
                                        </div>

                                        <div class="form-group">
                                            <label for="cnpj">Cnpj</label>
                                            <input type="text" class="form-control"  name="cnpj" id="cnpj" placeholder="Cnpj">
                                        </div>

                                        <div class="form-group">
                                            <label for="endereco">Endereco</label>
                                            <input type="text" class="form-control"  name="endereco" id="endereco" placeholder="Endereco">
                                        </div>

						              </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="insert_form_cliente" type="submit" class="btn btn-primary">Cadastrar</button>
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
                        <a href="?page=cliente&select='.$element->getId().'" class="btn btn-info text-white">Select</a>
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
            

            
	public function showEditForm(Cliente $selecionado) {
		echo '
	    
	    

<div class="card o-hidden border-0 shadow-lg mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Cliente</h6>
        </div>
        <div class="card-body">
            <form class="user" method="post" id="edit_form_cliente">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getNome().'"  name="nome" id="nome" placeholder="Nome">
                						</div>
                                        <div class="form-group">
                                            <label for="cnpj">Cnpj</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getCnpj().'"  name="cnpj" id="cnpj" placeholder="Cnpj">
                						</div>
                                        <div class="form-group">
                                            <label for="endereco">Endereco</label>
                                            <input type="text" class="form-control" value="'.$selecionado->getEndereco().'"  name="endereco" id="endereco" placeholder="Endereco">
                						</div>
                <input type="hidden" value="1" name="edit_cliente">
                </form>

        </div>
        <div class="modal-footer">
            <button form="edit_form_cliente" type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>
</div>

	    

										
						              ';
	}




            
        public function showSelected(Cliente $cliente){
            echo '
            
	<div class="card o-hidden border-0 shadow-lg">
        <div class="card">
            <div class="card-header">
                  Cliente selecionado
            </div>
            <div class="card-body">
                Id: '.$cliente->getId().'<br>
                Nome: '.$cliente->getNome().'<br>
                Cnpj: '.$cliente->getCnpj().'<br>
                Endereco: '.$cliente->getEndereco().'<br>
            
            </div>
        </div>
    </div>
            
            
';
    }


                                            
    public function confirmDelete(Cliente $cliente) {
		echo '
        
        
        
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
        
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"> Delete Cliente</h1>
									</div>
						              <form class="user" method="post">                    Are you sure you want to delete this object?

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Delete" name="delete_cliente">
                                        <hr>
                                            
						              </form>
                                            
								</div>
							</div>
						</div>
					</div>
                                            
                                            
                                            
                                            
	</div>';
	}
                      


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
						<th>vencimento</th>
						<th>valor</th><th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                        <th>id</th>
                        <th>vencimento</th>
                        <th>valor</th><th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
                
            foreach($cliente->getBoletos() as $element){
                echo '<tr>';
                echo '<td>'.$element->getId().'</td>';
                echo '<td>'.$element->getVencimento().'</td>';
                echo '<td>'.$element->getValor().'</td>';echo '<td>
                        <a href="?page=boleto&select='.$element->getId().'" class="btn btn-info">Selecionar</a>
                        <a href="?page=cliente&select='.$cliente->getId().'&remover_boleto='.$element->getId().'" class="btn btn-danger">Remover</a>
                      </td>';
                echo '<tr>';
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
                

}