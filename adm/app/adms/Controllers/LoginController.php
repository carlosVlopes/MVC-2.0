<?php

namespace App\adms\Controllers;

/**
 * Controller da página login
 * @author Cesar <cesar@celke.com.br>
 */
class LoginController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    public function __construct($model, $sessionPermi)
    {

        $this->model = $model;

    }

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendLogin'])){

            unset($this->dataForm['SendLogin']);

            if($this->model->login($this->dataForm)){
                $urlRedirect = URLADM . "dashboard/index";
                header("Location: $urlRedirect");
            }
        }

        require_once "app/adms/Views/login/login.php";
    }


}
