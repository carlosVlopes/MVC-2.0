<?php

namespace App\adms\Models;

class UserTokenModel
{

    private array|null $resultBd;

    private bool $result;

    private int $id;

    public function __construct($query){

        $this->query = $query;

    }

    public function getToken($id)
    {

        $this->query['select']->exeSelect("adms_users", 'token_api','WHERE id = :id', "id={$id}");

        $result = $this->query['select']->getResult();

        return $result[0];

    }

    public function generateToken($id)
    {
        $str = $id . self::generateRandomString();

        $hash['token_api'] = md5($str);

        $this->query['update']->exeUpdate('adms_users', $hash, "WHERE id = :id", "id={$id}");

        $result = $this->query['update']->getResult();

        return [
            'updated' => $result,
            'token' => $hash['token_api']
        ];

    }

    private function generateRandomString($size = 7)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";

        $randomString = '';

        for($i = 0; $i < $size; $i = $i+1){

            $randomString .= $chars[mt_rand(0,60)];

        }

        return $randomString;
    }


}
