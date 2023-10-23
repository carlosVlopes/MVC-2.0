<?php

namespace App\adms\Models;

class ProdutosGaleriaModel
{
    public function __construct($query){

        $this->query = $query;

    }

    public function upload($file, $id_product)
    {
        $this->query['upload']->upload($file, $id_product, "app/adms/Views/images/products/galeria/");

        if(!$this->query['upload']->getResult()) return false;

        $data['image'] = $this->query['upload']->nameImage();

        $data['name'] = '';

        $orderby = self::getEndOrder($id_product);

        $data['orderby'] = $orderby['orderby'] + 1;

        $data['id_product'] = $id_product;

        $this->query['create']->exeCreate("pr_products_pictures", $data);

        return $this->query['create']->getResult();
    }

    public function delete($id)
    {
        $this->query['delete']->delete('pr_products_pictures', "WHERE id_picture=:id_picture", "id_picture={$id['id']}");

        $result = $this->query['delete']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function getGaleria($id)
    {

        $this->query['select']->exeSelect("pr_products_pictures", '', "WHERE id_product = :id_product", "id_product={$id}");

        return $this->query['select']->getResult();

    }

    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("pr_products_pictures", $data, "WHERE id_picture=:id_picture", "id_picture={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

    private function getEndOrder($id_product)
    {
        $this->query['select']->exeSelect("pr_products_pictures", 'orderby', 'WHERE id_product=:id_product ORDER BY orderby DESC limit 1', "id_product={$id_product}");

        $result = $this->query['select']->getResult();

        return $result[0];
    }

}
