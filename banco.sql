
CREATE DATABASE IF NOT EXISTS mercado;
USE mercado;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  senha VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  preco DECIMAL(10,2),
  imagem VARCHAR(100),
  categoria VARCHAR(50)
);

INSERT INTO produtos (nome, preco, imagem, categoria) VALUES
('Coca-Cola 2L', 8.50, '', 'Bebidas'),
('Arroz 5kg', 20.00, '', 'Alimentos'),
('Sabonete', 2.50, '', 'Higiene');
