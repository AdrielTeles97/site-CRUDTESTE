<?php
            
/**
 * Classe de visao para Boleto
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 *
 */

namespace GrudTeste\custom\view;
use GrudTeste\view\BoletoView;


class BoletoCustomView extends BoletoView {

    ////////Digite seu código customizado aqui.
    public function showInsertForm($listaCliente) {
        echo '
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalAddBoleto">
  Adicionar
</button>
            
<!-- Modal -->
<div class="modal fade" id="modalAddBoleto" tabindex="-1" role="dialog" aria-labelledby="labelAddBoleto" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddBoleto">Adicionar Boleto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="insert_form_boleto" class="user" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="enviar_boleto" value="1">
            
            
            
                                        <div class="form-group">
                                            <label for="vencimento">Vencimento</label>
                                            <input type="date" class="form-control"  name="vencimento" id="vencimento" placeholder="Vencimento">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="valor">Valor</label>
                                            <input type="number" class="form-control" step="0.01" name="valor" id="valor" placeholder="Valor">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="arquivo">Arquivo</label>
                                            <input type="file" class="form-control"  name="arquivo" id="arquivo"  accept="application/pdf">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="number" class="form-control"  name="status" id="status" placeholder="Status">
                                        </div>
                                        <div class="form-group">
                                          <label for="cliente">Cliente</label>
                						  <select class="form-control" id="cliente" name="cliente">
                                            <option value="">Selecione o Cliente</option>';
        
        foreach( $listaCliente as $element){
            echo '<option value="'.$element->getId().'">'.$element.'</option>';
        }
        
        echo '
                                          </select>
                						</div>
            
						              </form>
            
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button form="insert_form_boleto" type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>
            
            
            
';
    }
    


}