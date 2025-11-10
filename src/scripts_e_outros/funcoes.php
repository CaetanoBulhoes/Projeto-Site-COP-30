<?php 
declare(strict_types=1);

function limpar($semEspecial){
    return htmlspecialchars(trim((string)$semEspecial),ENT_QUOTES,'UTF-8');
}

function gerar_csrf_token(){
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    else{
        return $_SESSION['csrf_token'];
    }
}

function verificar_csrf_token(?string $token){
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string)$token);
}

function esta_logado(){
    return !empty($_SESSION['id_cliente']);
}

function precisa_logar(){
    if(!esta_logado()){
        header('Location:../pages/pag_login.php');
        exit;
    }
}
?>