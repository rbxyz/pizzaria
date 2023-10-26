<?php
// conect
function conectar() : object {
    //mudar de acordo com cada projeto
    $bd = "pizzaria";
    $username = "root";
    $password = "";
    $conect = new PDO ("mysql:host=localhost;dbname=$bd",$username, $password);
    return $conect;
}
// excluir
function excluirPessoa(object $conexao, int $id): bool {
    
    $sql = "DELETE FROM pessoa WHERE idPessoa = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    // return $stmt -> execute();
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// pessoa nome pesquisado
function listarPorNomePesquisado(object $conexao, String $nome): void{
    $sql = "SELECT * FROM pessoa WHERE nome LIKE :nome";
    $stmt = $conexao->prepare($sql);
    // No bindParam() o argumento esperado é uma referência (variável ou constante) 
    // e não pode ser um tipo primitivo como uma string ou número solto,
    //  retorno de função/método. Já bindValue() pode receber referências e valores como argumento.
    $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
    $stmt->execute();
    return;
}

// listar pessoas
function  listarPessoas(object $conexao) : void {
    $sql = "SELECT * FROM pessoa";
    $stmt = $conexao->prepare($sql);
    if($stmt->execute()){
        echo "<table border='1'>";
        echo "<th>ID</th><th>Nome</th><th>Sobrenome</th><th>Rua</th><th>Número</th><th>Idade</th>";
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // echo print_r($row);
            echo "<tr>";
            echo "<td>".$row['idPessoa']."</td>";
            echo "<td>".$row['nome']."</td>";
            echo "<td>".$row['sobrenome']."</td>";
            echo "<td>".$row['rua']."</td>";
            echo "<td>".$row['numero']."</td>";
            echo "<td>".$row['idade']."</td>";
            echo "</tr>";
        }
    
        echo "</table>";
    }else{
        echo "erro!";
    }
    return;
}
function inserirPessoa(object $conexao, String $nome, String $sobrenome, String $rua, int $numero, int $idade):bool {
    $sql = "INSERT INTO pessoa (nome, sobrenome, rua, numero, idade) VALUES(?,?,?,?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1,$nome,PDO::PARAM_STR);
    $stmt->bindParam(2,$sobrenome,PDO::PARAM_STR);
    $stmt->bindParam(3,$rua,PDO::PARAM_STR);
    $stmt->bindParam(4,$numero,PDO::PARAM_INT);
    $stmt->bindParam(5,$idade,PDO::PARAM_INT);
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}



// maiores de idade
function listarPessoasMaioresIdade($conexao) {
    $sql = "SELECT * FROM pessoas WHERE idade >= 18";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
}

// somaidades
function somarIdadesPessoas($conexao) {
    $sql = "SELECT SUM(idade) as soma_idades FROM pessoas";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['soma_idades'];
}

// soma
function mostrarSomaIdadesPessoas($auxIdade) {
    echo "A soma das idades das pessoas é: $auxIdade";
}

// aletrrar pessoa
function alterarPessoa($conexao, $nome, $rua, $idPessoa, $auxNumero, $auxSobrenome, $auxIdade) {
    $sql = "UPDATE pessoas SET nome = :nome, rua = :rua, numero = :numero, sobrenome = :sobrenome, idade = :idade WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":rua", $rua, PDO::PARAM_STR);
    $stmt->bindParam(":numero", $auxNumero, PDO::PARAM_INT);
    $stmt->bindParam(":sobrenome", $auxSobrenome, PDO::PARAM_STR);
    $stmt->bindParam(":idade", $auxIdade, PDO::PARAM_INT);
    $stmt->bindParam(":id", $idPessoa, PDO::PARAM_INT);
    return $stmt->execute();
}

// A PARTIR DAQUI É DO PROJJETO PIZZARIA
function inserirMensagem(object $conexao, String $nome, String $mensagem):bool {
    $sql = "INSERT INTO contato (nome, mensagem) VALUES(?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1,$nome,PDO::PARAM_STR);
    $stmt->bindParam(2,$mensagem,PDO::PARAM_STR);
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
?>
