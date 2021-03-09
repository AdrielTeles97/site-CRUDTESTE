
CREATE TABLE boleto (
        id serial NOT NULL, 
        CONSTRAINT pk_boleto PRIMARY KEY (id), 
        vencimento date, 
        valor numeric(8,2), 
        arquivo character varying(200), 
        status integer
);

CREATE TABLE cliente (
        id serial NOT NULL, 
        CONSTRAINT pk_cliente PRIMARY KEY (id), 
        nome character varying(400), 
        cnpj character varying(400), 
        endereco character varying(400)
);

CREATE TABLE usuario (
        id serial NOT NULL, 
        CONSTRAINT pk_usuario PRIMARY KEY (id), 
        nome character varying(400), 
        email character varying(400), 
        login character varying(400), 
        senha character varying(400), 
        nivel integer
);

ALTER TABLE boleto ADD COLUMN  id_cliente  integer ;

ALTER TABLE boleto 
    ADD CONSTRAINT
    fk_cliente_boletos FOREIGN KEY (id_cliente)
    REFERENCES cliente (id);
