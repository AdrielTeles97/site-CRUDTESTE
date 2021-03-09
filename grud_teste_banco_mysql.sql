
CREATE TABLE IF NOT EXISTS boleto (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        vencimento  DATE , 
        valor REAL, 
        arquivo VARCHAR(400), 
        status INT
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS cliente (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400), 
        cnpj VARCHAR(400), 
        endereco VARCHAR(400)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS usuario (
        id  INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (id), 
        nome VARCHAR(400), 
        email VARCHAR(400), 
        login VARCHAR(400), 
        senha VARCHAR(400), 
        nivel INT
)ENGINE = InnoDB;

ALTER TABLE boleto ADD COLUMN  id_cliente  INT ;
                        
ALTER TABLE boleto
    ADD CONSTRAINT
    fk_cliente_boletos FOREIGN KEY (id_cliente)
    REFERENCES cliente (id);
