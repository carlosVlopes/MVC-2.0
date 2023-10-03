<?php

namespace App\adms\Models;

class DashboardModel
{
    private array|null $data;

    private array $result;

    public function __construct($query){

        $this->query = $query;

    }

    function getResult()
    {
        return $this->result;
    }

    public function getUsers()
    {
        $getUsers = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "adms_users");

        $getUsers->pagination(false);

        $this->result = $getUsers->getResultBd();

    }
}
