<?php

namespace App\adms\Models;

class ListUsersModel
{

    private array|null $resultBd = [];

    private bool $result;

    private int $page;

    private string|null $resultPg;

    private int $limitResult;


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

    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    public function list(int $page = null, int $qnt_records)
    {
        $this->page = (int) $page ? $page : 1;

        $this->limitResult = $qnt_records;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', 'adms_users');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $this->query['select']->exeSelect("adms_users", 'id,name,email,date_expiry',"LIMIT :limit OFFSET :offset" , "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        if($this->query['select']->getResult()){
            $this->resultBd = $this->query['select']->getResult();

            $this->result = true;
        }else{
            $this->result = false;
        }
    }

    public function searchUser($data)
    {
        $this->query['select']->exeSelect("adms_users", 'id,name,email,date_expiry',"WHERE name = :name OR email = :email" , "name={$data['search_name']}&email={$data['search_name']}");

        $this->result = false;

        if($this->query['select']->getResult()){
            $this->resultBd = $this->query['select']->getResult();

            $this->result = true;
        }
    }

}
