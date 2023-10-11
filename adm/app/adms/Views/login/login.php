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
            <form class="m-t" role="form" action="" id="form-login" class="form-login" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="user" placeholder="Usuario" required="" value="<?php (isset($this->data['form']['user'])) ? $this->data['form']['user'] : '' ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="" value="<?php (isset($this->data['form']['password'])) ? $this->data['form']['password'] : '' ?>">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="SendLogin" value="Acessar">Login</button>
            </form>
        </div>
    </div>