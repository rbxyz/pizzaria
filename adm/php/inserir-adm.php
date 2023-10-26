<?php 
include 'funcoes.php';
$conexao = conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir</title>
</head>
<body>
<?php
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $imagem = $_POST['imagem']
    $retornodafuncaoinserida = inserirProduto(object $conexao, String $nome,  $data, String $descricao, longblob $imagem);
        $conexao = null;
            if ($retornodafuncaoinserida == true) {
                echo("Inserido os dados corretamente!");
            }else{
                echo("Não foi possivel inserir os dados.");
            }
    ?>
</body>
</html>



