<?php 
// Arquivo: public_html/clientes.php

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
require_once '../includes/funcoes_clientes.php';

$empresa_id = $_SESSION['empresa_id'] ?? 0;
if($empresa_id === 0) {
    header("Location: index.php");
    exit;
}

// ----------------------------------------------------
// 2. CONTROLADOR DE AÇÕES (O SWITCH)
// Verifica se há uma ação na URL (ex: clientes.php?acao=adicionar)
// ----------------------------------------------------
$acao = $_GET['acao'] ?? 'listar';
$dados = []; // Array que passará dados para a view

switch($acao) {
    case 'listar': 
        $dados['lista_clientes'] = listar_todos_clientes($mysqli, $empresa_id);
        $titulo_pagina = "Clientes Cadastrados";
        $template = 'client_list_content.php';
    break;

}

// 4. Carrega os templates
require_once '../templates/header.php';
require_once '../templates/paginas/' . $template;
require_once '../templates/footer.php';