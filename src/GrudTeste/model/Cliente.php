<?php
            
/**
 * Classe feita para manipulação do objeto Cliente
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace GrudTeste\model;

class Cliente {
	private $id;
	private $nome;
	private $cnpj;
	private $endereco;
	private $boletos;
    public function __construct(){

        $this->boletos = array();
    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
		    
	public function getNome() {
		return $this->nome;
	}
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}
		    
	public function getCnpj() {
		return $this->cnpj;
	}
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
		    
	public function getEndereco() {
		return $this->endereco;
	}

	public function setBoletos($boletos) {
		$this->boletos = $boletos;
	}
         
    public function addBoleto(Boleto $boleto){
        $this->boletos[] = $boleto;
            
    }
	public function getBoletos() {
		return $this->boletos;
	}
	public function __toString(){
	    return $this->id.' - '.$this->nome.' - '.$this->cnpj.' - '.$this->endereco.' - '.'Lista: '.implode(", ", $this->boletos);
	}
                

}
?>