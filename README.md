# Sistema de Assistência Técnica

![Assistência Técnica](https://via.placeholder.com/800x200.png?text=Assist%C3%AAncia+T%C3%A9cnica)

## Descrição

Este é um sistema de assistência técnica desenvolvido em PHP, que permite gerenciar clientes, serviços e chamados. O sistema oferece uma interface amigável para administradores e possibilita o controle eficiente das operações de uma assistência técnica.

## Funcionalidades

- **Cadastro de Clientes**: Permite registrar informações dos clientes, como nome, telefone, email e endereço.
- **Gerenciamento de Serviços**: Cadastra, lista e edita serviços oferecidos pela assistência técnica.
- **Registro de Chamados**: Permite abrir chamados para serviços solicitados pelos clientes, com acompanhamento de status.
- **Autenticação de Usuários**: Sistema de login e cadastro de administradores para gerenciar as funcionalidades.

## Tecnologias Utilizadas

- **Backend**: PHP
- **Frontend**: HTML, CSS (Bootstrap 5)
- **Banco de Dados**: MySQL

## Estrutura do Banco de Dados

As tabelas principais do banco de dados incluem:

- **clientes**: Armazena informações dos clientes.
- **servicos**: Contém os serviços oferecidos.
- **chamados**: Registra os chamados abertos pelos clientes.
- **usuarios**: Gerencia os usuários administradores do sistema.

### SQL para Criação do Banco de Dados

```sql
-- Criação do banco de dados
CREATE DATABASE assistencia_tecnica;
USE assistencia_tecnica;

-- Tabela de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    endereco VARCHAR(255),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de serviços
CREATE TABLE servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de chamados
CREATE TABLE chamados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    servico_id INT NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('aberto', 'em andamento', 'concluído') DEFAULT 'aberto',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id)
);

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
