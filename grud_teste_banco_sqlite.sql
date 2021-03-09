
CREATE TABLE boleto (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    vencimento TEXT ,
    valor NUMERIC ,
    arquivo TEXT ,
    status INTEGER 
);

CREATE TABLE cliente (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT ,
    cnpj TEXT ,
    endereco TEXT 
);

CREATE TABLE usuario (
    id INTEGER     PRIMARY KEY AUTOINCREMENT,
    nome TEXT ,
    email TEXT ,
    login TEXT ,
    senha TEXT ,
    nivel INTEGER 
);

ALTER TABLE boleto ADD COLUMN  id_cliente  INTEGER ;