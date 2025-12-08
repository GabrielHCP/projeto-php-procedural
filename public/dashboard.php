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
require_once '../includes/funcoes_dashboard.php';

// OBRIGATÓRIO: Pega o ID da empresa do usuário logado
$empresa_id = $_SESSION['empresa_id'] ?? 0;

if($empresa_id === 0) {
    // Redireciona para o logout se não houver empresa_id válido
    header("Location: logout.php");
    exit;
}

// 3. Busca os dados e armazena em variáveis para usar na dashboard
$dados = [];
$dados['total_clientes_ativos'] = dashboard_contar_clientes_ativos($mysqli, $empresa_id);

// 4. Carrega os templates
require_once '../templates/header.php';
require_once '../templates/paginas/dashboard_content.php';
require_once '../templates/footer.php';