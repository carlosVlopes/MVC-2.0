<?php

namespace App\adms\Controllers;

/**
 * Controller da página listar usuarios
 * @author Cesar <cesar@celke.com.br>
 */
class ListUsersController
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    private string|int|null $page;

    private int|null $qnt_records = 10;

    private array|null $dataForm;

    public function __construct($model, $sessionPermi){

        $this->model = $model;
        $this->sessionPermi = $sessionPermi;

    }

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     *
     * @return void
     */
    public function index(string|int|null $page = null): void
    {
        $checkPermissions = new \App\adms\Models\helper\AdmsValPermissions();

        $this->data['permissions'] = $this->sessionPermi;

        $this->page = (int) $page ? $page : 1;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm['btn_records'])){
            $this->qnt_records = $this->dataForm['qnt_records'];
        }

        $this->data['error'] = false;

        if(!empty($this->dataForm['search_name'])){

            $this->model->searchUser($this->dataForm);

            $this->data['listUsers'] = $this->model->getResultBd();

            if($this->data['listUsers']){

                $this->data['pagination'] = '';

                $this->loadView();

            }else{
                $this->data['error'] = true;
            }

            $this->data['listUsers'] = [];
            $this->data['pagination'] = '';
        }else{


            $this->model->list($this->page, $this->qnt_records);

            if($this->model->getResult()){
                $this->data['listUsers'] = $this->model->getResultBd();

                $this->data['pagination'] = $this->model->getResultPg();
            }else{
                $this->data['listUsers'] = [];
                 $this->data['pagination'] = '';
            }
        }

        $this->data['sidebarActive'] = "list-users";

        $this->loadView();

    }

    public function loadView()
    {
        $this->data['qnt_records'] = $this->qnt_records;

        $loadView = new \Core\ConfigView("adms/Views/users/listUsers", $this->data);
        $loadView->loadView();
    }


}