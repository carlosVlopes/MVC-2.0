<?php

namespace Core;

use \App\adms\Models\helper\AdmsSlug;

/**
 * Recebe a URL e manipula
 * Carregar a CONTROLLER
 * @author Cesar <cesar@celke.com.br>
 * 
 * https://www.php-fig.org/psr/
 * https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md
 * https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md
 */
class ConfigController extends Config
{

    /** @var string $url Recebe a URL do .htaccess */
    private string $url;
    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;
    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;
    /** @var string $urlSlugController Recebe o controller tratada */
    private string $urlSlugController;
    /** @var string $urlSlugMetodo Recebe o metodo tratado */
    private string $urlSlugMetodo;

    private string $controllerOriginal;

    /**
     * Recebe a URL do .htaccess
     * Validar a URL
     */
    public function __construct()
    {
        $slug = new AdmsSlug();

        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            //var_dump($this->url);
            $this->clearUrl();
            $this->urlArray = explode("/", $this->url);

            $this->controllerOriginal = $this->urlArray[0];

            //var_dump($this->urlArray);

            if (isset($this->urlArray[0])) {
                $this->urlController = $slug->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $slug->slugController(CONTROLLER);
            }

            if (isset($this->urlArray[1])) {
                $this->urlMetodo = $slug->slugMetodo($this->urlArray[1]);
            } else {
                $this->urlMetodo = $slug->slugMetodo(METODO);
            }

            if (isset($this->urlArray[2])) {
                $this->urlParameter = $this->urlArray[2];
            } else {
                $this->urlParameter = "";
            }
        } else {
            $this->urlController = $slug->slugController(CONTROLLERERRO);
            $this->urlMetodo = $slug->slugMetodo(METODO);
            $this->urlParameter = "";
        }
        // echo "Controller: {$this->urlController} <br>";
        // echo "Metodo: {$this->urlMetodo} <br>";
        // echo "Paramentro: {$this->urlParameter} <br>";
    }

    /**
     * Método privado não pode ser instanciado fora da classe
     * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URL e retirar os caracteres especiais
     *
     * @return void
     */
    private function clearUrl(): void
    {
        //Eliminar as tag
        $this->url = strip_tags($this->url);
        //Eliminar espaços em branco
        $this->url = trim($this->url);
        //Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
    }

    /**
     * Carregar as Controllers
     * Instanciar as classes da controller e carregar o método 
     *
     * @return void
     */
    public function loadPage(): void
    {
        //echo "Carregar Pagina: {$this->urlController}<br>";

        //$this->urlController = ucwords($this->urlController);
        //echo "Carregar Pagina corrigida: {$this->urlController}<br>";

        //$this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
        //$classePage = new $this->classLoad();
        //$classePage->{$this->urlMetodo}();

        $loadPgAdm = new \Core\CarregarPgAdm();
        $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter, $this->controllerOriginal);
    }
}
