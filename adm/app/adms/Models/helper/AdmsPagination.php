<?php

namespace App\adms\Models\helper;


class AdmsPagination extends AdmsConn
{

    private $conn;

    private int $page;

    private int $limitResult;

    private int $offSet;

    private string $query;

    private string|null $parseString;

    private string|null $result;

    private array $resultBd;

    private int $totalPages;

    private int $maxLinks = 2;

    private string $link;

    private string|null $var;

    private string $table;

    public function getOffset(): int
    {
        return $this->offSet;
    }

    public function getResult(): string|null
    {
        return $this->result;
    }

    public function getResultBd(): array
    {
        return $this->resultBd;
    }

    public function __construct(string $link, string $table, string|null $var = null)
    {
        $this->link = $link;

        $this->var = $var;

        $this->table = $table;
    }

    public function condition(int $page, int $limitResult):void
    {
        $this->page = (int) $page ? $page : 1;

        $this->limitResult = (int) $limitResult;

        $this->offSet = (int) ($this->page * $this->limitResult) - $this->limitResult;
    }

    public function pagination(bool $pg = true):void
    {
        $this->conn = $this->connectDb();

        $query = "SELECT COUNT(id) AS num_result FROM $this->table";

        $result = $this->conn->prepare($query);

        $result->execute();

        $this->resultBd = $result->fetchAll();

        if($pg){
            $this->pageInstruction();
        }

    }

    public function pageInstruction():void
    {
        $this->totalPages = (int) ceil($this->resultBd[0]['num_result'] / $this->limitResult);

        if($this->totalPages >= $this->page){
            $this->layoutPagination();
        }else{
            header("Location: {$this->link}");
        }

    }

    private function layoutPagination():void
    {
        $this->result = "<div class='content-pagination'>";

        $this->result .= "<div class='pagination'>";

        $this->result .= "<a href='{$this->link}{$this->var}'>Primeira</a>";

        for($beforePg = $this->page - $this->maxLinks; $beforePg <= $this->page -1; $beforePg++){
            if($beforePg >= 1){
                $this->result .= "<a href='{$this->link}/$beforePg{$this->var}'>$beforePg</a>";
            }
        }

        $this->result .= "<a href='#' class='active'>{$this->page}</a>";

        for($afterPg = $this->page + 1; $afterPg <= $this->page + $this->maxLinks; $afterPg++){
            if($afterPg <= $this->totalPages){
                $this->result .= "<a href='{$this->link}/$afterPg{$this->var}'>$afterPg</a>";
            }
        }

        $this->result .= "<a href='{$this->link}/{$this->totalPages}{$this->var}'>Ultima</a>";

        $this->result .= "</div>";

        $this->result .= "</div>";
    }


}