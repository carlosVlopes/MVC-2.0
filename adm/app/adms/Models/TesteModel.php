<?php

namespace App\adms\Models;

class TesteModel
{
    private array|null $data;
    private object $conn;
    private $result;

    public function __construct($query){

        $this->query = $query;

    }

}
