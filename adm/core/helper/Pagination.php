<?php

namespace Core\helper;


class Pagination extends Conn
{

    private $conn;

    private $page;

    private $limitResult;

    private $offSet;

    private $query;

    private $parseString;

    private $result;

    private $resultBd;

    private $totalPages;

    private $maxLinks = 2;

    private $link;

    private $var;

    private $table;

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

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function __construct(string $link = null, string $table = null, string|null $var = null)
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

    public function pagination(bool $pg = true)
    {
        $this->conn = $this->connectDb();

        $query = "SELECT COUNT(id) AS num_result FROM $this->table";

        $result = $this->conn->prepare($query);

        $result->execute();

        $this->resultBd = $result->fetchAll();

        if($this->resultBd[0]['num_result'] == 0) return false;

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
