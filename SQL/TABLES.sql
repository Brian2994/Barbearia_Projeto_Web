CREATE TABLE usuarios(
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL UNIQUE,
    senha VARCHAR (255) NOT NULL
); 

CREATE TABLE servicos(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL  
);

INSERT INTO servicos (nome, descricao, preco) VALUES
('Corte de barba', 'Estilo clássico com acabamento preciso', 35.00),
('Corte de cabelo', 'Visual moderno ou tradicional com atenção aos detalhes', 45.00),
('Higiene e cuidados', 'Limpeza profunda e produtos de alta qualidade para sua pele', 50.00),
('Corte e barba', 'Combo completo para um visual alinhado e marcante', 70.00);

CREATE TABLE planos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL
);

CREATE TABLE agendamentos(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    servico_id INT UNSIGNED NOT NULL,
    planos_id INT UNSIGNED DEFAULT NULL,
    data DATE NOT NULL,
    local VARCHAR(100),
    horario TIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id),
    FOREIGN KEY (planos_id) REFERENCES planos(id)
);
