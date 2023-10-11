<?php

namespace App\adms\Models;

class ApiModel
{
    private array|null $data;
    private object $conn;
    private $result;

    public function __construct($query){

        $this->query = $query;

    }

    public function getUserId($id)
    {

        $this->query['select']->exeSelect('adms_users', '', "WHERE id = :id", "id={$id}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;

    }

    public function verifyToken($token)
    {

        $this->query['select']->exeSelect('adms_users', 'token_api', "WHERE token_api = :token_api", "token_api={$token}");

        $result = $this->query['select']->getResult();

        return ($result) ? true : false;

    }

    public function getUsers($limit = null, $offSet)
    {

        $this->query['select']->exeSelect("adms_users", '', 'LIMIT :limit OFFSET :offset', "limit={$limit}&offset={$offSet}");

        $result = $this->query['select']->getResult();

        return ($result > 0) ? $result : false;

    }
}
