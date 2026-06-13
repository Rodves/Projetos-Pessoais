CREATE DATABASE compliance_fornecedores;

\c compliance_fornecedores;

CREATE TABLE fornecedores (
    id SERIAL PRIMARY KEY,
    cnpj VARCHAR(18) UNIQUE NOT NULL,
    razao_social VARCHAR(255),
    nome_fantasia VARCHAR(255),
    situacao_cadastral VARCHAR(100),
    cnae_principal TEXT,
    endereco TEXT,
    cidade VARCHAR(100),
    estado VARCHAR(2),
    email VARCHAR(255),
    telefone VARCHAR(30),
    data_abertura DATE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);