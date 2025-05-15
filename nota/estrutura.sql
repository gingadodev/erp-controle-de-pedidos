
CREATE DATABASE db_erp_controle_pedidos;
USE db_erp_controle_pedidos;

CREATE TABLE tb_produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    preco DECIMAL(10,2)
);

CREATE TABLE tb_estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    variacao VARCHAR(100),
    quantidade INT,
    FOREIGN KEY (id_produto) REFERENCES tb_produtos(id) ON DELETE CASCADE
);

CREATE TABLE tb_cupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE,
    desconto DECIMAL(5,2),
    valor_minimo DECIMAL(10,2),
    validade DATE
);

CREATE TABLE tb_pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subtotal DECIMAL(10,2),
    frete DECIMAL(10,2),
    total DECIMAL(10,2),
    endereco TEXT,
    status ENUM('pendente', 'pago', 'cancelado') DEFAULT 'pendente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
