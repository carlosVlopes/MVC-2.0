<?php

namespace App\adms\Models;

class EditUserModel
{
    private array|null $data;

    private bool $result;

    private bool $resultPass;

    private int $id;

    public function __construct($query){

        $this->query = $query;

    }

    function getResult()
    {
        return $this->result;
    }

    function getResultPass()
    {
        return $this->resultPass;
    }

    public function create(array $data = null, $id)
    {
        $this->data = $data;

        $this->data = $this->query['constructJson']->construct($this->data);

        $this->id = $id;

        if(isset($this->data["image"])){
            $image = $this->data["image"];
        }

        unset($this->data["image"]);

        $erro = true;

        if(isset($image)){

            $upload = new \App\adms\Models\helper\AdmsUpload();

            $upload->upload($image, $id, "app/adms/Views/images/users/");

            if($upload->getResult()){
                $this->data['image'] = $upload->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";
                $erro = false;
                $this->result = false;
            }
        }

        if($erro){

            if(isset($image)){
                $noVal['image'] = $this->data['image'];
            }

            unset($this->data['image']);

            $valField = new \App\adms\Models\helper\AdmsValField(); // pega o helper para a verificacaop do campos via php

            $valField->valField($this->data); // chama o metodo do objeto

            $email = new \App\adms\Models\helper\AdmsValEmail();

            $email->valEmail($this->data['email']);

            if($email->getResult()){

                if($this->vfEmailUser($this->data['email'], $this->data['user'])){

                    if($valField->getResult()){

                        if(isset($image)){
                            $this->data['image'] = $noVal['image'];
                        }

                        $this->data['modified'] = date("Y-m-d H:i:s");

                        $this->data['date_expiry'] = implode("-",array_reverse(explode("/",$this->data['date_expiry'])));

                        $this->query['update']->exeUpdate("adms_users", $this->data , "WHERE id=:id" , "id={$this->id}");

                        if($this->query['update']->getResult()){

                            if($this->id == $_SESSION['user_id'] && isset($image)) $_SESSION['user_image'] = $noVal['image'];

                            $_SESSION['msg'] = "<p class='alert-success'>Usuário editado com sucesso!</p>";
                            $this->result = true;
                        }else{
                            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não editado, Tente novamente!</p>";
                            $this->result = false;
                        }

                    }else{
                        $this->result = false;
                    }
                }else{
                    $this->result = false;
                }

            }

        }


    }

    public function editPassword($password, $id)
    {
        if($password['password'] !== $password['co_password']){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro:Confirmar Senha deve ser igual a Senha!</p>";
            $this->resultPass = false;
        }else{
            unset($password['co_password']);

            $senha = new \App\adms\Models\helper\AdmsValPassword();

            $senha->valPassword($password['password']);

            if($senha->getResult()){
                $password['password'] = password_hash($password['password'], PASSWORD_DEFAULT);

               $this->query['update']->exeUpdate("adms_users", $password , "WHERE id=:id" , "id={$id}");

                if($this->query['update']->getResult()){
                    $_SESSION['msg'] = "<p class='alert-success'>Senha editada com sucesso!</p>";
                    $this->resultPass = true;
                }else{
                    $_SESSION['msg'] = "<p class='alert-danger'>Erro: Senha nao foi editada, Tente novamente!</p>";
                    $this->resultPass = false;
                }
            }else{
                $this->resultPass = false;
            }
        }
    }

    public function delete(int $id)
    {
        $this->query['delete']->delete("adms_users", "WHERE id=:id" , "id={$id}");

        if($this->query['delete']->getResult()){
            $_SESSION['msg'] = "<p class='alert-success'>Usuario deletado com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuario nao deletado, Tente novamente!</p>";
            $this->result = false;
        }
    }

    public function getInfo(int $id)
    {
        $this->query['select']->exeSelect("adms_users", '',"WHERE id=:id" , "id={$id}");

        $te = $this->query['select']->getResult();

        return $te[0];
    }

    private function vfEmailUser($email, $user) :bool
    {
        $this->query['select']->exeSelect("adms_users", 'id,email,user',"WHERE email = :email OR user =:user" , "email={$email}&user={$user}");

        $v = $this->query['select']->getResult();

        if($v){

            if($v[0]['id'] == $this->id)
            {
                return true;
            }else{

                if($v[0]['user'] === $user){
                    $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esse user já está cadastrado!</p>";

                    return false;
                }

                if($v[0]['email'] === $email){
                    $_SESSION['msg'] = "<p class='alert-danger'>Erro: Esse email já está cadastrado!</p>";

                    return false;
                }
            }
        }else{
            return true;
        }

    }

    public function getMenus()
    {

        $this->query['select']->exeSelect("cn_menus", '', 'ORDER BY orderby', '');

        $menus = $this->query['select']->getResult();

        return $menus;

    }
}
