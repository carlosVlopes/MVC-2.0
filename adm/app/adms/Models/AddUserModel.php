<?php

namespace App\adms\Models;

class AddUserModel
{
    private array|null $data;
    private $result;


    public function __construct($query){

        $this->query = $query;

    }

    function getResult()
    {
        return $this->result;
    }

    public function create(array $data = null)
    {
        $this->data = $data;

        $permissions_menus = '';

        $permissions_users = '';

        foreach(array_keys($this->data) as $key => $value){

            if(strpos($value, 'u_') === 0){

                unset($this->data[$value]);

                $permissions_users .= '"' . $value . '":"' . "Ativo" . '",';

            }

            if(strpos($value, 'm_') === 0){

                unset($this->data[$value]);

                $permissions_menus .= '"' . $value . '":"' . "Ativo" . '",';

            }
        }

        $this->data['permissions_users'] = self::constructJson($permissions_users);

        $this->data['permissions_menus'] = self::constructJson($permissions_menus);

        $valField = new \App\adms\Models\helper\AdmsValField(); // pega o helper para a verificacaop do campos via php

        $valField->valField($this->data); // chama o metodo do objeto

        $email = new \App\adms\Models\helper\AdmsValEmail();

        $email->valEmail($this->data['email']);

        $senha = new \App\adms\Models\helper\AdmsValPassword();

        $senha->valPassword($this->data['password']);

        if($email->getResult() and $senha->getResult()){

            if($this->vfEmailUser($this->data['email'], $this->data['user'])){

                if($valField->getResult()){

                    $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

                    $this->data['created'] = date("Y-m-d H:i:s");

                    $this->data['date_expiry'] = date("Y-m-d", strtotime('+ 1 year'));

                    $this->query['create']->exeCreate("adms_users", $this->data);

                    if($this->query['create']->getResult()){
                        $_SESSION['msg'] = "<p class='alert-success'>Usuário cadastrado com sucesso!</p>";
                        $this->result = true;
                    }else{
                        $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não cadastrado com sucesso!</p>";
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

    private function vfEmailUser($email, $user) :bool
    {
        $this->query['select']->exeSelect("adms_users", 'email,user',"WHERE email = :email OR user =:user" , "email={$email}&user={$user}");

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

    public function getMenus()
    {

        $this->query['select']->exeSelect("cn_menus", '', 'ORDER BY orderby', '');

        $menus = $this->query['select']->getResult();

        return $menus;

    }

    private function constructJson($string)
    {

        $string = rtrim($string, ',');

        $string = substr_replace($string, '{', 0,0);

        $qt = strlen($string);

        return substr_replace($string, '}', $qt, 0);

    }
}
