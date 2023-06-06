<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <h1>Admin</h1>

    <?php
    session_start();


    if (!isset($_SESSION["id_usuario"])) {
        header("Location: ./?p=login");
        exit();
    }

    ?>


    <?php

    $arquivo = file("./db/inscritos.txt");
    $dadosUsuarios = array();

    foreach ($arquivo as $linha) {
        $dados = explode("|", $linha);
        if (count($dados) == 5) { // Verifica se a linha contém todos os campos
            $dadosAssociativos = array(
                "nome" => $dados[0],
                "email" => $dados[1],
                "telefone" => $dados[2],
                "cpf" => $dados[3],
                "sexo" => $dados[4]
            );
            array_push($dadosUsuarios, $dadosAssociativos);
        }
    }
    foreach ($arquivo as $linha) {
        $dados = explode("|", $linha);
    }
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Confirmar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dadosUsuarios as $dados) { ?>
                <form action="" method="post">
                    <tr>
                        <td>
                            <?php echo $dados["nome"]; ?>
                            <input type="hidden" name="nome" value="<?php echo $dados["nome"]; ?>">
                            <input type="hidden" name="cpf" value="<?php echo $dados['cpf']; ?>">

                        </td>
                        <td>
                            <button class='btn btn-primary' value="confirmar" name="confirmar">Confirmar</button>
                            <button class='btn btn-danger' value="excluir" name="excluir">Excluir</button>
                        </td>
                    </tr>
                </form>
            <?php } ?>
        </tbody>
    </table>

    <?php



    function escreverConfirmados($dados)
    {
        $arquivo = "./db/confirmados.txt";
        $linha = implode("|", $dados) . "\n";
        file_put_contents($arquivo, $linha, FILE_APPEND);
    }

    if (isset($_POST['confirmar'])) {
        // Encontra o número da linha correspondente ao participante a ser removido

        $cpf = $_POST['cpf'];
        $numLinha = null;
        $arquivo = fopen('./db/inscritos.txt', 'r');
        $linhaAtual = 0;
        while (!feof($arquivo)) {
            $linha = fgets($arquivo);
            if (strpos($linha, $cpf) !== false) {
                $numLinha = $linhaAtual;
                break;
            }
            $linhaAtual++;
        }
        fclose($arquivo);

        
        $arquivo = "./db/confirmados.txt";
        $arquivo_aberto = fopen($arquivo, "r");
        $cpf_existe = false;

        while (!feof($arquivo_aberto)) {
            $linha = fgets($arquivo_aberto);
            $dados = explode("|", $linha);
            if (count($dados) > 3 && $dados[3] == $cpf) {
                $cpf_existe = true;
                break;
            }
        }
        if (!$cpf_existe) {
        // Remove a linha correspondente ao participante
        if ($numLinha !== null) {
            removerLinha('./db/inscritos.txt', $numLinha);
        }

        escreverConfirmados($_POST);
        $nome = $dados['nome'];
        $email = $dados['email'];
        $telefone = $dados['telefone'];
        $cpf = $dados['cpf'];
        $sexo = $dados['sexo'];
        $dadosConfirmados = array($nome, $email, $telefone, $cpf, $sexo);
        escreverConfirmados($dadosConfirmados);

        echo '<h2>Cadastro confirmado!</h2>';
    }
    }

    $cpf = $_POST['cpf'];
        $numLinha = null;
        $arquivo = fopen('./db/inscritos.txt', 'r');
        $linhaAtual = 0;
        while (!feof($arquivo)) {
            $linha = fgets($arquivo);
            if (strpos($linha, $cpf) !== false) {
                $numLinha = $linhaAtual;
                break;
            }
            $linhaAtual++;
        }
        fclose($arquivo);

    if (isset($_POST['excluir'])) {
        removerLinha('./db/inscritos.txt', $numLinha);
    }

    ?>

    <div class="mt-3">
    <a href="./?p=confirmados"><button class="btn btn-outline-primary">Ver confirmações</button></a>
    </div>




</body>

</html>