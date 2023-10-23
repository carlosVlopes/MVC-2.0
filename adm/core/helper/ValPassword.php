<?php

namespace Core\helper;

class ValPassword
{
    private string $password;
    private bool $result;

    function getResult()
    {
        return $this->result;
    }

    public function valPassword(string $password): void
    {
        $this->password = $password;

        if (stristr($this->password, "'")){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Caracter ( ' ) nao pode ser utilizado na senha!";

            $this->result = false;
        }else{
            if (stristr($this->password, " ")){
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A senha nao pode conter espaço em branco!";

                $this->result = false;
            }else{
                $this->valExtensPassword();
            }
        }
    }

    private function valExtensPassword(): void
    {

        if(strlen($this->password) < 6){
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: A senha deve conter no minimo 6 caracteres!";

            $this->result = false;
        }else{
            $this->result = true;
        }
    }

}
