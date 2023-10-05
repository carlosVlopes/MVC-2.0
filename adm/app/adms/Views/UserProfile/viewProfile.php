<?php


	$values = false;

	extract($this->data['user'][0]);

	$image = ($image !='') ? 'adm/app/adms/Views/images/users/' . $image : '';

	if($this->data){
		$values = true;
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width='device-width', initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div class="wrapper">
        <div class="row">
            <div class="top-list">
                <span class="title-content">Perfil</span>
                <div class="top-list-right">
					<?php if(isset($this->data['sessionPermi']['u_edit'])): ?>
                    	<a href="<?= URLADM?>edit-user/index/<?=$id?>" class="btn-warning">Editar</a>
                    <?php endif?>
                </div>
            </div>

			<?php if($values): ?>

				<div class="content-adm">
	                <div class="view-det-adm">
	                    <span class="view-adm-title">Foto: </span>
	                    <span class="view-adm-info"><img src="<?= ($image) ? URL . $image : ''?>" style="width:90px;"></span>
	                </div>

	                <div class="view-det-adm">
	                    <span class="view-adm-title">Nome: </span>
	                    <span class="view-adm-info"><?=$name?></span>
	                </div>

	                <div class="view-det-adm">
	                    <span class="view-adm-title">User: </span>
	                    <span class="view-adm-info"><?=$user?></span>
	                </div>

	                <div class="view-det-adm">
	                    <span class="view-adm-title">E-mail: </span>
	                    <span class="view-adm-info"><?=$email?></span>
	                </div>
	            </div>
	    </div>
	</div>
		        <?php else: ?>

					<h1>Nenhum Usuario encontrado!</h1>

				<?php endif ?>
</body>
</html>


