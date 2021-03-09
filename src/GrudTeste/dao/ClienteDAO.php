<?php
            
/**
 * Classe feita para manipulação do objeto Cliente
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace GrudTeste\dao;
use PDO;
use PDOException;
use GrudTeste\model\Cliente;
use GrudTeste\model\Boleto;



class ClienteDAO extends DAO {
    
    

            
            
    public function update(Cliente $cliente)
    {
        $id = $cliente->getId();
            
            
        $sql = "UPDATE cliente
                SET
                nome = :nome,
                cnpj = :cnpj,
                endereco = :endereco
                WHERE cliente.id = :id;";
			$nome = $cliente->getNome();
			$cnpj = $cliente->getCnpj();
			$endereco = $cliente->getEndereco();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
			$stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(Cliente $cliente){
        $sql = "INSERT INTO cliente(nome, cnpj, endereco) VALUES (:nome, :cnpj, :endereco);";
		$nome = $cliente->getNome();
		$cnpj = $cliente->getCnpj();
		$endereco = $cliente->getEndereco();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
			$stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(Cliente $cliente){
        $sql = "INSERT INTO cliente(id, nome, cnpj, endereco) VALUES (:id, :nome, :cnpj, :endereco);";
		$id = $cliente->getId();
		$nome = $cliente->getNome();
		$cnpj = $cliente->getCnpj();
		$endereco = $cliente->getEndereco();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
			$stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function delete(Cliente $cliente){
		$id = $cliente->getId();
		$sql = "DELETE FROM cliente WHERE id = :id";
		    
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
		$sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente LIMIT 1000";

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
		        $cliente = new Cliente();
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                $list [] = $cliente;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Cliente $cliente) {
        $lista = array();
	    $id = $cliente->getId();
                
        $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
            WHERE cliente.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $cliente = new Cliente();
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                $lista [] = $cliente;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByNome(Cliente $cliente) {
        $lista = array();
	    $nome = $cliente->getNome();
                
        $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
            WHERE cliente.nome like :nome";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $cliente = new Cliente();
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                $lista [] = $cliente;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByCnpj(Cliente $cliente) {
        $lista = array();
	    $cnpj = $cliente->getCnpj();
                
        $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
            WHERE cliente.cnpj like :cnpj";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $cliente = new Cliente();
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                $lista [] = $cliente;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByEndereco(Cliente $cliente) {
        $lista = array();
	    $endereco = $cliente->getEndereco();
                
        $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
            WHERE cliente.endereco like :endereco";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $cliente = new Cliente();
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                $lista [] = $cliente;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Cliente $cliente) {
        
	    $id = $cliente->getId();
	    $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
                WHERE cliente.id = :id
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
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $cliente;
    }
                
    public function fillByNome(Cliente $cliente) {
        
	    $nome = $cliente->getNome();
	    $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
                WHERE cliente.nome = :nome
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $cliente;
    }
                
    public function fillByCnpj(Cliente $cliente) {
        
	    $cnpj = $cliente->getCnpj();
	    $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
                WHERE cliente.cnpj = :cnpj
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $cliente;
    }
                
    public function fillByEndereco(Cliente $cliente) {
        
	    $endereco = $cliente->getEndereco();
	    $sql = "SELECT cliente.id, cliente.nome, cliente.cnpj, cliente.endereco FROM cliente
                WHERE cliente.endereco = :endereco
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $cliente->setId( $row ['id'] );
                $cliente->setNome( $row ['nome'] );
                $cliente->setCnpj( $row ['cnpj'] );
                $cliente->setEndereco( $row ['endereco'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $cliente;
    }
                
    public function fetchBoletos(Cliente $cliente){
	    $id = $cliente->getId();
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE id_cliente = :id;";
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
                $cliente->addBoleto($boleto);
            }
                    
        } catch(PDOException $e) {
            echo $e->getMessage();
                    
        }
                    

                
                
    }
                
                

                
    public function belogBoleto(Cliente $cliente, Boleto $boleto){
	    $idCliente = $cliente->getId();
        $idBoleto = $boleto->getId();
        $sql = "SELECT boleto.id, boleto.vencimento, boleto.valor, boleto.arquivo, boleto.status FROM boleto
            WHERE boleto.id_cliente = :idCliente
            AND boleto.id  = :idBoleto;";
        try {
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
            $stmt->bindParam(":idBoleto", $idBoleto, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->fetchColumn() > 0){
                return true;
            }
            return false;
         
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            
        }
        return false;

    }
                
                

}