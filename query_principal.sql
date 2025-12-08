DROP DATABASE IF EXISTS projeto;
CREATE DATABASE projeto;
USE projeto;

-- ----------------------------------------------------
-- 1. TABELA EMPRESAS (A raiz da segregação)
-- ----------------------------------------------------
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_fantasia VARCHAR(150) NOT NULL,
    cnpj VARCHAR(18) UNIQUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserção de uma empresa de teste
INSERT INTO empresas (nome_fantasia, cnpj) 
VALUES ('Empresa Teste Alpha', '11.111.111/0001-11');

-- ----------------------------------------------------
-- 2. TABELA USUARIOS (Chave: empresa_id)
-- ----------------------------------------------------
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,  -- Chave estrangeira para a empresa
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    
    -- Define a chave estrangeira
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

-- Senha '123456' hasheada para o usuário admin (pertencente à Empresa ID 1)
INSERT INTO usuarios (empresa_id, nome, email, senha_hash)
VALUES (
    1, 
    'admin', 
    'admin@teste.com', 
    '$2y$10$OrCO7E2YRt3Vsn8YJow9wOcu51hvQs3/.dzFBbBZOQeA4/IH69z5S' 
);


-- ----------------------------------------------------
-- 3. TABELA CLIENTES (Chave: empresa_id)
-- ----------------------------------------------------
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL, -- Chave estrangeira para a empresa
    nome VARCHAR(150) NOT NULL,
    documento VARCHAR(18),
    email_contato VARCHAR(255),
    status ENUM('ativo', 'inativo', 'pendente') NOT NULL DEFAULT 'ativo',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Define a chave estrangeira
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

-- Inserção de clientes de teste (pertencentes à Empresa ID 1)
INSERT INTO clientes (empresa_id, nome, documento, email_contato) VALUES
(1, 'Cliente A da Empresa Alpha', '999.999.999-99', 'a@alpha.com'),
(1, 'Cliente B da Empresa Alpha', '888.888.888-88', 'b@alpha.com'),
(1, 'Cliente C da Empresa Alpha', '888.888.888-88', 'b@alpha.com');