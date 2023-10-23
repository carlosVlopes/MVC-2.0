<?php include 'app/adms/Views/include/head.php';?>
<?php include 'app/adms/Views/include/navbar.php';?>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="ibox float-e-margins">
				            <div class="ibox-title">
				                <h5>Lista de Usuarios</h5>
				                <?php if(isset($this->sessionPermi['u_add'])): ?>
					                <div class="ibox-tools">
										<a href="<?=$this->pageAdd?>" class="btn btn-primary btn-m">Cadastrar</a>
					                </div>
					            <?php endIf ?>
				            </div>
				            <?php
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                            ?>
                        	<span class="col-lg-12 bg-success" id="msg"></span>
				            <div class="ibox-content">
				            	<div class="table-responsive">
				            		<form action="" method="POST">
				            			<input type="text" class="form-control input-sm m-b-xs" id="search_name" name="search_name" placeholder="Buscar usuario">
				            		</form>

					                <table class="footable table table-bordered table-hover dataTables-example">
					                    <thead>
						                    <tr>
						                        <th>ID</th>
						                        <th>Data expiração</th>
						                        <th>Nome</th>
						                        <th>E-mail</th>
												<?php if(isset($this->sessionPermi['u_delete']) === false && isset($this->sessionPermi['u_edit']) === false && isset($this->sessionPermi['u_add']) === false && isset($this->sessionPermi['u_view']) === false) :?>
					                            	<th class="list-head-content" style="width: 200px;">Sem permiçoes</th>
					                            <?php else: ?>
					                            	<th class="list-head-content" style="width: 200px;">Ações</th>
					                            <?php endif?>
						                    </tr>
					                    </thead>
					                    <tbody>
			    							<?php foreach ($data as $user): ?>
							                    <tr class="gradeX">
							                        <td><?=$user['id']?></td>
							                        <td><?=date("d/m/Y", strtotime($user['date_expiry']))?> <?=($user['date_expiry'] < date("Y-m-d")) ? "Expirado" : ""?></td>
							                        <td><?=$user['name']?></td>
							                        <td><?=$user['email']?></td>
							                        <td>
														<?php if(isset($this->sessionPermi['u_edit'])): ?>
															<a href="<?=$this->pageEdit . '/' . $user['id']?>" class="btn btn-warning btn-m"><i class="fa fa-pencil"></i></a>
														<?php endif ?>
														<?php if(isset($this->sessionPermi['u_delete'])): ?>
															<a href="<?=$this->pageDelete . '/' . $user['id']?>" class="btn btn-danger btn-m" onclick="return confirm('Deseja excluir esse registro?')"><i class="fa fa-trash-o"></i></a>
														<?php endif ?>
							                        </td>
							                    </tr>
											<?php endforeach?>
					                    </tbody>
					                    <tfoot>
				                            <tr>
				                                <td colspan="5">
				                                    <ul class="pagination pull-right"></ul>
				                                </td>
				                            </tr>
			                            </tfoot>
					                </table>
					            </div>
					        </div>
				    	</div>
					</div>
				</div>
			</div>
        </div>
    </div>

        <script src="<?= URLADM ?>app/adms/assets/js/jquery.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/bootstrap.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/footable/footable.all.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/user/list.js"></script>


    </body>
</html>
