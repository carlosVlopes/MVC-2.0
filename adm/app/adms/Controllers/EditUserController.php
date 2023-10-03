<?php

namespace App\adms\Controllers;

/**
 * Controller da página novo usuário
 * @author Cesar <cesar@celke.com.br>
 */
class EditUserController
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
    public function index(int|string|null $id): void
    {
        $this->data['menusActive'] = $this->model->getMenus();

        $checkPermissions = new \App\adms\Models\helper\AdmsValPermissions();

        $permissions_userEdit = $checkPermissions->valPermissions($id);

        $permissions_menusEdit = $checkPermissions->valPermissions($id, true);

        $menus = $this->model->getMenus();

        if($this->sessionPermi['u_edit']){

            $id = (int) $id;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($this->dataForm['SendEditUser'])){

                if($_FILES['image']['error'] == 0){
                    $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
                }

                unset($this->dataForm['SendEditUser']);

                $this->model->create($this->dataForm, $id);

                if($this->model->getResult()){
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }else{
                    $this->data = $this->model->getInfo($id);
                    $this->viewAddUser();
                }
            }else{

                $this->data = $this->model->getInfo($id);

                $this->data['menusActive'] = $permissions_menusEdit;

                unset($this->data['password']);

                $this->data['menus'] = $menus;

                $this->data['userPermi'] = $permissions_userEdit;

                $this->data['sessionPermi'] = $this->sessionPermi;

                $this->viewAddUser();
            }
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    public function editPass(int|string|null $id)
    {
        if($this->sessionPermi['u_edit']){

            $id = (int) $id;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($this->dataForm['SendEditPass'])){

                unset($this->dataForm['SendEditPass']);

                $this->model->editPassword($this->dataForm, $id);

                if($this->model->getResultPass()){
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }else{
                    $loadView = new \Core\ConfigView("adms/Views/users/editPass", $this->data);

                    $loadView->loadView();
                }
            }else{
                $this->data['id'] = $id;

                $loadView = new \Core\ConfigView("adms/Views/users/editPass", $this->data);

                $loadView->loadView();
            }
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    public function delete(int|string|null $id)
    {
        if($this->sessionPermi['u_delete']){

            $id = (int) $id;

            $this->model->delete($id);

            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");


        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewAddUser(): void
    {

        $loadView = new \Core\ConfigView("adms/Views/users/editUser", $this->data);

        $loadView->loadView();
    }
}
