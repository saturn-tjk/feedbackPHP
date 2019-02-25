<div class = "user-panel">
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle user-button" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		<?=$_SESSION["username"]; ?>	
		<span class="glyphicon glyphicon-user user-icon" aria-hidden="true"></span>
		<span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu user-menu" aria-labelledby="dropdownMenu2">
			  <?php if($model) $address =  $model->config->address;
			  		else $address = $this->config->address;
			  ?>
		<li><a href="<?=$address."?view=".$_SESSION["userstatus"]?>">Кабинет</a></li>
		<li><a href="<?=$address."action_controller.php?action=logout"?>">Выход</a></li>
	  </ul>
	</div>
</div>