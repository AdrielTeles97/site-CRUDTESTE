<?php
            
/**
 * Classe feita para manipulação do objeto Boleto
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace GrudTeste\model;

class Boleto {
	private $id;
	private $vencimento;
	private $valor;
	private $arquivo;
	private $status;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setVencimento($vencimento) {
		$this->vencimento = $vencimento;
	}
		    
	public function getVencimento() {
		return $this->vencimento;
	}
	public function setValor($valor) {
		$this->valor = $valor;
	}
		    
	public function getValor() {
		return $this->valor;
	}
	public function setArquivo($arquivo) {
		$this->arquivo = $arquivo;
	}
		    
	public function getArquivo() {
		return $this->arquivo;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
		    
	public function getStatus() {
		return $this->status;
	}
	public function __toString(){
	    return $this->id.' - '.$this->vencimento.' - '.$this->valor.' - '.$this->arquivo.' - '.$this->status;
	}
                

}
?>