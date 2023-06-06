<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>


    <h2 align=center>Ficha de inscrição</h2>
    <form method="post">

        <label class="form-label" for="nome">Nome:</label>
        <input class="form-control" type="text" id="nome" name="nome" required><br>

        <label class="form-label" for="login">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>

        <label class="form-label" for="senha">Telefone</label>
        <input class="form-control" type="tel" id="telefone" name="telefone" required><br>

        <label class="form-label" for="cpf">CPF:</label>
        <input class="form-control" type="text" id="cpf" name="cpf" required><br>

        <label class="form-label" for="sexo">Sexo:</label>
        <select class="form-select" name="sexo" id="sexo">
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
            <option value="naoInformado">Não informar</option>
        </select>


        <div class="mt-3"><input class="btn btn-primary" type="submit" value="Registrar"></div>

    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $cpf = $_POST["cpf"];
        $sexo = $_POST["sexo"];


        $arquivo = "./db/inscritos.txt";
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

        fclose($arquivo_aberto);


        if (!$cpf_existe) {
            $arquivo_aberto = fopen($arquivo, "a");
            $linha = "$nome|$email|$telefone|$cpf|$sexo\n";
            fwrite($arquivo_aberto, $linha);
            fclose($arquivo_aberto);
            echo "<script>alert('Inscrição realizada com sucesso!')</script>";
        } else {
            echo "<script>alert('Este CPF já foi registrado.')</script>";
        }

    }

    ?>



</body>

</html>