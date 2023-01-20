CREATE DATABASE vtsolucoes;

CREATE TABLE vtsolucoes.operadora (
      operadora_id INTEGER AUTO_INCREMENT PRIMARY KEY
    , operadora_nome VARCHAR(255)
    , operadora_cnpj VARCHAR(50)
);

CREATE TABLE vtsolucoes.cartao (
      cartao_id INTEGER AUTO_INCREMENT PRIMARY KEY
    , cartao_numero VARCHAR(100)
    , cartao_saldo VARCHAR(50)
    , operadora_id INTEGER
    , CONSTRAINT operadora_cartao_id FOREIGN KEY (operadora_id) REFERENCES operadora (operadora_id)
);

CREATE TABLE vtsolucoes.funcionario (
      funcionario_id INTEGER AUTO_INCREMENT PRIMARY KEY
    , funcionario_nome VARCHAR(100)
    , funcionario_documento VARCHAR(50)
);

CREATE TABLE vtsolucoes.funcionario_cartao (
      funcionario_id INTEGER
    , cartao_id INTEGER
    , CONSTRAINT fk_cartao_funcionario_id FOREIGN KEY (funcionario_id) REFERENCES funcionario (funcionario_id)
    , CONSTRAINT fk_funcionario_cartao_id FOREIGN KEY (cartao_id) REFERENCES cartao (cartao_id)
);