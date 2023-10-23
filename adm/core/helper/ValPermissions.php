<?php

namespace Core\helper;

class ValPermissions
{

    public function valPermissions($id, $getMenus = false)
    {
        $select = new Select();

        $camp = 'permissions_users';

        if($getMenus) $camp = 'permissions_menus';

        $select->exeSelect("adms_users", $camp, "WHERE id=:id" , "id={$id}");

        $permissions_json = $select->getResult();

        $permissions = json_decode($permissions_json[0][$camp]);

        if(gettype($permissions) == 'object'){

            return get_object_vars($permissions);

        }

    }
}
