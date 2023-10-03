<?php

namespace App\adms\Models;

class LoginModel
{
    private array|null $data;
    private $resultBd;
    private $result;

    public function __construct($query){

        $this->query = $query;

    }

    function getResult(){
        return $this->result;
    }

    function getResultBd(){
        return $this->resultBd;
    }

    public function login(array $data = null)
    {
        $this->data = $data;

        $this->query['select']->exeSelect("adms_users", '',"WHERE user = :user OR email =:email LIMIT :limit" , "user={$this->data['user']}&email={$this->data['user']}&limit=1");

        $this->resultBd =  $this->query['select']->getResult();

        if($this->resultBd){
            if($this->resultBd[0]['date_expiry'] < date("Y-m-d")){
                $_SESSION['msg'] = "<p class='alert-danger'>Usuário esta expirado, entre em contato com o administrador!</p>";
                $this->result = false;
            }else{
                $this->valPassword();
            }
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }
    }

    private function valPassword()
    {
        if(password_verify($this->data['password'], $this->resultBd[0]['password'])){
            $_SESSION['user_id'] = $this->resultBd[0]['id'];

            $_SESSION['user_name'] = $this->resultBd[0]['name'];

            $_SESSION['user_nickname'] = $this->resultBd[0]['nickname'];

            $_SESSION['user_email'] = $this->resultBd[0]['email'];

            $_SESSION['user_image'] = $this->resultBd[0]['image'];

            $this->result = true;

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário ou a senha incorreta!</p>";

            $this->result = false;
        }
    }


}