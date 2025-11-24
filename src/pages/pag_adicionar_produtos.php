<?php 
require_once "../scripts_e_outros/config.php";
require_once "../scripts_e_outros/funcoes.php";

if($conexao -> connect_error){
    die('Erro ao conectar ao banco de dados ' . $conexao -> connect_error);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome_produto = $_POST['nome_produto'];
    $preco_produto = $_POST['preco_produto'];
    
    $pasta = "../assets/imagens_produtos";

    $nome_arquivo = $_FILES['imagem_produto']['name'];
    $caminho_temporario = $_FILES['imagem_produto']['tmp_name'];
    $caminho_final = $pasta . uniqid() . "_" . basename($nome_produto);

    if(move_uploaded_file($caminho_temporario,$caminho_final)){
        $enviar = $conexao -> prepare('INSERT INTO produto (`nome_produto`,`preco_produto`,`imagem_produto`) VALUES (?,?,?)');
        $enviar -> bind_param('sds',$nome_produto,$preco_produto,$caminho_final);

        if($enviar -> execute()){
            echo 'O produto foi cadastrado!';
        }
        else{
            echo 'Erro ao cadastra ' . $enviar -> error;
        }
        $enviar -> close();
    }
    else{
        echo 'Error ao enviar a imagem.';
    }
}
$conexao -> close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produto</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Adicione o produto</h2>
        <label for="nome_produto">Nome:</label> <br>
        <input type="text" name="nome_produto" required> <br><br>
        <label for="preco_produto">Preço:</label> <br>
        <input type="text" name="preco_produto" step="0.01" required> <br><br>
        <label for="imagem_produto">Imagem:</label> <br>
        <input type="file" name="imagem_produto" accept="image/*" required> <br><br>
        <input type="submit" value="Enviar" id="">

    </form>
</body>
</html>