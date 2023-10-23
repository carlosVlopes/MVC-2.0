<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class ProdutosModel
{

    private int $page;

    private string|null $resultPg;

    private int $limitResult;


    public function __construct($query){

        $this->query = $query;

    }

    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    public function list(int $page = null, int $qnt_records)
    {
        $this->query['select']->exeSelect("pr_products", '',"" , "");

        if(empty($this->query['select']->getResult())){

            return false;
        }

        $this->page = (int) $page ? $page : 1;

        $this->limitResult = $qnt_records;

        $pagination = new Pagination(URLADM . 'produtos/index', 'pr_products');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $this->query['select']->exeSelect("pr_products", '',"LIMIT :limit OFFSET :offset" , "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }

    public function create(array $data,int|string $id = null)
    {
        $this->data = $data;

        if(isset($this->data["image"])){
            $image = $this->data["image"];
        }

        unset($this->data["image"]);

        if(isset($image)){

            $this->query['upload']->upload($image, $this->data['name'], "app/adms/Views/images/products/");

            if($this->query['upload']->getResult()){
                $this->data['image'] = $this->query['upload']->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";

                return false;
            }

            $noVal['image'] = $this->data['image'];
        }

        unset($this->data['image']);

        $this->query['valField']->valField($this->data); // chama o metodo do objeto

        if(!$this->query['valField']->getResult()) return false;

        if(isset($image)){
            $this->data['image'] = $noVal['image'];
        }

        if(!$id){ // caso for insert

            $this->query['create']->exeCreate("pr_products", $this->data);

            if($this->query['create']->getResult()){

                $_SESSION['msg'] = "<p class='alert-success'>Produto adicionado com sucesso!</p>";
                return true;

            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Produto não adicionado, Tente novamente!</p>";
                return false;
            }

        }else{ // caso for editar

            $this->query['update']->exeUpdate("pr_products", $this->data, 'WHERE id = :id', "id={$id}");

            if($this->query['update']->getResult()){

                $_SESSION['msg'] = "<p class='alert-success'>Produto editado com sucesso!</p>";
                return true;

            }else{

                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Produto não editado, Tente novamente!</p>";
                return false;

            }
        }

    }

    public function delete($id)
    {

        $this->query['delete']->delete('pr_products', "WHERE id=:id", "id={$id}");

        return $this->query['delete']->getResult();
    }

    public function getInfo($id)
    {

        $this->query['select']->exeSelect("pr_products", '', 'WHERE id=:id', "id={$id}");

        $result = $this->query['select']->getResult();

        return $result[0];

    }

    public function getGaleria($id)
    {

        $this->query['select']->exeSelect("pr_products_pictures", '', "WHERE id_product = :id_product", "id_product={$id}");

        return $this->query['select']->getResult();

    }

    public function searchName($data)
    {
        $this->query['select']->exeSelect("adms_users", 'id,name,email,date_expiry',"WHERE name = :name OR email = :email" , "name={$data['search_name']}&email={$data['search_name']}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }

    public function editOrder($data)
    {

        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("pr_products", $data,"WHERE id = :id", "id={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

}
