<?php

$BRAND = 'Home';
$LANGUAGE = 'pt-br';
$TITLE = $BRAND;

$page = 'home';
if (isset($_GET['p']) && $_GET['p'] != '') {
    $page = $_GET['p'];
}

$INSCRITOS = __DIR__ . '/../db/inscritos.txt';
$CONFIRMADOS = __DIR__ . '/../db/confirmados.txt';