<div class="content">
	<div class="container">
		<div class="row">
		
			<div class="card-row clearfix">
			
				<div class="col-md-3">
					<div id="left_side">
						<div class="panel panel-default">
							<div class="panel-heading">Отзывы по категориям</div>
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked nav">
								  <li role="presentation"><a href="<?=$model->config->address."?view=admin&status_id=1"?>">Не проверенные</a></li>
								  <li role="presentation"><a href="<?=$model->config->address."?view=admin&status_id=3"?>">Отмененные</a></li>
								</ul>								
							</div>	
							
							<div class="panel-heading">Отзывы по статьям</div>
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked nav">
								
								<?php for ($i=0; $i<count($model->art_titles); $i++) {?>
									<li role="presentation">
									<a href="<?=$model->config->address."?view=admin&art_id=".$model->art_titles[$i]["id"]?>">
									<?=$model->art_titles[$i]["title"]?></a></li>
								<?php }?>
								
								</ul>			
							</div>
						</div>
					</div>				
				</div>
				<div class="col-md-9">
				
					<div class="col-md-12 ">
					<?php if (count($model->feeds)>0) {?>
						<div id="sort_feedback">
								<pre class = "sort-link"><p><b> Сортировать</b>		по дате: <a href = "<?=$model->config->address."?view=admin&".$model->where."&feedsort=date"?>">нов к стар</a>||<a href = "<?=$model->config->address."?view=admin&".$model->where."&feedsort=date&up=1"?>">стар к нов</a>     по имени: <a href = "<?=$model->config->address."?view=admin&".$model->where."&feedsort=name_commented&up=1"?>">A-Z</a>||<a href = "<?=$model->config->address."?view=admin&".$model->where."&feedsort=name_commented"?>">Z-A</a>     по email: <a href = "<?=$model->config->address."?view=admin&".$model->where."&feedsort=email&up=1"?>">A-Z</a>||<a href = "<?=$model->config->address."?view=admin&".$model->where."&feedsort=email"?>">Z-A</a></p></pre>
						</div>
					<?php } else echo "<p>Нет отзывов.</p>"?>
					</div>
	<!-- -------------------------------------------------------------------------------------------------->
					<div id = "feedback_cell">
					<?php for ($i=0; $i<count($model->feeds); $i++) {?>
						<div class="col-md-12"> 
							<div class="panel panel-default">
								<div class="panel-heading panel-heading2">
									<span><?=$model->feeds[$i]["name_commented"]?></span>
									<span class = "pull-right"><?=$model->feeds[$i]["date"]?></span>
								</div>
								<div class="panel-body my-panel-body">
								
									<div class="row">
										<form action = "action_controller.php" method = "POST">
											<div class = "col-md-9"> 
												<div id="alertmsg_<?=$model->feeds[$i]["id"]?>">
													<div class="alert <?=$model->feeds[$i]["alert_type"]?>" id="altype_<?=$model->feeds[$i]["id"]?>" role="alert"><?=$model->feeds[$i]["alert_text"]?></div>
												</div>
											</div>
											
											<div class = "col-md-1">
												<button disabled type="button" name="savebtn_<?=$model->feeds[$i]["id"]?>" id = "savebtn_<?=$model->feeds[$i]["id"]?>" 
																class="btn btn-default mess-button" title = "Сохранить" onclick='reqAjaxJsun({
														url: "action_controller.php",
														method: "POST",
														data: {
															action:"save_changes_in_feed_txt",
															feedback_id:<?=$model->feeds[$i]["id"]?>,
															text:document.querySelector("#feedback_<?=$model->feeds[$i]["id"]?>").value
														},
														success: function(data){
														
																document.getElementById("edited-mess_<?=$model->feeds[$i]["id"]?>").innerHTML = data;
																swichButtnDisable(document.getElementById("savebtn_<?=$model->feeds[$i]["id"]?>"), true);
														}
													})'>
													<span class = "glyphicon glyphicon-floppy-disk "></span>
												</button>
											</div>
											<div class = "col-md-1">
												<button type="button" name="approvebtn_<?=$model->feeds[$i]["id"]?>")" class="btn btn-default mess-button" title = "Одобрить" 
														onclick='reqAjaxJsun({
														url: "action_controller.php",
														method: "POST",
														data: {
															action:"allow_feed",
															feedback_id:"<?=$model->feeds[$i]["id"]?>",
														},
														success: function(data){
														
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").innerHTML = "";
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").className = "";
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").className = "alert alert-success";
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").innerHTML = data;
														}
													})'>
													<span class = "glyphicon glyphicon-ok "></span>
												</button>
											</div>
											<div class = "col-md-1">
												<button type="button" name="rejectbtn_<?=$model->feeds[$i]["id"]?>")" class="btn btn-default mess-button" title = "Отказать"
														onclick='reqAjaxJsun({
														url: "action_controller.php",
														method: "POST",
														data: {
															action:"reject_feed",
															feedback_id:<?=$model->feeds[$i]["id"]?>,
														},
														success: function(data){
														
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").innerHTML = "";
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").className = "";
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").className = "alert alert-danger";
																document.getElementById("altype_<?=$model->feeds[$i]["id"]?>").innerHTML = data;
														}
													})'>
													<span class = "glyphicon glyphicon-remove"></span>
												</button>
											</div>
											<div class = "col-md-12">
											</div>
											
											<div class="col-md-2 ">
												<p> <img src = "<?=$model->feeds[$i]["imgsrc"]?>"> </p>
												<p> <a href="mailto:<?=$model->feeds[$i]["email"]?>"><?=$model->feeds[$i]["email"]?></a> </p>
												<p id="edited-mess_<?=$model->feeds[$i]["id"]?>" class = "edited-mess"><?=$model->feeds[$i]["edited_msg"]?></p>
											</div>
											<div class="col-md-10 ">
												<textarea id="feedback_<?=$model->feeds[$i]["id"]?>" class="form-control feed_textatea" rows="3" 
													onchange = 'swichButtnDisable(document.getElementById("savebtn_<?=$model->feeds[$i]["id"]?>"), false)'><?=$model->feeds[$i]["text"]?></textarea>
											</div>
										</form>
									</div>
									
								</div>	
									
							</div>
							
						</div>
					<?php }?>
					</div>
	<!-- -------------------------------------------------------------------------------------------------->
				</div>
				
			</div>
		</div>
	</div>
</div>