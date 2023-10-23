<?php

namespace App\adms\Controllers;

class UsuariosController
{
    private array|string|null $data;

    private string|int|null $page;

    private int|null $qnt_records = 10;

    private array|null $dataForm;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'usuarios/insert';

        $this->pageEdit = URLADM . 'usuarios/edit';

        $this->pageEditPass = URLADM . 'usuarios/edit-pass';

        $this->pageDelete = URLADM . 'usuarios/delete';

        $this->pageReturn = URLADM . 'usuarios';

        $this->data['sidebarActive'] = "usuarios";

    }

    public function index($page = null) // toda listagem chama o index que chama o list.
    {
        $this->page = (int) $page ? $page : 1;

        self::list();

    }

    public function list()
    {
        $error = false;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm['btn_records'])){
            $this->qnt_records = $this->dataForm['qnt_records'];
        }

        if(!empty($this->dataForm['search_name'])){

            $data = $this->model->searchUser($this->dataForm);

            if(!$data) $error = true;

        }else{

            $data = $this->model->list($this->page, $this->qnt_records);

            if(!$data) $error = true;

            $pagination = $this->model->getResultPg();

            // echo '<pre>';
            // print_r($pagination);
            // echo '</pre>'; exit;
        }

        require_once "app/adms/Views/users/_list.php";
    }

    public function insert()
    {
        if(isset($this->sessionPermi['u_add'])){

            $menus = $this->model->getMenus();

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($this->dataForm['SendAddUser'])){

                unset($this->dataForm['SendAddUser']);

                //arrumar image nao ta salvando

                if($this->model->insert($this->dataForm)){

                   $success = true;

                }

            }

            require_once "app/adms/Views/users/_insert.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    public function edit($id)
    {
        if($id){
            $success = $error = false;

            $menus = $this->model->getMenus();

            $userPermi = $this->model->query['valPermissions']->valPermissions($id);

            $menusActive = $this->model->query['valPermissions']->valPermissions($id, true);

            if($this->sessionPermi['u_edit']){

                $id = (int) $id;

                $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if(!empty($this->dataForm['SendEditUser'])){

                    if($_FILES['image']['error'] == 0){
                        $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
                    }

                    unset($this->dataForm['SendEditUser']);

                    if($this->model->edit($this->dataForm, $id)){

                        $success = true;

                    }
                }else{

                    $data = $this->model->getInfo($id);

                    unset($data['password']);

                    $data['date_expiry'] = implode("/",array_reverse(explode("-", $data['date_expiry'])));
                }

                require_once "app/adms/Views/users/_edit.php";

            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
                $urlRedirect = URLADM . "erro/index";
                header("Location: $urlRedirect");
            }
        }

    }

    public function delete($id)
    {
        if($this->sessionPermi['u_delete']){

            $this->model->delete($id);

            header("Location: $this->pageReturn");

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

    public function editPass($id)
    {
        $success = $error = false;

        if($this->sessionPermi['u_edit']){

            $data['id'] = (int) $id;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($this->dataForm['SendEditPass'])){

                unset($this->dataForm['SendEditPass']);

                if($this->model->editPassword($this->dataForm, $data['id'])){

                    $success = true;

                }
            }

            require_once "app/adms/Views/users/_editPass.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

}