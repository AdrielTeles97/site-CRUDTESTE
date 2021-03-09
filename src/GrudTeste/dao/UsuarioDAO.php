<?php
            
/**
 * Classe feita para manipulação do objeto Usuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */
     
namespace GrudTeste\dao;
use PDO;
use PDOException;
use GrudTeste\model\Usuario;

class UsuarioDAO extends DAO {
    
    

            
            
    public function update(Usuario $usuario)
    {
        $id = $usuario->getId();
            
            
        $sql = "UPDATE usuario
                SET
                nome = :nome,
                email = :email,
                login = :login,
                senha = :senha,
                nivel = :nivel
                WHERE usuario.id = :id;";
			$nome = $usuario->getNome();
			$email = $usuario->getEmail();
			$login = $usuario->getLogin();
			$senha = $usuario->getSenha();
			$nivel = $usuario->getNivel();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(Usuario $usuario){
        $sql = "INSERT INTO usuario(nome, email, login, senha, nivel) VALUES (:nome, :email, :login, :senha, :nivel);";
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }
    public function insertWithPK(Usuario $usuario){
        $sql = "INSERT INTO usuario(id, nome, email, login, senha, nivel) VALUES (:id, :nome, :email, :login, :senha, :nivel);";
		$id = $usuario->getId();
		$nome = $usuario->getNome();
		$email = $usuario->getEmail();
		$login = $usuario->getLogin();
		$senha = $usuario->getSenha();
		$nivel = $usuario->getNivel();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":login", $login, PDO::PARAM_STR);
			$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function delete(Usuario $usuario){
		$id = $usuario->getId();
		$sql = "DELETE FROM usuario WHERE id = :id";
		    
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
		$sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario LIMIT 1000";

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
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $list [] = $usuario;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
        
                
    public function fetchById(Usuario $usuario) {
        $lista = array();
	    $id = $usuario->getId();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
            WHERE usuario.id = :id";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByNome(Usuario $usuario) {
        $lista = array();
	    $nome = $usuario->getNome();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
            WHERE usuario.nome like :nome";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByEmail(Usuario $usuario) {
        $lista = array();
	    $email = $usuario->getEmail();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
            WHERE usuario.email like :email";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByLogin(Usuario $usuario) {
        $lista = array();
	    $login = $usuario->getLogin();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
            WHERE usuario.login like :login";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchBySenha(Usuario $usuario) {
        $lista = array();
	    $senha = $usuario->getSenha();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
            WHERE usuario.senha like :senha";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fetchByNivel(Usuario $usuario) {
        $lista = array();
	    $nivel = $usuario->getNivel();
                
        $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
            WHERE usuario.nivel = :nivel";
                
        try {
                
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ( $result as $row ){
		        $usuario = new Usuario();
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                $lista [] = $usuario;

	
		    }
    			    
        } catch(PDOException $e) {
            echo $e->getMessage();
    			    
        }
		return $lista;
    }
                
    public function fillById(Usuario $usuario) {
        
	    $id = $usuario->getId();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
                WHERE usuario.id = :id
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
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByNome(Usuario $usuario) {
        
	    $nome = $usuario->getNome();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
                WHERE usuario.nome = :nome
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
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByEmail(Usuario $usuario) {
        
	    $email = $usuario->getEmail();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
                WHERE usuario.email = :email
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByLogin(Usuario $usuario) {
        
	    $login = $usuario->getLogin();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
                WHERE usuario.login = :login
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillBySenha(Usuario $usuario) {
        
	    $senha = $usuario->getSenha();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
                WHERE usuario.senha = :senha
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
                
    public function fillByNivel(Usuario $usuario) {
        
	    $nivel = $usuario->getNivel();
	    $sql = "SELECT usuario.id, usuario.nome, usuario.email, usuario.login, usuario.senha, usuario.nivel FROM usuario
                WHERE usuario.nivel = :nivel
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $usuario->setId( $row ['id'] );
                $usuario->setNome( $row ['nome'] );
                $usuario->setEmail( $row ['email'] );
                $usuario->setLogin( $row ['login'] );
                $usuario->setSenha( $row ['senha'] );
                $usuario->setNivel( $row ['nivel'] );
                
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return $usuario;
    }
}