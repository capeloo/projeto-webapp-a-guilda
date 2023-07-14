<?php
    //Arquivo que configura a ligação com o banco de dados

    // 1. Definir os parâmetros
    define('HOST', 'localhost');
    define('USER', 'admin');
    define('PASSWORD', '6@J/.Slp6e!yor!w');
    define('DATABASE', 'taverna');

    // 2. Criar objeto mysqli e atribuir a uma variável
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>