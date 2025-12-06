<?php

// 1. Carrega as constantes de configuração do banco de dados
require_once __DIR__ . '/settings.php';

// 2. Configura o mysqli para lançar EXCEÇÕES
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Cria o objeto de conexão
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Define o charset para utf8mb4
    $mysqli->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    // Em caso de erro, registra no log e para o sistema
    error_log("Erro de Conexão: " . $e->getMessage());
    die("Erro interno ao conectar ao banco de dados.");
}