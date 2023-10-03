<?php

session_start(); // Iniciar a sessão
ob_start(); // Buffer de saida

//Carregar o Composer
require './vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new Core\ConfigController();

//Instanciar o método para carregar a página/controller
$url->loadPage();
