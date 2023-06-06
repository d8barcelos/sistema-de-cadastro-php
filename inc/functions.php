<?php
function removerLinha($arquivo, $linha) {
    // Lê o conteúdo do arquivo
    $conteudo = file($arquivo);

    // Remove a linha indicada
    unset($conteudo[$linha]);

    // Sobrescreve o arquivo com o novo conteúdo+
    file_put_contents($arquivo, implode("", $conteudo));
}



