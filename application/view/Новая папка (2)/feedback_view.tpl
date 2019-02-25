<div class="content">
	<div class="container">
		<div class="row">
			<div class="card-row clearfix">
			
				<div class="col-md-3">
					<div id="left_side">
						%art_lefr_side%
					</div>
					
				</div>
				
				<div class="col-md-9">
				
					<div class="row">
						<div class="col-md-12 ">
						<div id="sort_feedback">
							%sort_feedback%
						</div>
						</div>
						<div id="feedback_cell">
							%feedback_cell%
						</div>
					</div>
								
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-9">
					<hr>
					<form "action_controller.php" method = "POST" name="feedback_form">
						 <div class="alert alert-success" id="feedback_form_alert" role="alert"></div>
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
							<label for="feedback_form_inputfile">Загрузить изображения</label>
							<input type="file" name="userfile" id="feedback_form_inputfile">
						  </div>
						  
						  <button type="button" name="sendFeedBack" class="btn btn-default"
									onclick='reqAjaxJsun({
									url: "action_controller.php",
									method: "POST",
									data: {
										name:document.getElementById("feedback_form_name").value,
										email:document.getElementById("feedback_form_email").value,
										text:document.getElementByName("feedback_form_area").value,
										img:document.getElementByName("userfile").value
									},
									success: function(data){
									
										document.getElementById("feedback_form_alert").innerHTML = "Ваш отзыв был успешно отправлен и будет опубликоман после одобрения аминистратором!";
										document.getElementById("feedback_form").reset();
									}
								})}'>Отправить</button>
						  
						  <button type="button" class="btn btn-default" onclick="displayHTML(this.form.feedback_form_area)">Предворительный просмотр</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
	
</div>