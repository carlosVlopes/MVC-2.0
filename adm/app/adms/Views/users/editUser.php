<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Usuário</span>
            <div class="top-list-right">
                <a href="<?= URLADM ?>list-users/index" class="btn-info">Listar</a>
                <a href="<?= URLADM ?>edit-user/editPass/<?=$this->data['id']?>" class="btn-warning">Editar Senha</a>
            </div>
        </div>
        <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        <span id="msg"></span>
        <div class="content-adm">
            <form method="POST" action="" id="form-add-user" enctype="multipart/form-data" class="form-adm">
                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Nome</label>
                        <input type="text" name="name" id="name" class="input-adm" value="<?= $this->data['name'] ?>">
                    </div>

                    <div class="column">
                        <label class="title-input">E-mail</label>
                        <input type="email" name="email" id="email" class="input-adm" value="<?= $this->data['email'] ?>">
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">User</label>
                        <input type="text" name="user" id="user" class="input-adm"  value="<?= $this->data['user'] ?>">
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Data de Expiração</label>
                        <input type="text" name="date_expiry" id="date_expiry" class="input-adm"  value="<?= date("d/m/Y", strtotime($this->data['date_expiry']))?>">
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                    <span>Permissões:</span><br><br>
                        <label>Deletar</label>
                        <input type="checkbox" name="u_delete" id="delete" value="1" <?= (isset($this->data['userPermi']['u_delete'])) ? 'checked' : ''?>><br>
                        <label>Editar</label>
                        <input type="checkbox" name="u_edit" id="edit" value="1" <?= (isset($this->data['userPermi']['u_edit'])) ? 'checked' : ''?>><br>
                        <label>Adicionar</label>
                        <input type="checkbox" name="u_add" id="add" value="1" <?= (isset($this->data['userPermi']['u_add'])) ? 'checked' : ''?>><br>
                        <label>Visualizar</label>
                        <input type="checkbox" name="u_view" id="view" value="1" <?= (isset($this->data['userPermi']['u_view'])) ? 'checked' : ''?>><br>
                    </div>
                </div>
                <div class="row-input">
                    <div class="column">
                    <span>Permissões de Menus:</span><br><br>
                        <?php foreach($this->data['menus'] as $menu): ?>
                            <label><?=$menu['title']?></label>
                            <input type="checkbox" name="m_<?=$menu['link']?>" id="<?=$menu['link']?>" <?= (isset($this->data['menusActive']['m_' . $menu['link']])) ? 'checked' : ''?> value="1"><br>
                        <?php endForeach ?>
                    </div>
                </div>
                <span>Imagem: 300x300</span>
                <input type="file" name="image"><br>
                <span>Coloque a imagem só se voçe quiser mudar a image</span><br><br>

                <button type="submit" name="SendEditUser" value="Editar" class="btn-success">Salvar</button>
            </form>
        </div>
    </div>
</div>