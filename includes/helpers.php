<?php

// Arquivo: includes/helpers.php

/**
 * Define uma mensagem flash (para ser exibida após um redirecionamento).
 * @param string $mensagem O texto da mensagem.
 * @param string $tipo O tipo de alerta (sucesso, erro, aviso, info).
 */
function set_flash_message(string $mensagem, string $tipo = 'sucesso'): void {
    // É essencial garantir que a sessão foi iniciada (session_start()) antes de usar isso!
    $_SESSION['flash_message'] = [
        'texto' => $mensagem,
        'tipo' => $tipo
    ];
}

/**
 * Exibe a mensagem flash se existir e, em seguida, a remove da sessão.
 * @return string O HTML do alerta ou uma string vazia.
 */
function get_flash_message(): string {
    if (!isset($_SESSION['flash_message'])) {
        return '';
    }

    $msg = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']); // Remove para que não apareça novamente

    $texto = htmlspecialchars($msg['texto']);
    $tipo = htmlspecialchars($msg['tipo']);

    // Mapeamento do tipo para classes Bootstrap (usando Bootstrap como exemplo)
    $class_map = [
        'sucesso' => 'alert-success',
        'erro' => 'alert-danger',
        'aviso' => 'alert-warning',
        'info' => 'alert-info'
    ];
    $class = $class_map[$tipo] ?? 'alert-info';

    // Gera o HTML do alerta
    return "<div class='alert {$class} alert-dismissible fade show' role='alert'>
                {$texto}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
}