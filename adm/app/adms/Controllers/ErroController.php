<?php

namespace App\adms\Controllers;

/**
 * Controller da página erro
 * @author Cesar <cesar@celke.com.br>
 */
class ErroController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    public function __construct($model){

        $this->model = $model;

    }

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index():void
    {
        $this->data = '';

        $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
        $loadView->loadViewLogin();
    }
}