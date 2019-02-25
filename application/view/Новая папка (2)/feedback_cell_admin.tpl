<div class="col-md-12"> 
	<div class="panel panel-default">
		<div class="panel-heading panel-heading2">
			<span>%name%</span>
			<span class = "pull-right">%date%</span>
		</div>
		<div class="panel-body my-panel-body">
		
			<div class="row">
				<form action = "action_controller.php" method = "POST">
					<div class = "col-md-9"> 
						<div id="alertmsg_%fb_id%">
							<div class="alert %alert_type%" role="alert">%alert_text%</div>
							<!--<div class="alert alert-info" role="alert">2</div>
							<div class="alert alert-danger" role="alert">4</div> 
							<div class="alert alert-success" role="alert">4</div>
							-->
						</div>
					</div>
					
					<div class = "col-md-1">
						<button disabled type="button" name="savebtn" id = "savebtn" class="btn btn-default mess-button" title = "Сохранить"
								onclick='reqAjaxJsun({
								url: "action_controller.php",
								method: "POST",
								data: {
									savebtn:1,
									text:document.querySelector("#feedback_%fb_id%").value
								},
								success: function(data){
								
										document.getElementById("edited-mess_%fb_id%").innerHTML = data.mess;
										swichButtnDisable(document.getElementById("savebtn"), true);
								}
							})}'>
							<span class = "glyphicon glyphicon-floppy-disk "></span>
						</button>
					</div>
					<div class = "col-md-1">
						<button type="button" name="approvebtn" class="btn btn-default mess-button" title = "Одобрить" 
								onclick='reqAjaxJsun({
								url: "action_controller.php",
								method: "POST",
								data: {
									approvebtn:1,
								},
								success: function(data){
								
										document.getElementById("alertmsg_%fb_id%").innerHTML = "";
										document.getElementById("alertmsg_%fb_id%").innerHTML = data.text;
								}
							})}'>
							<span class = "glyphicon glyphicon-ok "></span>
						</button>
					</div>
					<div class = "col-md-1">
						<button type="button" name="rejectbtn" class="btn btn-default mess-button" title = "Отказать"
								onclick='reqAjaxJsun({
								url: "action_controller.php",
								method: "POST",
								data: {
									rejectbtn:1,
								},
								success: function(data){
								
										document.getElementById("alertmsg_%fb_id%").innerHTML = "";
										document.getElementById("alertmsg_%fb_id%").innerHTML = data.text;
								}
							})}'>
							<span class = "glyphicon glyphicon-remove"></span>
						</button>
					</div>
					<div class = "col-md-12">
					</div>
					
					<div class="col-md-2 ">
						<p> <img src = "%imgsrc%"> </p>
						<p> <a href="mailto:%email%">%email%</a> </p>
						<p id="edited-mess_%fb_id%" class = "edited-mess">%editmsg%</p>
					</div>
					<div class="col-md-10 ">
						<textarea id="feedback_%fb_id%" class="form-control" rows="3" onchange = "swichButtnDisable(document.getElementById('savebtn'), false)">
						</textarea>
					</div>
				</form>
			</div>
			
		</div>	
			
	</div>
	
</div>