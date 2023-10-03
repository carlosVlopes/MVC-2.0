
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Senha</span>
            <div class="top-list-right">
                <a href="<?= URLADM ?>edit-user/index/<?=$this->data['id']?>" class="btn-info">Voltar</a>
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
            <form method="POST" action="" id="form-edit-pass" class="form-adm">
                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Senha</label>
                        <input type="password" name="password" id="password" placeholder="Digite a senha" class="input-adm"><br>
                    </div>
                </div>
                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Confirme a senha</label>
                        <input type="password" name="co_password" id="co_password" class="input-adm" placeholder="Confirme a senha">
                    </div>
                </div>
                <button type="submit" name="SendEditPass" value="Editar" class="btn-success">Editar</button>
            </form>
        </div>
    </div>
</div>