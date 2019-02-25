<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$model->getTitle();?></title>
		<link href="src/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="src/css/mystyle.css">
		<script src="src/js/myscripts.js"></script>
	</head>
  <body>
    <header>
		<div class="header2 page-header">

			<div id = "user_view">
				<?php
				if ($_SESSION["username"]) include "application/view/user_panel.php";
				else include "application/view/auth_form.php";
				?>	  
			</div>
			<div class="home-link">
			<a href=<?=$model->config->address?>><span class="glyphicon glyphicon-home"></span></a>
			</div>
		</div>
	</header>

	<?php include "application/view/".$content_tpl; ?>
	
	<footer>
		<div class="container">
			<hr>
			<address class="pull-right">
			  <strong>Alisher</strong><br>
			  a.nuraliev85@gmail.com<br>
			  <abbr title="Phone">Ph: (+992) 905005746 </abbr>
			</address>
		</div>
	</footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
	
  </body>
</html>