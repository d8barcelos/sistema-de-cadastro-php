<h1 align=center>Confirmados</h1>

<table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $arquivo = file("./db/confirmados.txt");
            $dadosUsuarios = array();

            foreach ($arquivo as $linha) {
                $dados = explode("|", $linha);
                if (count($dados) == 5) { 
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

            foreach ($dadosUsuarios as $dados) { ?>
                <tr>
                    <td><?php echo $dados["nome"]; ?></td>
                    <td><?php echo $dados["email"]; ?></td>
                    <td><?php echo $dados["telefone"]; ?></td>
                    <td><?php echo $dados["cpf"]; ?></td>
                    <td><?php echo $dados["sexo"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>