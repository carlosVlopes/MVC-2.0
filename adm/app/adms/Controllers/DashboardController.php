<?php

namespace App\adms\Controllers;

/**
 * Controller da pagina Dashboard
 * @author Cesar <cesar@celke.com.br>
 */
class DashboardController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

    }

    /**
     * Instantiar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index():void
    {
        $this->model->getUsers();

        $this->data = $this->model->getResult();

        $this->data['sidebarActive'] = "dashboard";

        $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}