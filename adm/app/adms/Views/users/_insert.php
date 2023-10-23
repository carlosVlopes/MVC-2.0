<?php include 'app/adms/Views/include/head.php';?>
<?php include 'app/adms/Views/include/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Usuário cadastrado com sucesso!</h5>
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
                                    <h5>Cadastrar Usuário</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageReturn?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i> Voltar</a>
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
                                                    <input type="text" placeholder="Nome completo" class="form-control" name="name" id="name">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" placeholder="Melhor e-mail" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>User</label>
                                                    <input type="text" name="user" id="user" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Senha</label>
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Permissões: </label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_delete" id="delete" value="1"> Deletar</label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_edit" id="edit" value="1"> Editar</label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_add" id="add" value="1"> Adicionar</label><br>
                                                    <label> <input type="checkbox" class="i-checks" name="u_view" id="view" value="1"> Visualizar</label>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Menus permitidos:</label><br>
                                                    <?php foreach($menus as $menu): ?>
                                                        <label> <input type="checkbox" class="i-checks" name="m_<?=$menu['link']?>" id="<?=$menu['link']?>" value="1"> <?=$menu['title']?></label><br>
                                                    <?php endForeach ?>
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <span>Imagem: 300x300</span>
                                                    <input type="file" name="image"><br>
                                                    <span>Coloque a imagem só se voçe quiser mudar a image</span><br><br>
                                                </div>

                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="SendAddUser" value="Cadastrar"><strong>Cadastrar</strong></button>
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
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/user/addUser.js"></script>
    </body>
</html>
