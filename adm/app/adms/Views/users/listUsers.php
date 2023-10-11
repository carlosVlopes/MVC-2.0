<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
	    <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Lista de Usuarios</h5>
	                <div class="ibox-tools">
						<a href="<?= URLADM?>add-user/index" class="btn btn-primary btn-m">Cadastrar</a>
	                </div>
	            </div>
	            <div class="ibox-content">

	            	<div class="table-responsive">
	            		<form action="" method="POST">
	            			<input type="text" class="form-control input-sm m-b-xs" id="search_name" name="search_name" placeholder="Buscar usuario">
	            		</form>

		                <table class="table table-bordered table-hover dataTables-example">
		                    <thead>
			                    <tr>
			                        <th>ID</th>
			                        <th>Data expiração</th>
			                        <th>Nome</th>
			                        <th>E-mail</th>
									<?php if(isset($this->data['permissions']['u_delete']) === false && isset($this->data['permissions']['u_edit']) === false && isset($this->data['permissions']['u_add']) === false && isset($this->data['permissions']['u_view']) === false) :?>
		                            	<th class="list-head-content" style="width: 200px;">Sem permiçoes</th>
		                            <?php else: ?>
		                            	<th class="list-head-content" style="width: 200px;">Ações</th>
		                            <?php endif?>
			                    </tr>
		                    </thead>
		                    <tbody>
    							<?php foreach ($this->data['listUsers'] as $user): ?>
				                    <tr class="gradeX">
				                        <td><?=$user['id']?></td>
				                        <td><?=date("d/m/Y", strtotime($user['date_expiry']))?> <?=($user['date_expiry'] < date("Y-m-d")) ? "Expirado" : ""?></td>
				                        <td><?=$user['name']?></td>
				                        <td><?=$user['email']?></td>
				                        <td>
				                        	<?php if(isset($this->data['permissions']['u_view'])): ?>
												<a href="<?= URLADM?>view-user/index/<?=$user['id']?>" class="btn btn-primary btn-m"><i class="fa fa-eye"></i></a>
											<?php endif ?>
											<?php if(isset($this->data['permissions']['u_edit'])): ?>
												<a href="<?= URLADM?>edit-user/index/<?=$user['id']?>" class="btn btn-warning btn-m"><i class="fa fa-pencil"></i></a>
											<?php endif ?>
											<?php if(isset($this->data['permissions']['u_delete'])): ?>
												<a href="<?= URLADM?>edit-user/delete/<?=$user['id']?>" class="btn btn-danger btn-m" onclick="return confirm('Deseja excluir esse registro?')"><i class="fa fa-trash-o"></i></a>
											<?php endif ?>
				                        </td>
				                    </tr>
								<?php endforeach?>
		                    </tbody>
		                </table>
		            </div>
		        </div>
	    	</div>
		</div>
	</div>
</div>