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
    case 'adicionar': 
        $titulo_pagina = "Cadastrar novo cliente";
        $template = "client_form_content.php";
    break;
    case 'editar':

        // 1. Obtém o ID pela URL
        $cliente_id = $_GET['id'] ?? 0;
        if($cliente_id === 0) {
            header("Location: clientes.php?msg=erro_id");
            exit;
        }

        // 2. Busca o cliente no banco (protegido pelo empresa_id)
        $cliente_encontrado = buscar_cliente_por_id($mysqli, $empresa_id, $cliente_id);

        if(!$cliente_encontrado) {
            // Se o cliente não existir
            header("Location: clientes.php?msg=nao_encontrado");
            exit;
        }

        // 3. Define a variável $dados com os dados do cliente
        // Essa variável será usada para pré-preencher o formulário (passo 3)
        $dados = $cliente_encontrado;

        $titulo_pagina = "Editando Cliente: " . htmlspecialchars($dados['nome']);
        $template = "client_form_content.php";
    break;
    case 'salvar': 

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sucesso = salvar_cliente($mysqli, $empresa_id, $_POST);

            if($sucesso) {
                // Sucesso: redireciona para a listagem
                header("Location: clientes.php?msg=sucesso");
                exit;
            } else {
                // Falha: Pode voltar ao formulário
                $dados = $_POST;
                $titulo_pagina = "Erro no cadastro";
                $template = 'client_form_content.php';
            }

        } else {
            // Se alguém tentar acessar ?acao=salvar via GET, manda para a listagem
            header("Location: clientes.php");
            exit;
        }
    break;
    case 'excluir': 

        // 1. Obtém o ID da URL e converte para inteiro
        $cliente_id = $_GET['id'] ?? 0;

        if($cliente_id > 0) {
            $sucesso = excluir_cliente($mysqli, $empresa_id, $cliente_id);

            if($sucesso) {
                $mensagem = "Cliente excluído com sucesso (exclusão lógica).";
            } else {
                $mensagem = "Erro ao excluir cliente ou cliente não encontrado.";
            }
        } 

        // Redireciona de volta para a listagem (usando o método GET)
        header("Location: clientes.php?msg=" . urlencode($mensagem));
        exit;
 
    break;
   
}

// 4. Carrega os templates
require_once '../templates/header.php';
require_once '../templates/paginas/' . $template;
require_once '../templates/footer.php';