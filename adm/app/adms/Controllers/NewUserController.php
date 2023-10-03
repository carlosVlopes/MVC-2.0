<?php

namespace App\adms\Controllers;

/**
 * Controller da página novo usuário
 * @author Cesar <cesar@celke.com.br>
 */
class NewUserController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    public function __construct($model){

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

        if(!empty($this->dataForm['SendNewUser'])){

            unset($this->dataForm['SendNewUser']);

            $this->model->create($this->dataForm);

            if($this->model->getResult()){
                $urlRedirect = URLADM;
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }           
        }else{
            $this->viewNewUser();
        }        
    }

    private function viewNewUser(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);

        $loadView->loadViewLogin();
    }
}
