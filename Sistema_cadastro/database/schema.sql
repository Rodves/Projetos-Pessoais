-- =============================================
-- BANCO DE DADOS: sistema_ead
-- Sistema Web de Gerenciamento de Atividades EAD
-- =============================================

CREATE DATABASE IF NOT EXISTS `sistema_ead` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sistema_ead`;

-- 1. Tabela de Administradores
CREATE TABLE IF NOT EXISTS `adm` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabela de Professores
CREATE TABLE IF NOT EXISTS `professores` (
    `codigo` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabela de Turmas
CREATE TABLE IF NOT EXISTS `turmas` (
    `codigo` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `professor_codigo` INT NOT NULL,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_turmas_professor` FOREIGN KEY (`professor_codigo`) 
        REFERENCES `professores` (`codigo`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabela de Atividades / Demandas
CREATE TABLE IF NOT EXISTS `demanda` (
    `codigo` INT AUTO_INCREMENT PRIMARY KEY,
    `atividade` TEXT NOT NULL,
    `turma_codigo` INT NOT NULL,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_demanda_turma` FOREIGN KEY (`turma_codigo`) 
        REFERENCES `turmas` (`codigo`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- DADOS INICIAIS PARA TESTE
-- =============================================

-- Administrador padrão: admin@ead.com / admin123
INSERT INTO `adm` (`nome`, `email`, `senha`) VALUES
('Administrador Geral', 'admin@ead.com', 'admin123')
ON DUPLICATE KEY UPDATE `nome` = VALUES(`nome`);

-- Professor padrão: professor@ead.com / prof123
INSERT INTO `professores` (`nome`, `email`, `senha`) VALUES
('Carlos Drummond', 'professor@ead.com', 'prof123')
ON DUPLICATE KEY UPDATE `nome` = VALUES(`nome`);
