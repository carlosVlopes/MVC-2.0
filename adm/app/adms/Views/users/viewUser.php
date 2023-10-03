<?php

    $values = false;

    extract($this->data['user'][0]);

    $image = ($image !='') ? 'app/adms/Views/images/users/' . $image : '';

    if($this->data){
        $values = true;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="wrapper">
        <div class="row">
            <div class="top-list">
                <span class="title-content">Visualizar</span>
                <div class="top-list-right">
                    <a href="<?= URLADM?>list-users/index" class="btn-info">Listar</a>
                    <?php if(isset($this->data['u_edit'])): ?>
                        <a href="<?= URLADM?>edit-user/index/<?=$id?>" class="btn-warning">Editar</a>
                    <?php endif?>
                    <?php if(isset($this->data['u_delete'])): ?>
                        <a href="<?= URLADM?>edit-user/delete/<?=$id?>" class="btn-danger">Deletar</a>
                    <?php endif?>
                </div>
            </div>
            <?php if($values): ?>
                <div class="content-adm">
                    <div class="view-det-adm">
                        <span class="view-adm-title">Foto: </span>
                        <span class="view-adm-info"><img src="<?= ($image) ? 'http://192.168.30.15/estudo/carlos/MVC/adm/' . $image : ''?>" style="width:90px;"></span>
                    </div>

                    <div class="view-det-adm">
                        <span class="view-adm-title">Nome: </span>
                        <span class="view-adm-info"><?=$name?></span>
                    </div>

                    <div class="view-det-adm">
                        <span class="view-adm-title">User: </span>
                        <span class="view-adm-info"><?=$user?></span>
                    </div>

                    <div class="view-det-adm">
                        <span class="view-adm-title">E-mail: </span>
                        <span class="view-adm-info"><?=$email?></span>
                    </div>

                    <div class="view-det-adm">
                        <span class="view-adm-title">Data de Criação: </span>
                        <span class="view-adm-info"><?=date('d/m/Y H:i:s', strtotime($created))?></span>
                    </div>

                    <?php if($modified): ?>
                        <div class="view-det-adm">
                            <span class="view-adm-title">Data de Edição: </span>
                            <span class="view-adm-info"><?=date('d/m/Y H:i:s', strtotime($modified))?></span>
                        </div>
                    <?php endif ?>


                    <div class="view-det-adm">
                        <span class="view-adm-title">Permissoes: </span>
                        <?php if(isset($this->data['user']['permissions']['u_delete'])): ?>
                            <span>Deletar</span>
                        <?php endif?>
                        <?php if(isset($this->data['user']['permissions']['u_edit'])): ?>
                            <span>| Editar</span>
                        <?php endif?>
                        <?php if(isset($this->data['user']['permissions']['u_add'])): ?>
                            <span>| Cadastrar</span>
                        <?php endif?>
                        <?php if(isset($this->data['user']['permissions']['u_view'])): ?>
                            <span>| Visualizar</span>
                        <?php endif?>
                    </div>
                </div>
            <?php else: ?>

                <h1>Nenhum Usuario encontrado!</h1>

            <?php endif ?>
        </div>
    </div>
</body>
</html>