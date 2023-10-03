<?php

namespace App\adms\Models\helper;

class AdmsValEmail
{
    private string $email;
    private bool $result;

    function getResult()
    {
        return $this->result;
    }

    public function valEmail(string $email): void
    {
        $this->email = $email;

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Email inválido!</p>";
            $this->result = false;
        }
    }
}
