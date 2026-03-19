<?php
$host = 'db';
$db = 'metas_db';
$user = 'root';
$pass = 'root';

try {
    // Tentamos criar a conexão usando PDO (PHP Data Objects)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
    // Configuramos o PDO para nos avisar se houver qualquer erro de SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Conexão estabelecida!"; // Descomente apenas para testar
} catch (PDOException $e) {
    // Se algo der errado, o 'catch' captura o erro e impede o sistema de expor dados sensíveis
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>