DROP DATABASE projeto;
CREATE DATABASE projeto;
USE projeto; 

CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (nome, email, senha_hash)
VALUES ('admin', 'admin@admin.com', '$2y$10$OrCO7E2YRt3Vsn8YJow9wOcu51hvQs3/.dzFBbBZOQeA4/IH69z5S');