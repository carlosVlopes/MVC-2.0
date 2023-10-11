<?php


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
                <span class="title-content">Token API</span>
            </div>
            <?php
	            if(isset($_SESSION['msg'])){
	                echo $_SESSION['msg'];
	                unset($_SESSION['msg']);
	            }
	        ?>
            <div class="content-adm">
	            <form method="POST" action="" id="form-add-user" class="form-adm">
	            	<?php if(!empty($this->data['token_api'])): ?>
		                <div class="row-input">
		                    <div class="column">
		                        <label class="title-input">Token</label>
		                        <input type="text" name="token" id="token" class="input-adm" value="<?= $this->data['token_api'] ?>">
		                    </div>
		                </div>
	                	<button type="submit" name="newToken" class="btn-success" value="newToken">Gerar Novo Token</button>
	                <?php else:?>
	                	<span>Voçê ainda não possui um token, clique no botão abaixo para gerar.</span><br><br>
	                	<button type="submit" name="newToken" class="btn-success" value="newToken">Gerar Token</button>
					<?php endif ?>
	            </form><br>
	            <h4>Para utilizar a API utilize esse token da seguinte forma:</h4><br>
	            <span>Caso deseja pegar algum usuario pelo id: <strong>GET</strong></span><br><br>
	            <span><?= URLADM ?>api/user/<strong>{id do usuario}</strong>?token=<strong>{token gerado}</strong></span><br><br>
	            <span>Caso deseja adicionar um usuario: <strong>POST</strong></span><br><br>
	            <span><?= URLADM ?>api/user?token=<strong>{token gerado}</strong></span>
        	</div>
	    </div>
	</div>
</body>
</html>


