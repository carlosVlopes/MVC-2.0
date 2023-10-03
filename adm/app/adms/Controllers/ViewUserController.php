<?php

namespace App\adms\Controllers;

/**
 * Controller da página visualizar usuarios
 * @author Cesar <cesar@celke.com.br>
 */
class ViewUserController
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
    public function index(int|string|null $id): void
    {
        $checkPermissions = new \App\adms\Models\helper\AdmsValPermissions();

        if($this->sessionPermi['u_view']){

            $this->data = $this->sessionPermi;

            $this->data['sidebarActive'] = "list-users";

            if($id){

                $this->id = (int) $id;

                $this->model->list($this->id);

                if($this->model->getResult()){
                    $this->data['user'] = $this->model->getResultBd();

                    $this->data['user']['permissions'] = $checkPermissions->valPermissions($id);

                    $this->loadView();
                }else{
                    $_SESSION['msg'] = "<p class='alert-danger'>Usuario nao encontrado!</p>";
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }

            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Usuario nao encontrado!</p>";
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

    private function loadView(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }
}