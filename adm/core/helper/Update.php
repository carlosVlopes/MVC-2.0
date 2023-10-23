<?php

namespace Core\helper;

use PDO;

use PDOException;

class Update extends Conn
{
    private string $table;

    private string|null $terms;

    private array $data;

    private array $value = [];

    private bool $result;

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
            $this->result = false;
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

        $this->exeInstruction();
    }


}
