<?php

    use Core\ConfigView;

    $menus = ConfigView::configMenus();

    $sidebarActive = '';

    if(isset($this->data['sidebarActive'])){
        $sidebarActive = $this->data['sidebarActive'];
    }

?>

<div class="content">
        <!-- Inicio da Sidebar -->
        <div class="sidebar">

            <?php foreach($menus as $menu): ?>
                <a href="<?= URLADM . $menu['link']?>/index" class="sidebar-nav <?= ($sidebarActive === $menu['link']) ? 'active' : ''?>"><i class="icon fa-solid <?=$menu['icon']?>"></i><span><?=$menu['title']?></span></a>
            <?php endForeach ?>
            <a href="<?= URLADM?>logout/index" class="sidebar-nav"><i class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span></a>

        </div>
        <!-- Fim da Sidebar -->
