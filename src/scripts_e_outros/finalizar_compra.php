<?php
header("Content-Type: text/plain; charset=utf-8");
require_once "config.php";

// GARANTE que a sessão está ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// garante login
if (!isset($_SESSION['id_cliente'])) {
    exit("Você precisa estar logado para finalizar a compra.");
}

$id_cliente = $_SESSION['id_cliente'];

// lê os dados JSON enviados pelo JS
$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados || empty($dados['itens'])) {
    exit("Nenhum item recebido.");
}

$quantidade_total = 0;
$valor_venda = 0;
$valor_frete = floatval($dados['frete']);

foreach ($dados['itens'] as $item) {
    $quantidade_total += intval($item['qty']);
    $valor_venda += floatval($item['price']) * intval($item['qty']);
}

// insere na tabela
$sql = "INSERT INTO venda (id_cliente, quantidade, valor_venda, valor_frete)
        VALUES (?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    exit("Erro ao preparar a query: " . $conexao->error);
}

$stmt->bind_param("iidd", $id_cliente, $quantidade_total, $valor_venda, $valor_frete);

if ($stmt->execute()) {
    echo "Compra registrada com sucesso!";
} else {
    echo "Erro ao salvar a compra: " . $stmt->error;
}

$stmt->close();
?>