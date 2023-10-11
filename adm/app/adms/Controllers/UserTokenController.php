<?php

namespace App\adms\Controllers;


class UserTokenController
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    private int|string|null $id;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

    }

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        if(isset($this->sessionPermi['a_api'])){

            $this->id = $_SESSION['user_id'];

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($this->dataForm['newToken'])){

                unset($this->dataForm['newToken']);

                $result = $this->model->generateToken($this->id);

                if($result['updated'] == 1){

                    $_SESSION['msg'] = "<p class='alert-success'>Token gerado com sucesso!</p>";

                    $this->data['token_api'] = $result['token'];

                    $this->loadView();

                }else{
                    $this->data = $this->model->getToken($this->id);

                    $_SESSION['msg'] = "<p class='alert-danger'>Ocorreu um erro ao gerar um novo token</p>";

                    $this->loadView();

                }

            }

            $this->data = $this->model->getToken($this->id);

            $this->loadView();
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }


    }

    private function loadView(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/UserToken/view", $this->data);
        $loadView->loadView();
    }
}