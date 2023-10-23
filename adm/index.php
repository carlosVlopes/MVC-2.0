<?php

session_start(); // Iniciar a sessão
ob_start(); // Buffer de saida

//Carregar o Composer
require './vendor/autoload.php';

$teste = new App\adms\Controllers\LoginController;

echo '<pre>';
print_r($teste);
echo '</pre>'; exit;

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new Core\ConfigController();

//Instanciar o método para carregar a página/controller
$url->loadPage();
