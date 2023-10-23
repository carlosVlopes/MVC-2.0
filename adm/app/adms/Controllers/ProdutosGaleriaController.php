<?php

namespace App\adms\Controllers;


class ProdutosGaleriaController
{

    private array|string|null $data;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'produtos-galeria/insert';

        $this->pageDelete = URLADM . 'produtos-galeria/delete';

        $this->pageReturn = URLADM . 'produtos-galeria/index';

        $this->data['sidebarActive'] = "produtos";

    }

    public function index($id_product)
    {

        $this->id_product = $id_product;

        self::list();

    }

    public function list()
    {
        $error = false;

        $data = $this->model->getGaleria($this->id_product);

        if(!$data) $error = true;

        require_once "app/adms/Views/produtos/galeria/_list.php";

    }

    public function insert($id_product)
    {
        require_once "app/adms/Views/produtos/galeria/_insert.php";

    }

    public function edit()
    {
        $data = $_POST;

        if(!$data['id'] && !$data['orderby'] && !$data['name']){

            echo json_encode(['status' => 'error']);
            exit;

        }

        $result = $this->model->edit($data);

        echo json_encode($result);

        exit;

    }

    public function upload()
    {
        $id_product = $_POST['id_product'];

        $file = $_FILES['file'];

        if($file && $id_product){

            return $this->model->upload($file, $id_product);

        }

    }

    public function delete()
    {
        if(!$_POST){

            echo json_encode(['status' => 'error']);
            exit;

        }

        $result = $this->model->delete($_POST);

        echo json_encode($result);

        exit;
    }

}