CREATE DATABASE aromatica;

USE aromatica;

CREATE TABLE perfumes (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  marca VARCHAR(50) NOT NULL,
  descricao TEXT,
  preco DECIMAL(10,2) NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  tamanho VARCHAR(20) NOT NULL,
  imagem VARCHAR(100),
  estoque INT(11) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE clientes (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  sobrenome VARCHAR(50) NOT NULL,
  endereco VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE compras (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_cliente INT(11) NOT NULL,
  data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  valor_total DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

CREATE TABLE itens_compra (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_compra INT(11) NOT NULL,
  id_perfume INT(11) NOT NULL,
  quantidade INT(11) NOT NULL,
  preco_unitario DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_compra) REFERENCES compras(id),
  FOREIGN KEY (id_perfume) REFERENCES perfumes(id)
);

USE aromatica;

INSERT INTO perfumes (nome, marca, descricao, preco, categoria, tamanho, imagem, estoque) VALUES
  ('Perfume 1', 'Marca 1', 'Descrição do perfume 1', 100.00, 'Fragrâncias masculinas', '100 ml', '.\imagens\Masculino-1.png', 50),
  ('Perfume 2', 'Marca 2', 'Descrição do perfume 2', 80.00, 'Fragrâncias masculinas', '50 ml', '.\imagens\Masculino-2.png', 20),
  ('Perfume 3', 'Marca 3', 'Descrição do perfume 3', 120.00, 'Fragrâncias femininas', '50 ml', '.\imagens\Feminino-1.png', 30),
  ('Perfume 4', 'Marca 1', 'Descrição do perfume 4', 60.00, 'Fragrâncias femininas', '30 ml', '.\imagens\Feminino-2.png', 15),
  ('Perfume 5', 'Marca 2', 'Descrição do perfume 5', 150.00, 'Fragrâncias masculinas', '100 ml', '.\imagens\Masculino-3.png', 40),
  ('Perfume 6', 'Marca 3', 'Descrição do perfume 6', 90.00, 'Fragrâncias masculinas', '50 ml', '.\imagens\Masculino-4.png', 10),
  ('Perfume 7', 'Marca 1', 'Descrição do perfume 7', 110.00, 'Fragrâncias femininas', '100 ml', '.\imagens\Feminino-3.png', 20),
  ('Perfume 8', 'Marca 2', 'Descrição do perfume 8', 75.00, 'Fragrâncias femininas', '30 ml', '.\imagens\Feminino-4.png', 5),
  ('Perfume 9', 'Marca 3', 'Descrição do perfume 9', 130.00, 'Fragrâncias masculinas', '100 ml', '.\imagens\Neutro-1.png', 25),
  ('Perfume 10', 'Marca 1', 'Descrição do perfume 10', 95.00, 'Fragrâncias femininas', '50 ml', '.\imagens\Neutro-2.png', 10);
