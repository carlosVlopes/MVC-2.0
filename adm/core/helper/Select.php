<?php

namespace Core\helper;

use PDO;

use PDOException;

class Select extends Conn
{
    private string $select;

    private array $values = [];

    private array|null $result;

    private object $query;

    private object $conn;


    public function getResult(): array|null
    {
        return $this->result;
    }

    public function exeSelect(string $table, string|null $values = null,string|null $terms = null, string|null $parseString = null): void // fazer selecionando com campos passados no array
    {
        if(!empty($parseString)){
            parse_str($parseString,$this->values);
        }

        if(!empty($values)){
            $this->select = "SELECT {$values} FROM {$table} {$terms}";
        }else{
            $this->select = "SELECT * FROM {$table} {$terms}";
        }

        $this->exeInstruction($values);

    }


    private function exeInstruction($values):void
    {
        $this->connection();

        try{
            $this->exeParameter();

            $this->query->execute();

            $this->result = $this->query->fetchAll();

        }catch(PDOException $err){
            $this->result = null;
        }
    }

    private function connection():void
    {
        $this->conn = $this->connectDb();

        $this->query = $this->conn->prepare($this->select);

        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function exeParameter():void
    {
        if($this->values){
            foreach ($this->values as $link => $value){
                if(($link == 'limit') or ($link == 'offset') or ($link == 'id')){
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
