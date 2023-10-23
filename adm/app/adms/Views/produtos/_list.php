<?php include 'app/adms/Views/include/head.php';?>
<?php include 'app/adms/Views/include/navbar.php';?>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="ibox float-e-margins">
				        	<?php if(!$error): ?>
					            <div class="ibox-title">
					                <h5>Lista de Produtos</h5>
					                <?php if(isset($this->sessionPermi['u_add'])): ?>
						                <div class="ibox-tools">
											<a href="<?= $this->pageAdd?>" class="btn btn-primary btn-m">Cadastrar</a>
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
					            			<input type="text" class="form-control input-sm m-b-xs" id="search_name" name="search_name" placeholder="Buscar produto">
					            		</form>

						                <table class="table table-bordered table-hover dataTables-example">
						                    <thead>
							                    <tr>
							                    	<th style="width: 200px;">Imagem</th>
							                        <th>Nome</th>
							                        <th>Descrição</th>
							                        <th>Preço</th>
							                        <th style="width: 200px;">Ordem</th>
													<?php if(isset($this->sessionPermi['u_delete']) === false && isset($this->sessionPermi['u_edit']) === false && isset($this->sessionPermi['u_add']) === false && isset($this->sessionPermi['u_view']) === false) :?>
						                            	<th class="list-head-content" style="width: 200px;">Sem permiçoes</th>
						                            <?php else: ?>
						                            	<th class="list-head-content" style="width: 145px;">Ações</th>
						                            <?php endif?>
							                    </tr>
						                    </thead>
						                    <tbody>
				    							<?php foreach ($data as $product): ?>

				    								<?php $image = ($product['image']) ? 'adm/app/adms/Views/images/products/' . $product['image'] : ''?>

								                    <tr class="gradeX">
								                        <td><img src="<?= ($image) ? URL . $image : ''?>" style="width:100px;"></td>
								                        <td><?=$product['name']?></td>
								                        <td><?=$product['description']?></td>
								                        <td><?=$product['price']?></td>
								                        <td>
															<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
	                                                        <span class="text-order"><?=$product['orderby']?></span>
	                                                        <input type="number" min="1" value="<?=$product['orderby']?>" name="orderby" style="display:none; width:80%;" class="form-control">
	                                                        <a href="javascript:;" class="edit-order pull-right btn btn-success btn-m btn-outline" style="font-size:13px;"><i class="fa fa-pencil"></i></a>
	                                                        <a href="javascript:;" class="save-order pull-right btn btn-warning btn-m btn-outline" style="font-size:13px; display:none;"><i class="fa fa-floppy-o"></i></a>
								                        </td>
								                        <td>
								                        	<a href="<?= $this->pageGaleria . '/' . $product['id']?>" class="btn btn-success btn-m" title="Galeria"><i class="fa fa-camera"></i></a>
															<?php if(isset($this->sessionPermi['u_edit'])): ?>
																<a href="<?= $this->pageEdit . '/' . $product['id']?>" class="btn btn-warning btn-m" title="Editar"><i class="fa fa-pencil"></i></a>
															<?php endif ?>
															<?php if(isset($this->sessionPermi['u_delete'])): ?>
																<a href="<?= $this->pageDelete . '/' . $product['id']?>" class="btn btn-danger btn-m" onclick="return confirm('Deseja excluir esse registro?')" title="Excluir"><i class="fa fa-trash-o"></i></a>
															<?php endif ?>
								                        </td>
								                    </tr>
												<?php endforeach?>
						                    </tbody>
						                </table>
						            </div>
						        </div>
						    <?php else: ?>
						    	<div class="ibox-title">
					                <h5>Nenhum produto encontrado</h5>
					            </div>
					            <div class="ibox-content">
	                                <div class="row">
	                                	<a href="<?=$this->pageAdd?>" class="btn btn-primary btn-m"><i class="fa fa-plus"></i> Cadastrar</a>
	                                	<a href="<?=$this->pageReturn?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
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
        <script src="<?= URLADM ?>app/adms/assets/js/pages/products/products-actions.js"></script>

    </body>
</html>
