<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

//Criptografar a senha
//echo password_hash("123456a", PASSWORD_DEFAULT);
?>

<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Área Restrita</span>
        </div>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <span id="msg"></span>

        <form method="POST" action="" id="form-login" class="form-login">
            <?php
                $user = "";
                if (isset($valorForm['user'])) {
                    $user = $valorForm['user'];
                }
                $password = "";
                if (isset($valorForm['password'])) {
                    $password = $valorForm['password'];
                }
            ?>
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?= $user ?>"><br><br>
            </div>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Digite a senha" value="<?= $password ?>"><br><br>
            </div>
            <div class="row button">
                <input type="submit" name="SendLogin" value="Acessar">
            </div>

            <div class="signup-link">
                <a href="<?= URLADM ?>new-user/index">Cadastrar</a>
            </div>
        </form>
    </div>
</div>