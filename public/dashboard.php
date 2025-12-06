<?php
// Arquivo: public_html/dashboard.php

// Inicia a sessão (essencial para ler $_SESSION)
session_start();

// 1. Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: index.php"); 
    exit;
}

// 2. O usuário está logado! Carrega os includes necessários
require_once '../config/db_connection.php';


// 4. Carrega os templates
require_once '../templates/header.php';
require_once '../templates/paginas/dashboard_content.php';
require_once '../templates/footer.php';