<?php

// Arquivo: includes/funcoes_usuarios.php

/**
 * Tenta autenticar um usuário usando Prepared Statements.
 * @param mysqli $mysqli Objeto de conexão
 * @param string $usuario O nome de usuário ou e-mail
 * @param string $senha A senha em texto puro
 * @return array|null Retorna o array de dados do usuário ou null se falhar.
 */
function autenticar_usuario(mysqli $mysqli, string $usuario, string $senha): ?array {
    
    // 1. Prepared Statement para buscar o usuário
    $stmt = $mysqli->prepare("SELECT id, nome, email, senha_hash FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    
    $resultado = $stmt->get_result();
    $usuario_db = $resultado->fetch_assoc();
    $stmt->close();
    
    // 2. Se o usuário não existe, falha.
    if (!$usuario_db) {
        return null;
    }
    
    // 3. Verifica a senha (USANDO password_verify, o padrão de segurança atual)
    if (password_verify($senha, $usuario_db['senha_hash'])) {
        // Sucesso: Retorna o array de usuário (sem o hash da senha!)
        unset($usuario_db['senha_hash']); 
        return $usuario_db;
    }

    // Falha na senha
    return null;
}