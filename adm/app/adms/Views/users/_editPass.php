<?php include 'app/adms/Views/include/head.php';?>
<?php include 'app/adms/Views/include/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Senha editada com sucesso!</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?=$this->pageEdit . '/' . $data['id']?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ibox-title">
                                    <h5>Editar Senha</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageEdit . '/' . $data['id']?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i> Voltar</a>
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
                                            <form role="form" method="POST" action="" id="form-edit-pass" class="form-adm">
                                                <div class="form-group col-lg-12">
                                                    <label>Senha</label>
                                                    <input type="password" placeholder="Digite a senha" class="form-control" name="password" id="password">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Confirmar Senha</label>
                                                    <input type="password" placeholder="Confirme a senha" class="form-control" name="co_password" id="co_password">
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="SendEditPass" value="Editar"><strong>Editar</strong></button>
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
        <script src="<?= URLADM ?>app/adms/assets/js/pages/user/editPass.js"></script>
    </body>
</html>
