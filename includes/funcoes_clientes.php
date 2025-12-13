<?php

// Arquivo: includes/funcoes_clientes.php


/**
 *  Lista todos os clientes para a empresa logada.
 *  @param mysqli $mysqli objeto de conexão
 *  @param int $empresa_id ID da empresa logada
 *  @return array lista de clientes
 */
function listar_todos_clientes(mysqli $mysqli, int $empresa_id): array {

    $sql = "SELECT id, nome, email_contato, status, data_cadastro FROM clientes
            WHERE empresa_id = ? 
            ORDER BY id ASC";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $empresa_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $lista = $resultado->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $lista;
}