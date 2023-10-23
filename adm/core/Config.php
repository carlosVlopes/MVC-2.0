<?php

namespace Core;

/**
 * Configurações básicas do site.
 *
 * @author Cesar <cesar@celke.com.br>
 */

abstract class Config
{
    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function configAdm(): void
    {
        define('URL', 'http://192.168.30.15/estudo/carlos/MVC-2.0/');
        define('URLADM', 'http://192.168.30.15/estudo/carlos/MVC-2.0/adm/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        define('CONTROLLERSITE', 'Home');

        define('HOST', '192.168.30.15');
        define('USER', 'carlos');
        define('PASS', 'Ac4rl0s??ss10n');
        define('DBNAME', 'carlos_teste');
        define('PORT', 3306);

        define('EMAILADM', 'cesar@celke.com.br');
    }
}
