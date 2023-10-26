<?php
include 'funcoes.php';
$conexao = conectar();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <-submeter compra-> </title>
    </head>
    <body>
    <?php
    $nome = $_POST['nome'];
    $mensagem = $_POST['mensagem'];
    $retornodafuncaoinserida = inserirMensagem($conexao, $nome, $mensagem);
        $conexao = null;
            if ($retornodafuncaoinserida == true) {
                echo("Inserido os dados corretamente!");
            }else{
                echo("Não foi possivel inserir os dados.");
            }
    ?>
    </body>
    </html>

    

                
