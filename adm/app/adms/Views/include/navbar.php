<?php

    use Core\ConfigView;

    $menus = ConfigView::configMenus();

    $sidebarActive = '';

    if(isset($this->data['sidebarActive'])){
        $sidebarActive = $this->data['sidebarActive'];
    }

?>


<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img src="<?=URLADM?>app/adms/assets/img/logo/icon-d.png" class="img-circle" alt="Celke" class="logo">
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$_SESSION['user_name']?></strong>
                             </span> <span class="text-muted text-xs block">Opções <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= URLADM?>user-profile/index">Perfil</a></li>
                        <li><a href="<?= URLADM?>edit-user/index/<?=$_SESSION['user_id']?>">Configuração</a></li>
                        <li><a href="<?= URLADM?>user-token/index">Token API</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= URLADM?>logout/index">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <?php foreach($menus as $menu): ?>
                <li class="<?= ($sidebarActive === $menu['link']) ? 'active' : ''?>">
                    <a href="<?= URLADM . $menu['link']?>/index"><i class="fa <?=$menu['icon']?>"></i> <span class="nav-label"><?=$menu['title']?></span></a>
                </li>
            <?php endForeach ?>
        </ul>

    </div>
</nav>
<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.3/search_results.html">
                    <div class="form-group">
                        <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="login.html">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
    </div>