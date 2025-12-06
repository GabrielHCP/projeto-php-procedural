<?php 
// Arquivo: public_html/index.php

// Inicia a sessão para armazenar o estado de login
session_start();

// 1. Carrega o núcleo (Conexão e Lógica)
require_once '../config/db_connection.php'; // Define $mysqli
require_once '../includes/funcoes_usuarios.php';

// 2. Verifica se a requisição é um POST (tentativa de login)
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = $_POST['email'] ?? '';
    $senha = $_POST['password'] ?? '';
    $erro = '';

    $user = autenticar_usuario($mysqli, $usuario, $senha);

    if($user) {

        // Login bem-sucedido
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];
        $_SESSION['logado'] = true;

        // Redireciona para a dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos.';
    }

} else {
    // Se a requisição não for POST, apenas exibe a tela de login
    $erro = '';
}

// 3. Exibe a tela de login (Se o login falhou ou é GET)
require_once '../templates/paginas/login.php';