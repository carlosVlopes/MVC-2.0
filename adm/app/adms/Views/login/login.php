<?php include 'app/adms/Views/include/head_login.php'; ?>
<body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>

                    <h1 class="logo-name">AV+</h1>

                </div>
                <h3>Bem vindo ao AV+</h3>

                <p>Login do painel administrativo.</p>
                <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                ?>
                <form class="m-t form-login" role="form" action="" id="form-login" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="user" id="user" placeholder="Usuario" value="<?php (isset($this->data['form']['user'])) ? $this->data['form']['user'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php (isset($this->data['form']['password'])) ? $this->data['form']['password'] : '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" name="SendLogin" value="Acessar">Login</button>
                </form>
            </div>
        </div>
        <script src="<?= URLADM ?>app/adms/assets/js/custom_login.js"></script>
        <script src="<?=URLADM?>app/adms/assets/js/jquery-2.1.1.js"></script>
        <script src="<?=URLADM?>app/adms/assets/js/bootstrap.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>
        <script src="<?=URLADM?>app/adms/assets/js/pages/login.js"></script>
    </body>
</html>