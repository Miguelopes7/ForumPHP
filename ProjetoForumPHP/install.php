<?php
    //install.php

    //Criar a base de dados que suporta o site
    include 'config.php';

    //Criar a base de dados
    $ligacao = new PDO("mysql:$host", $user, $password);
    $motor = $ligacao->prepare("CREATE DATABASE $base_dados"); //criar base dados com ligação 
    $motor->execute(); //executa a variável motor
    $ligacao = null; //fecha a ligação

    echo '<p>Base de dados criada com sucesso</p><hr>';

    //Abrir a base de dados para adicionar as tabelas
    $ligacao = new PDO("mysql:dbname=$base_dados;host=$host", $user, $password);

    //Tabela "users" - utilizadores do fórum
    $sql="CREATE TABLE users(
        id_user     INT NOT NULL PRIMARY KEY,
        username    VARCHAR(30),
        pass        VARCHAR(100),
        avatar      VARCHAR(250)
    )";

    $motor = $ligacao->prepare($sql);
    $motor->execute();

    echo '<p>Tabela "users" criada com sucesso.</p>';

    //Tabela "posts" - posts do forum
    $sql="CREATE TABLE posts(
       id_post      INT NOT NULL PRIMARY KEY,
       id_user      INT NOT NULL,
       titulo       VARCHAR(100),
       mensagem     TEXT,
       data_post    DATETIME,
       FOREIGN KEY(id_user) REFERENCES users(id_user) ON DELETE CASCADE 
    )";

    $motor = $ligacao->prepare($sql);
    $motor->execute();

    $ligacao = null;

    echo '<p>Tabela "posts" criada com sucesso.</p>';
    echo '<hr>';
    echo '<p>Processo de criação de base de dados terminado com sucesso.</p>';
?>
