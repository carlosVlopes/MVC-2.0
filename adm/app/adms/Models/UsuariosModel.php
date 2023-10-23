<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class UsuariosModel
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
        $this->page = (int) $page ? $page : 1;

        $this->limitResult = $qnt_records;

        $pagination = new Pagination(URLADM . 'list-users/index', 'adms_users');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $this->query['select']->exeSelect("adms_users", 'id,name,email,date_expiry',"LIMIT :limit OFFSET :offset" , "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }

    public function insert($data)
    {
        $this->data = $data;

        $this->data = $this->query['constructJson']->construct($this->data);

        $this->query['valField']->valField($this->data); // chama o metodo do objeto

        $this->query['valPassword']->valPassword($this->data['password']);

        if($this->query['valPassword']->getResult()){

            if(!$this->vfEmailUser($this->data['email'], $this->data['user'])) return false;

            if(!$this->query['valField']->getResult()) return false;

            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

            $this->data['created'] = date("Y-m-d H:i:s");

            $this->data['date_expiry'] = date("Y-m-d", strtotime('+ 1 year'));

            $this->query['create']->exeCreate("adms_users", $this->data);

            if($this->query['create']->getResult()){
                $_SESSION['msg'] = "<p class='alert-success'>Usuário cadastrado com sucesso!</p>";
                return true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não cadastrado com sucesso!</p>";
                return false;
            }
        }
    }

    public function edit($data, $id)
    {
        $this->data = $data;

        $this->data = $this->query['constructJson']->construct($this->data);

        $this->id = $id;

        if(isset($this->data["image"])){
            $image = $this->data["image"];
        }

        unset($this->data["image"]);

        if(isset($image)){

            $this->query['upload']->upload($image, $id, "app/adms/Views/images/users/");

            if($this->query['upload']->getResult()){
                $this->data['image'] = $this->query['upload']->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";
                return false;
            }

            $noVal['image'] = $this->data['image'];
        }


        if(isset($image)){
            $noVal['image'] = $this->data['image'];
        }

        unset($this->data['image']);

        $this->query['valField']->valField($this->data); // chama o metodo do objeto

        if(!$this->vfEmailUser($this->data['email'], $this->data['user'], $this->id)) return false;

        if(!$this->query['valField']->getResult()) return false;

        if(isset($image)){
            $this->data['image'] = $noVal['image'];
        }

        $this->data['modified'] = date("Y-m-d H:i:s");

        $this->data['date_expiry'] = implode("-",array_reverse(explode("/",$this->data['date_expiry'])));

        $this->query['update']->exeUpdate("adms_users", $this->data , "WHERE id=:id" , "id={$this->id}");

        if($this->query['update']->getResult()){

            if($this->id == $_SESSION['user_id'] && isset($image)) $_SESSION['user_image'] = $noVal['image'];

            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não editado, Tente novamente!</p>";
            return false;
        }
    }

    public function delete($id)
    {
        $this->query['delete']->delete("adms_users", "WHERE id=:id", "id={$id}");

        if($this->query['delete']->getResult()){

            $_SESSION['msg'] = "<p class='alert-success'>Usuario deletado com sucesso!</p>";

            return true;

        }else{

            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuario nao deletado, Tente novamente!</p>";

            return false;

        }
    }

    public function editPassword($password, $id)
    {
        if($password['password'] !== $password['co_password']){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro:Confirmar Senha deve ser igual a Senha!</p>";
            return false;
        }else{
            unset($password['co_password']);

            $this->query['valPassword']->valPassword($password['password']);

            if($this->query['valPassword']->getResult()){
                $password['password'] = password_hash($password['password'], PASSWORD_DEFAULT);

               $this->query['update']->exeUpdate("adms_users", $password , "WHERE id=:id" , "id={$id}");

                if($this->query['update']->getResult()){
                    $_SESSION['msg'] = "<p class='alert-success'>Senha editada com sucesso!</p>";
                    return true;
                }else{
                    $_SESSION['msg'] = "<p class='alert-danger'>Erro: Senha nao foi editada, Tente novamente!</p>";
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    public function getInfo($id)
    {
        $this->query['select']->exeSelect("adms_users", '',"WHERE id=:id" , "id={$id}");

        $result = $this->query['select']->getResult();

        return $result[0];
    }

    public function searchUser($data)
    {
        $this->query['select']->exeSelect("adms_users", 'id,name,email,date_expiry',"WHERE name = :name OR email = :email" , "name={$data['search_name']}&email={$data['search_name']}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }


    public function getMenus()
    {
        $this->query['select']->exeSelect("cn_menus", '', 'ORDER BY orderby', '');

        return $this->query['select']->getResult();
    }

    private function vfEmailUser($email, $user, $id = null) :bool
    {
        $query = "WHERE email = :email AND id <> :id";

        if(!$id) $query = "WHERE email = :email";

        $this->query['select']->exeSelect("adms_users", 'email,user',$query , "email={$email}&user={$user}&id={$id}");

        $v = $this->query['select']->getResult();

        if($v){
            if($v[0]['user'] === $user){
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esse user já está cadastrado!</p>";

                return false;
            }

            if($v[0]['email'] === $email){
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esse email já está cadastrado!</p>";

                return false;
            }
        }else{
            return true;
        }
    }

}
