<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>
<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Novo Usuário</span>
        </div>

        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <span id="msg"></span>

        <form method="POST" action="" id="form-new-user" class="form-login">
            <?php
                $name = "";
                if (isset($valorForm['name'])) {
                    $name = $valorForm['name'];
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
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="<?= $name ?>"><br><br>
            </div>

            <div class="row">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Digite o seu melhor e-mail" value="<?= $email ?>"><br><br>
            </div>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Digite a senha" value="<?= $password ?>"><br><br>
            </div>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="r_password" id="r_password" placeholder="Confirme a senha"><br><br>
            </div>

            <div class="row button">
                <input type="submit" name="SendNewUser" value="Cadastrar">
            </div>
            <div class="signup-link">
                <a href="<?= URLADM ?>">Clique aqui</a> para acessar
            </div>
        </form>
    </div>
</div>
