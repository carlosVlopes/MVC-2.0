<?php

namespace Core;

/**
 * Verificar se existe a classe
 * Carregar a CONTROLLER
 * @author Cesar <cesar@celke.com.br>
 */
class CarregarPgAdm
{
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;

    private string $controllerOriginal;

    private array $sessionPermi;

    private array $listPgPublic;
    private array $listPgPrivate;


    /**
     * Verificar se existe a classe
     * @param string $urlController Recebe da URL o nome da controller
     * @param string $urlMetodo Recebe da URL o método
     * @param string $urlParamentro Recebe da URL o parâmetro
     */

    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter, string $controllerOriginal): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
        $this->controllerOriginal = $controllerOriginal;

        $this->pgPublic();

        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            $this->loadClassSts();
        }
    }

    private function loadClassSts(): void
    {
        $this->classLoad = "\\App\\sts\\Controllers\\" . $this->urlController . 'Controller';

        if (class_exists($this->classLoad)) {
            $this->loadMetodo(true);
        } else {
            die("Erro - 003: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            /*$this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
            $this->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);*/
        }
    }

    /**
     * Verificar se existe o método e carregar a página
     *
     * @return void
     */
    private function loadMetodo($sts = false): void
    {
        ($sts) ? $model = '\\App\\sts\\Models\\' . $this->urlController . 'Model' : $model = '\\App\\adms\\Models\\' . $this->urlController . 'Model';

        if($this->urlController == "Logout"){

            unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image']);
            $_SESSION['msg'] = "<p class='alert-success'>Logout realizado com sucesso!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");

        }

        if(!class_exists($model)){
            die("Erro - 004: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }

        // classes de querys usadas no model
        $querys = ['select' => new \App\adms\Models\helper\AdmsSelect() , 'delete' => new \App\adms\Models\helper\AdmsDelete() , 'create' => new \App\adms\Models\helper\AdmsCreate(), 'update' => new \App\adms\Models\helper\AdmsUpdate()];

        $model = new $model($querys);

        $checkPermissions = new \App\adms\Models\helper\AdmsValPermissions();

        $sessionPermi = '';

        if($this->urlController != "Login") $sessionPermi = $checkPermissions->valPermissions($_SESSION['user_id']);

        $activeMenus = $checkPermissions->valPermissions($_SESSION['user_id'], true);

        $this->sessionPermi = array_merge($sessionPermi, $activeMenus);

        self::checkMenusPermi($querys);

        $classLoad = new $this->classLoad($model, $this->sessionPermi);

        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        } else {
            die("Erro - 004: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }


    }

    private function checkMenusPermi($querys)
    {

        $querys['select']->exeSelect("cn_menus", '', 'ORDER BY orderby', '');

        $menus = $querys['select']->getResult();

        foreach($menus as $menu){

            if(isset($menu['link']) == $this->controllerOriginal){

                echo '<pre>';
                print_r('asdasd');
                echo '</pre>'; exit;

            }

        }

    }

    /**
     * Verificar se a página é pública e carregar a mesma
     *
     * @return void
     */
    private function pgPublic(): void
    {
        $this->listPgPublic = ["Login", "Erro", "Logout", "NewUser", "RecoverPassword"];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController . 'Controller';
        } else {
            $this->pgPrivate();
        }
    }
    /**
     * Verificar se a página é privada e chamar o método para verificar se o usuário está logado
     *
     * @return void
     */
    private function pgPrivate():void
    {
        $this->listPgPrivate = ["Dashboard", "ListUsers", "ViewUser", "AddUser", "EditUser", "UserProfile", "ViewPageHome", "EditHomeTop", "EditHomePrem", "EditHomeServ", "ViewAbout", "EditAbout", "AddAbout", "EditContact", "ViewMessage"];
        if(in_array($this->urlController, $this->listPgPrivate)){
            $this->verifyLogin();
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não encontrada!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Verificar se o usuário está logado e carregar a página
     *
     * @return void
     */
    private function verifyLogin(): void
    {
        if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name']))  and (isset($_SESSION['user_email'])) ){
            $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController . 'Controller';
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Para acessar a página realize o login!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

}
