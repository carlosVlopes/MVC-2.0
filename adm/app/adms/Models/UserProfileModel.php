<?php

namespace App\adms\Models;

class UserProfileModel
{

    private array|null $resultBd;

    private bool $result;

    private int $id;

    public function __construct($query){

        $this->query = $query;

    }

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function profile(int $id)
    {
        $this->id = $id;

        $this->query['select']->exeSelect("adms_users", '',"WHERE id=:id LIMIT 1" , "id={$id}");

        $v = $this->query['select']->getResult();

        $this->result = false;

        if($this->query['select']->getResult()){
            $this->resultBd = $this->query['select']->getResult();

            $this->result = true;
        }
    }

}
