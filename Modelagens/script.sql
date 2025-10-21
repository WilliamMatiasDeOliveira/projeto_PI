DROP DATABASE IF EXISTS bd_conecte;

CREATE DATABASE IF NOT EXISTS bd_conecte
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE bd_conecte;

CREATE TABLE IF NOT EXISTS enderecos(
	id_endereco BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	cep VARCHAR(11) NOT NULL,
	cidade VARCHAR(255) NOT NULL,
	bairro VARCHAR(255) NOT NULL,
	rua VARCHAR(255) NOT NULL,
	numero VARCHAR(45)
);

CREATE TABLE IF NOT EXISTS clientes(
	id_cliente BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	cpf VARCHAR(14) UNIQUE NOT NULL,
	senha VARCHAR(255) NOT NULL,
	tipo VARCHAR(8) NOT NULL,
	telefone VARCHAR(14) NOT NULL,
	foto VARCHAR(255),
	endereco_id BIGINT UNSIGNED,
	FOREIGN KEY (endereco_id) REFERENCES enderecos(id_endereco)
);

CREATE TABLE IF NOT EXISTS cuidadores(
	id_cuidador BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	cpf VARCHAR(14) UNIQUE NOT NULL,
	senha VARCHAR(255) NOT NULL,
	tipo VARCHAR(8) NOT NULL,
	telefone VARCHAR(45) NOT NULL,
	foto VARCHAR(255),
	curriculo VARCHAR(255),
	endereco_id BIGINT UNSIGNED,
	FOREIGN KEY (endereco_id) REFERENCES enderecos(id_endereco)
);


CREATE TABLE IF NOT EXISTS especialidades(
	id_especialidade BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	nome_especialidade VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS cuidador_especialidade(
	cuidador_id BIGINT UNSIGNED,
	especialidade_id BIGINT UNSIGNED
);

CREATE TABLE IF NOT EXISTS servicos(
	id_servico BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	data_inicio DATE NOT NULL,
	data_fim DATE,
	estatus ENUM('aceito', 'pendente', 'concluido') NOT NULL,
	cliente_id BIGINT UNSIGNED,
	cuidador_id BIGINT UNSIGNED,
	FOREIGN KEY (cliente_id) REFERENCES clientes(id_cliente),
	FOREIGN KEY (cuidador_id) REFERENCES cuidadores(id_cuidador)
);

CREATE TABLE IF NOT EXISTS avaliacoes(
	id_avaliacao BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	gostei BIGINT UNSIGNED,
	nao_gostei BIGINT UNSIGNED,
	comentario TEXT,
	cliente_id BIGINT UNSIGNED,
	cuidador_id BIGINT UNSIGNED,
	servico_id BIGINT UNSIGNED,
	FOREIGN KEY (cliente_id) REFERENCES clientes(id_cliente),
	FOREIGN KEY (cuidador_id) REFERENCES cuidadores(id_cuidador),
	FOREIGN KEY (servico_id) REFERENCES servicos(id_servico)
);














































