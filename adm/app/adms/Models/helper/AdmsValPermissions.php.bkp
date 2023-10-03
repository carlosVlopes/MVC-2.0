<?php

namespace App\adms\Models\helper;

class AdmsValPermissions
{
    private string $id;

    private bool $delete = false;

    private bool $edit = false;

    private bool $add = false;

    private bool $view = false;

    private bool $permi = false;

    function getResults()
    {
        $data = [
            'delete' => $this->delete,
            'edit' => $this->edit,
            'add' => $this->add,
            'view' => $this->view,
            'perm' => $this->permi
        ];

        return $data;
    }

    public function valPermissions($id): void
    {
        $this->id = $id;

        $select = new \App\adms\Models\helper\AdmsSelect();

        $select->exeSelect("adms_users", 'perm_delete,perm_edit,perm_add,perm_view,perm_addPermi',"WHERE id=:id" , "id={$this->id}");

        $permissions = $select->getResult();

        if($permissions[0]['perm_delete']){
            $this->delete = true;
        }

        if($permissions[0]['perm_edit']){
            $this->edit = true;
        }

        if($permissions[0]['perm_add']){
            $this->add = true;
        }

        if($permissions[0]['perm_view']){
            $this->view = true;
        }

        if($permissions[0]['perm_addPermi']){
            $this->permi = true;
        }
    }
}
