<?php

namespace App\adms\Controllers;

/**
 * Controller da página listar usuarios
 * @author Cesar <cesar@celke.com.br>
 */
class ProdutosController
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    private string|int|null $page;

    private int|null $qnt_records = 10;

    private array|null $dataForm;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'produtos/insert';

        $this->pageEdit = URLADM . 'produtos/edit';

        $this->pageGaleria = URLADM . 'produtos-galeria/index';

        $this->pageDelete = URLADM . 'produtos/delete';

        $this->pageReturn = URLADM . 'produtos/index';

        $this->data['sidebarActive'] = "produtos";

    }

    public function index($page)
    {
        $this->page = (int) $page ? $page : 1;

        self::list();
    }

    public function list()
    {
        $error = false;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm['search_name'])){

            $data = $this->model->searchName($this->dataForm);

            if(!$data) $error = true;

        }else{

            $data = $this->model->list($this->page, $this->qnt_records);

            if(!$data) $error = true;

            $pagination = $this->model->getResultPg();

        }

        require_once "app/adms/Views/produtos/_list.php";

    }

    public function insert()
    {
        if(isset($this->sessionPermi['u_add'])){

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($_FILES['image']['error'] == 0){
                    $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
                }

                if($this->model->create($this->dataForm)){

                    $success = true;

                }
            }

            require_once "app/adms/Views/produtos/_insert.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

    public function edit($id)
    {
        if(isset($this->sessionPermi['u_edit'])){

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($_FILES['image']['error'] == 0){
                    $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
                }

                if($this->model->create($this->dataForm, $id)){

                   $success = true;

                }
            }else{

                $data = $this->model->getInfo($id);

                $url_image = URLADM . 'app/adms/Views/images/products/' . $data['image'];
            }

            require_once "app/adms/Views/produtos/_edit.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

    public function delete($id)
    {
        if(isset($this->sessionPermi['u_delete'])){

            if($this->model->delete($id)){

                $_SESSION['msg'] = "Produto excluido com sucesso!";
                header("Location: $this->pageReturn");

            }

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    public function editOrder()
    {
        $data = $_POST;

        if(!$data['id'] && !$data['order']){

            echo json_encode(['status' => 'error']);
            exit;

        }

        if($data['orderby'] < 1){

            echo json_encode(['status' => 'error', 'message' => 'O campo deve ser maior que 0!']);
            exit;

        }

        $result = $this->model->editOrder($data);

        echo json_encode($result);

        exit;

    }

}