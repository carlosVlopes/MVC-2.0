<?php include 'app/adms/Views/include/head.php';?>
<?php include 'app/adms/Views/include/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Usuário editado com sucesso!</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?=$this->pageReturn?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ibox-title">
                                    <h5>Editar Usuário</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageReturn?>" class="btn btn-primary btn-m">Listar</a>
                                        <a href="<?=$this->pageEditPass .'/'. $data['id']?>" class="btn btn-primary btn-m">Editar Senha</a>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                ?>
                                <div class="ibox-content">
                                    <span class="col-lg-7" id="msg"></span>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form role="form" method="POST" action="" id="form-add-user" enctype="multipart/form-data" class="form-adm">
                                                <div class="form-group col-lg-5">
                                                    <label>Nome</label>
                                                    <input type="text" placeholder="Nome completo" class="form-control" name="name" id="name" value="<?= $data['name'] ?>">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" placeholder="Melhor e-mail" class="form-control" value="<?= $data['email'] ?>">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>User</label>
                                                    <input type="text" name="user" id="user" class="form-control" value="<?= $data['user'] ?>">
                                                </div>
                                                <div class="form-group col-lg-5" id="data_1">
                                                    <label class="font-noraml">Data de Expiração</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_expiry" class="form-control datepicker" data-date-format="dd/mm/yyyy" value="<?= $data['date_expiry'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>Permissões: </label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_delete" id="delete" value="1" <?= (isset($userPermi['u_delete'])) ? 'checked' : ''?>> Deletar</label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_edit" id="edit" value="1" <?= (isset($userPermi['u_edit'])) ? 'checked' : ''?>> Editar</label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_add" id="add" value="1" <?= (isset($userPermi['u_add'])) ? 'checked' : ''?>> Adicionar</label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_view" id="view" value="1" <?= (isset($userPermi['u_view'])) ? 'checked' : ''?>> Visualizar</label>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Menus permitidos:</label><br>
                                                    <?php foreach($menus as $menu): ?>
                                                        <label> <input type="checkbox" class="i-checks" name="m_<?=$menu['link']?>" id="<?=$menu['link']?>" <?= (isset($menusActive['m_' . $menu['link']])) ? 'checked' : ''?> value="1"> <?=$menu['title']?></label><br>
                                                    <?php endForeach ?>
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <span>Imagem: 300x300</span>
                                                    <input type="file" name="image"><br>
                                                    <span>Coloque a imagem só se voçe quiser mudar a image</span><br><br>
                                                </div>

                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="SendEditUser" value="Editar"><strong>Editar</strong></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endIf?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="<?= URLADM ?>app/adms/assets/js/jquery.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/bootstrap.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>

        <script src="<?= URLADM ?>app/adms/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= URLADM ?>app/adms/assets/js/pages/user/editUser.js"></script>

    </body>
</html>
