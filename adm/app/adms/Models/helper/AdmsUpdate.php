<?php

namespace App\adms\Models\helper;

use PDO;

use PDOException;

class AdmsUpdate extends AdmsConn
{
    private string $table;

    private string|null $terms;

    private array $data;

    private array $value = [];

    private string $result;

    private object $update;

    private string $query;

    private object $conn;


    public function getResult(): string
    {
        return $this->result;
    }

    public function exeUpdate(string $table, array $data, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;

        $this->data = $data;

        $this->terms = $terms;

        parse_str($parseString, $this->value);

        $this->exeReplaceValues();

    }


    private function exeInstruction():void
    {
        $this->connection();

        try{
            $this->update->execute(array_merge($this->data, $this->value));

            $this->result = true;
        }catch(PDOException $err){
            $this->result = null;
        }
    }

    private function connection():void
    {
        $this->conn = $this->connectDb();

        $this->update = $this->conn->prepare($this->query);
    }

    private function exeReplaceValues():void
    {
        foreach ($this->data as $key => $value){
            $values[] = $key . "=:" . $key;
        }

        $values = implode(", ", $values);

        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";

        // var_dump($this->query);
        $this->exeInstruction();
    }


}
