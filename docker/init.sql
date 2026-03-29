CREATE TABLE IF NOT EXISTS metas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    prazo DATE NOT NULL,
    descricao TEXT,
    progresso INT DEFAULT 0
);