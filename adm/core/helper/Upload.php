<?php

namespace Core\helper;

use PDO;

class Upload
{
    private string $nameImage;

    private bool $result = true;

    protected $types = array("jpg", "jpeg", "gif", "png");

    public function nameImage(): string
    {
        return $this->nameImage;
    }

    public function getResult(): bool
    {
        return $this->result;
    }

    public function upload( array $image, int|string $id, string $paste): void
    {
        $file = $image; // defini file com as informacoes da image

        $ext = pathinfo($file["name"] , PATHINFO_EXTENSION); // pega o tipo da image(jpg,jpeg,png)

        if(array_search(strtolower($ext), $this->types) === false){
            $this->result = false;
        }else{
            $this->result = false; // retorna false para cancelar

            $this->nameImage = $this->constructUrl($id .'-'.time()).'.'.$ext; // form iamge recebe o nome do titulo mais o tipo da image(titulo.jpg)

            move_uploaded_file($file['tmp_name'], $paste . $this->nameImage); // guarda a image em uma pasta produtos

            $this->result = true;
        }

    }

    private function constructUrl(string $str, array $replace=[], string $delimiter='-') : string
    {
        if( !empty($replace) ) $str = str_replace((array)$replace, ' ', $str);

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}
