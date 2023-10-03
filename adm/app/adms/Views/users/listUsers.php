<?php

	$values = false;

	if($this->data){
		$values = true;
	}

	if($this->data['error']){
		$values = false;
	}

    // echo '<pre>';
    // print_r($this->data);
    // echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width='device-width', initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<?php if($values): ?>

		<div class="wrapper">
            <div class="row">
                <div class="top-list">
                    <span class="title-content">Listar</span>
                    <div class="top-list-right">
                    	<?php if(isset($this->data['permissions']['u_add'])): ?>
                        	<a href="<?=URLADM?>add-user/index" class="btn-success">Cadastrar</a>
                        <?php endif?>
                    </div>
                </div>

				<div class="top-list">
					<form method="POST" action="">
						<div class="row-input-search">
							<div class="column">
								<label class="title-input-search">Nome: </label>
								<input type="text" name="search_name" id="search_name" class="input-search">
							</div>
							<div class="column">
								<label class="title-input-search">Email: </label>
								<input type="text" name="search_email" id="search_email" class="input-search">
							</div>
							<div class="column margin-top-search">
								<button type="submit" name="search_user" class="btn-info" value="pesquisa">Pesquisar</button>
							</div>
						</div>
					</form>
					<form method="POST" action="">
						<div class="column">
							<label class="title-input-search">Quantidade de registros: </label>
							<select name="qnt_records">
								<option value="10" <?=($this->data['qnt_records'] == 10) ? "selected" : ''?>>10</option>
								<option value="15" <?=($this->data['qnt_records'] == 15) ? "selected" : ''?>>15</option>
								<option value="20" <?=($this->data['qnt_records'] == 20) ? "selected" : ''?>>20</option>
								<option value="25" <?=($this->data['qnt_records'] == 25) ? "selected" : ''?>>25</option>
								<option value="100" <?=($this->data['qnt_records'] == 100) ? "selected" : ''?>>100</option>
							</select>
							<button type="submit" name="btn_records" value="btn_records">Qnt</button>
						</div>
					</form>
				</div>
            	<?php
					if(isset($_SESSION['msg'])){
					    echo $_SESSION['msg'];
					    unset($_SESSION['msg']);
					}
				?>
                <table class="table-list">
                    <thead class="list-head">
                        <tr>
                            <th class="list-head-content">ID</th>
                            <th class="list-head-content">Data expiração</th>
                            <th class="list-head-content">Nome</th>
                            <th class="list-head-content table-sm-none">E-mail</th>
                            <?php if(isset($this->data['permissions']['u_delete']) === false && isset($this->data['permissions']['u_edit']) === false && isset($this->data['permissions']['u_add']) === false && isset($this->data['permissions']['u_view']) === false) :?>
                            	<th class="list-head-content" style="width: 200px;">Sem permiçoes</th>
                            <?php else: ?>
                            	<th class="list-head-content" style="width: 200px;">Ações</th>
                            <?php endif?>
                        </tr>
                    </thead>
                    <tbody class="list-body">
						<?php foreach ($this->data['listUsers'] as $user): ?>
	                        <tr>
	                            <td class="list-body-content"><?=$user['id']?></td>
	                            <td class="list-body-content"><?=date("d/m/Y", strtotime($user['date_expiry']))?> <?=($user['date_expiry'] < date("Y-m-d")) ? "Expirado" : ""?></td>
	                            <td class="list-body-content"><?=$user['name']?></td>
	                            <td class="list-body-content table-sm-none"><?=$user['email']?></td>
	                            <td class="list-body-content">
	                            	<?php if(isset($this->data['permissions']['u_view'])): ?>
										<a href="<?= URLADM?>view-user/index/<?=$user['id']?>" class="btn-primary"><i class="fa-solid fa-eye"></i></a>
									<?php endif ?>
									<?php if(isset($this->data['permissions']['u_edit'])): ?>
										<a href="<?= URLADM?>edit-user/index/<?=$user['id']?>" class="btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
									<?php endif ?>
									<?php if(isset($this->data['permissions']['u_delete'])): ?>
										<a href="<?= URLADM?>edit-user/delete/<?=$user['id']?>" class="btn-danger" onclick="return confirm('Deseja excluir esse registro?')"><i class="fa-solid fa-trash-can"></i></a>
									<?php endif ?>
	                            </td>
	                        </tr>
						<?php endforeach?>
                    </tbody>
                </table>

               	<?=($this->data['pagination']) ? $this->data['pagination'] : ''?>

            </div>
        </div>
        <!-- Fim do conteudo do administrativo -->

	<?php else: ?>

		<h1>Nenhum Usuario encontrado!</h1>

	<?php endif ?>

</body>
</html>