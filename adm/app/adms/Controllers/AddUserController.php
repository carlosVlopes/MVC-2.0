<?php

namespace App\adms\Controllers;

/**
 * Controller da página novo usuário
 * @author Cesar <cesar@celke.com.br>
 */
class AddUserController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
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
    public function index(): void
    {
        if(isset($this->sessionPermi['u_add'])){

            $this->data['menusActive'] = $this->model->getMenus();

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $this->data['sidebarActive'] = "add-user";

            if(!empty($this->dataForm['SendAddUser'])){

                unset($this->dataForm['SendAddUser']);

                $this->model->create($this->dataForm);

                if($this->model->getResult()){
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewAddUser();
                }
            }else{
                if(isset($this->sessionPermi['u_addPermi'])){
                    $this->data['u_addPermi'] = true;
                }else{
                    $this->data['u_addPermi'] = false;
                }

                $this->viewAddUser();
            }
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewAddUser(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/addUser", $this->data);

        $loadView->loadView();
    }
}
