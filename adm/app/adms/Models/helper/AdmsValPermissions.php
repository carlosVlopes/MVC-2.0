<?php

namespace App\adms\Models\helper;

class AdmsValPermissions
{


    public function valPermissions($id, $getMenus = false)
    {
        $select = new \App\adms\Models\helper\AdmsSelect();

        $camp = 'permissions_users';

        if($getMenus) $camp = 'permissions_menus';

        $select->exeSelect("adms_users", $camp, "WHERE id=:id" , "id={$id}");

        $permissions_json = $select->getResult();

        $permissions = json_decode($permissions_json[0][$camp]);

        return get_object_vars($permissions);

    }
}
