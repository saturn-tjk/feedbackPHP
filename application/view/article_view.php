<div class="content">
	<div class="container">
		<div class="row">
			<div class="card-row clearfix">
			
				<div class="col-md-3">
					<div id="left_side">
						<div class="panel panel-default">
							<div class="panel-heading"><h5>Статьи</h5></div>
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked nav">
								
								<?php for ($i=0; $i<count($model->art_title_list); $i++){?>
								  <li role="presentation">
								  <a href="<?=$model->config->address."?view=article&art_id=".$model->art_title_list[$i]["id"]?>">
								  <?=$model->art_title_list[$i]["title"]?></a></li>
								<?php }?>
								
								</ul>								
							</div>	
						</div>
					</div>

				</div>
				
				<div class="col-md-9">
				
					<div class="row">
						<div id="article">
							<h2><center><?=$model->article_text[0]["title"]?></center></h2>
							<p> 
								<?=$model->article_text[0]["text"]?>
							</p>
							<hr>
						</div>
						<div class="col-md-12 ">
						<?php if (count($model->feed_list)>0) {?>
							<div id="sort_feedback">
								<pre class = "sort-link"><p><b> Сортировать</b>		по дате: <a href = "<?=$model->config->address."?view=article&art_id=".$model->article_text[0]["id"]."&feedsort=date"?>">нов к стар</a>||<a href = "<?=$model->config->address."?view=article&art_id=".$model->article_text[0]["id"]."&feedsort=date&up=1"?>">стар к нов</a>     по имени: <a href = "<?=$model->config->address."?view=article&art_id=".$model->article_text[0]["id"]."&feedsort=name_commented&up=1"?>">A-Z</a>||<a href = "<?=$model->config->address."?view=article&art_id=".$model->article_text[0]["id"]."&feedsort=name_commented"?>">Z-A</a>     по email: <a href = "<?=$model->config->address."?view=article&art_id=".$model->article_text[0]["id"]."&feedsort=email&up=1"?>">A-Z</a>||<a href = "<?=$model->config->address."?view=article&art_id=".$model->article_text[0]["id"]."&feedsort=email"?>">Z-A</a></p></pre>
							</div>
						<?php }else echo "<p>Нет отзывов.</p>"?>
						</div>
	<!-- -----------------------------FeedBacks------------------------------------------------------------ -->
						<div id="feedback_cell">
						<?php for ($i=0; $i<count($model->feed_list); $i++){?>
							<div class="col-md-12"> 
								<div class="panel panel-default">
									<div class="panel-heading">
									<span><?=$model->feed_list[$i]["name_commented"]?></span>
									<span class = "pull-right"><?=$model->feed_list[$i]["date"]?></span>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-2 ">
											<p> <img src = "<?=$model->feed_list[$i]["imgsrc"]?>"> </p>
											<p> <a href="mailto:<?=$model->feed_list[$i]["email"]?>"><?=$model->feed_list[$i]["email"]?></a> </p>
											<p class = "edited-mess"> <?=$model->feed_list[$i]["edited_msg"]?> </p>
											</div>
											<div class="col-md-10 ">
											<?=$model->feed_list[$i]["text"]?>
											</div>
										</div>
									</div>						
								</div>
							</div>
						<?php }?>	
						</div>
	<!-- -------------------------------------------------------------------------------------------->
					
					</div>			
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-9">
					<hr>
					<form action="action_controller.php" method = "POST" name="feedback_form" enctype="multipart/form-data">
						 <p>Внимание! Ваше сообщение будет опубликово после проверки администратором! </p>
						 <div class="form-group">
							<label for="feedback_form_name">Имя</label>
							<input type="text" name="feedback_form_name" required class="form-control" id="feedback_form_name" placeholder="Имя">
						  </div>
						  <div class="form-group">
							<label for="feedback_form_email">Email</label>
							<input type="email" name="feedback_form_email" required class="form-control" id="feedback_form_email" placeholder="Email">
						  </div>
						  
						  <textarea class="form-control" name="feedback_form_area" rows="3" required onchange='document.getElementById("feedback_form_alert").innerHTML=""'></textarea>
						  
						  <div class="form-group">
							<input type="hidden" name="MAX_FILE_SIZE" value="300000">
							<label for="feedback_form_inputfile">Загрузить изображения</label>
							<input type="file" name="userfile" id="feedback_form_inputfile">
							<input type="hidden" name="action" value="addfeedback">
							<input type="hidden" name="art_id" value="<?=$model->article_text[0]["id"]?>">
						  </div>
						  
					    <button type="submit" name="sendFeedBack" value="" class="btn btn-default">Отправить</button>
				  
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"
									onclick="document.getElementById('modal-body').innerHTML=this.form.feedback_form_area.value">
							Предворительный просмотр
						</button>
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Предворительный просмотр</h4>
							  </div>
							  <div class="modal-body" id="modal-body">
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">
										Закрыть
								</button>
							  </div>
							</div>
						  </div>
						</div>
						  
					</form>
				</div>
				
			</div>
		</div>
	</div>
	
</div>