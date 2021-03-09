<?php
            
/**
 * Classe feita para manipulação do objeto Boleto
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace GrudTeste\dao;
use PDO;
use PDOException;
use GrudTeste\model\Boleto;
use GrudTeste\model\Cliente;

class BoletoDAO extends DAO {
    
    

            
            
    public function update(Boleto $boleto)
    {
        $id = $boleto->getId();
            
            
        $sql = "UPDATE boleto
                SET
                vencimento = :vencimento,
                valor = :valor,
                arquivo = :arquivo,
                status = :status
                WHERE boleto.id = :id;";
			$vencimento = $boleto->getVencimento();
			$valor = $boleto->getValor();
			$arquivo = $boleto->getArquivo();
			$status = $boleto->getStatus();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->bindParam(":arquivo", $arquivo, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(Boleto $boleto, Cliente $cliente){
        $sql = "INSERT INTO boleto(vencimento, valor, arquivo, status, id_cliente) VALUES (:vencimento, :valor, :arquivo, :status, :idCliente);";
		$vencimento = $boleto->getVencimento();
		$valor = $boleto->getValor();
		$arquivo = $boleto->getArquivo();
		$status = $boleto->getStatus();
        $idCliente = $cliente->getId();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->bindParam(":arquivo", $arquivo, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(Boleto $boleto, Cliente $cliente){
        $sql = "INSERT INTO boleto(id, vencimento, valor, arquivo, status, id_cliente) VALUES (:id, :vencimento, :valor, :arquivo, :status, :idCliente);";
		$id = $boleto->getId();
		$vencimento = $boleto->getVencimento();
		$valor = $boleto->getValor();
		$arquivo = $boleto->getArquivo();
		$status = $boleto->getStatus();
        $idCliente = $cliente->getId();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->bindParam(":arquivo", $arquivo, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function delete(Boleto $boleto){
		$id = $boleto->getId();
		$sql = "DELETE FROM boleto WHERE id = :id";
		    
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			return $stmt->execute();
			    
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}


	public function fetch() {
		$list = array ();
		$sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);
            
		    if(!$stmt){   
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		        return $list;
		    }
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row) 
            {
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $list [] = $boleto;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Boleto $boleto) {
        $lista = array();
	    $id = $boleto->getId();
                
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE boleto.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $lista [] = $boleto;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByVencimento(Boleto $boleto) {
        $lista = array();
	    $vencimento = $boleto->getVencimento();
                
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE boleto.vencimento like :vencimento";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $lista [] = $boleto;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByValor(Boleto $boleto) {
        $lista = array();
	    $valor = $boleto->getValor();
                
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE boleto.valor = :valor";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $lista [] = $boleto;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByArquivo(Boleto $boleto) {
        $lista = array();
	    $arquivo = $boleto->getArquivo();
                
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE boleto.arquivo like :arquivo";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":arquivo", $arquivo, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $lista [] = $boleto;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByStatus(Boleto $boleto) {
        $lista = array();
	    $status = $boleto->getStatus();
                
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE boleto.status = :status";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $lista [] = $boleto;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Boleto $boleto) {
        
	    $id = $boleto->getId();
	    $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
                WHERE boleto.id = :id
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $boleto;
    }
                
    public function fillByVencimento(Boleto $boleto) {
        
	    $vencimento = $boleto->getVencimento();
	    $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
                WHERE boleto.vencimento = :vencimento
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $boleto;
    }
                
    public function fillByValor(Boleto $boleto) {
        
	    $valor = $boleto->getValor();
	    $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
                WHERE boleto.valor = :valor
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $boleto;
    }
                
    public function fillByArquivo(Boleto $boleto) {
        
	    $arquivo = $boleto->getArquivo();
	    $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
                WHERE boleto.arquivo = :arquivo
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":arquivo", $arquivo, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $boleto;
    }
                
    public function fillByStatus(Boleto $boleto) {
        
	    $status = $boleto->getStatus();
	    $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
                WHERE boleto.status = :status
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":status", $status, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $boleto;
    }
	public function fetchByNN(Cliente $cliente) {
		$list = array ();
        $idCliente = $cliente->getId();
		$sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
                    WHERE boleto.id_cliente = :idCliente LIMIT 1000";
            
        try {
            $stmt = $this->connection->prepare($sql);
            
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		        return $list;
		    }
            $stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);

            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row)
            {
		        $boleto = new Boleto();
                $boleto->setId( $row ['id'] );
                $boleto->setVencimento( $row ['vencimento'] );
                $boleto->setValor( $row ['valor'] );
                $boleto->setArquivo( $row ['arquivo'] );
                $boleto->setStatus( $row ['status'] );
                $list [] = $boleto;
            
            
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;
    }
        
}