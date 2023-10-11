<?php

namespace App\adms\Controllers;

use \App\adms\Models\helper\AdmsPagination;
/**
 * Controller da página novo usuário
 * @author Cesar <cesar@celke.com.br>
 */
class ApiController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    public function __construct($model){

        header('Content-Type: application/json; charset=utf-8');

        $this->model = $model;

    }

    private static function setError($msg)
    {
        return [
            'error' => $msg
        ];

    }

    public function user($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if(!isset($_GET['token'])) return self::setError('Para acessar essa api voçê precisa passar o token de autorização!');

        if(!$this->model->verifyToken($_GET['token'])) return self::setError('Token nao encontrado!');

        if($method == 'GET'){

            if(!$id){

                return [
                    'usuarios' => $this->getUsers(),
                    'pagination' => $this->getUsers(true)
                ];

            }

            $result = $this->model->getUserId($id);

            return ($result) ? $result : self::setError('Nenhum usuario encontrado!');

        }

    }

    public function getUsers($pag = false)
    {
        $numPage = (isset($_GET['page'])) ? $_GET['page'] : 1;

        $limitResult = 2;

        $pagination = new AdmsPagination(URL . '/admin/testimonies', 'adms_users');

        $pagination->condition($numPage, $limitResult);

        $pagination->pagination();

        if($pag){

            return [

                'paginaAtual' => (int)$numPage,
                'quantidadePaginas' => $pagination->getTotalPages()

            ];

        }

        $data = $this->model->getUsers($limitResult, $pagination->getOffset());

        $itens = [];

        foreach($data as $item){

            $itens[] = ['id' => (int)$item['id'],'name' => $item['name'], 'user' => $item['user'], 'password' => $item['password'], 'email' => $item['email'], 'image' => $item['image'], 'created' => $item['created'], 'modified' => $item['modified'], 'permissions_users' => $item['permissions_users'], 'permissions_menus' => $item['permissions_menus'], 'date_expiry' => $item['date_expiry'], 'token_api' => $item['token_api']];

        }

        return $itens;

    }

}
