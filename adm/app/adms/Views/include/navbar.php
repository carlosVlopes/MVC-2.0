<!-- Inicio Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="bars">
                <i class="fa-solid fa-bars"></i>
            </div>
            <img src="<?=URLADM?>app/adms/assets/images/logo/v.jpg" alt="Celke" class="logo">
        </div>

        <div class="navbar-content">
            <!-- <div class="notification">
                <i class="fa-solid fa-bell"></i>
                <span class="number">7</span>
                <div class="dropdown-menu">
                    <div class="dropdown-content">
                        <li>
                            <?php if($_SESSION['user_image']): ?>
                                <img src="<?= 'http://192.168.30.15/estudo/carlos/MVC/adm/app/adms/Views/images/users/' . $_SESSION['user_image'] ?>" width="40"><br>
                            <?php endif ?>
                            <div class="text">
                                Fusce ut leo pretium, luctus elit id, vulputate lectus.
                            </div>
                        </li>
                        <li>
                            <img src="images/users/user.jpg" alt="Usuario" width="40">
                            <div class="text">
                                Fusce ut leo pretium, luctus elit id, vulputate lectus.
                            </div>
                        </li>
                    </div>
                </div>
            </div> -->

            <div class="avatar">
                <img src="<?= URL . 'adm/app/adms/Views/images/users/' . $_SESSION['user_image'] ?>" width="40"><br>
                <div class="dropdown-menu setting">
                    <a href="<?= URLADM?>user-profile/index" class="item">
                        <span class="fa-solid fa-user"></span> Perfil
                    </a>
                    <a href="<?= URLADM?>edit-user/index/<?=$_SESSION['user_id']?>" class="item">
                        <span class="fa-solid fa-gear"></span> Configuração
                    </a>
                    <a href="<?= URLADM?>logout/index" class="item">
                        <span class="fa-solid fa-arrow-right-from-bracket"></span> Sair
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Fim Navbar -->