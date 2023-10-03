<?php

    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }
    $name = "";
    if (isset($valorForm['name'])) {
        $name = $valorForm['name'];
    }

    $user = "";
    if (isset($valorForm['user'])) {
        $user = $valorForm['user'];
    }

    $email = "";
    if (isset($valorForm['email'])) {
        $email = $valorForm['email'];
    }

    $password = "";
    if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
    }

?>



<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Cadastrar Usuário</span>
            <div class="top-list-right">
                <a href="<?= URLADM?>list-users/index" class="btn-info">Voltar</a>
            </div>
        </div>
        <span id="msg"></span>
        <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        <div class="content-adm">
            <form method="POST" action="" id="form-add-user" class="form-adm">
                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Nome</label>
                        <input type="text" name="name" id="name" class="input-adm" placeholder="Nome completo" value="<?= $name ?>">
                    </div>
                    <div class="column">
                        <label class="title-input">E-mail</label>
                        <input type="email" name="email" id="email" class="input-adm" placeholder="Melhor e-mail" value="<?= $email ?>">
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">User</label>
                        <input type="text" name="user" id="user" class="input-adm" value="<?= $user ?>">
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Senha</label>
                        <input type="password" name="password" id="password" class="input-adm" placeholder="Senha" value="<?= $password ?>">
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                    <span>Permissões:</span><br><br>
                        <label>Deletar</label>
                        <input type="checkbox" name="u_delete" id="delete" value="1"><br>
                        <label>Editar</label>
                        <input type="checkbox" name="u_edit" id="edit" value="1"><br>
                        <label>Adicionar</label>
                        <input type="checkbox" name="u_add" id="add" value="1"><br>
                        <label>Visualizar</label>
                        <input type="checkbox" name="u_view" id="view" value="1"><br>
                    </div>
                </div>
                <div class="row-input">
                    <div class="column">
                    <span>Permissões de Menus:</span><br><br>
                        <?php foreach($this->data['menusActive'] as $menu): ?>
                            <label><?=$menu['title']?></label>
                            <input type="checkbox" name="m_<?=$menu['link']?>" id="<?=$menu['link']?>" value="1"><br>
                        <?php endForeach ?>
                    </div>
                </div>
                <button type="submit" name="SendAddUser" class="btn-success" value="Cadastrar">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
