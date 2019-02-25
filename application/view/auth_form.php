<form class="form-inline login" >
  <div class="form-group">
	<label class="sr-only" for="username">Логин</label>
	<input type="text" class="form-control" id="username" placeholder="Логин">
  </div>
  <div class="form-group">
	<label class="sr-only" for="pass">Пороль</label>
	<input type="password" class="form-control" id="pass" placeholder="Пароль">
  </div>
  <button type="button" class="btn btn-default" 
			onclick='reqAjaxJsun({
									url: "action_controller.php",
									method: "POST",
									data: {
										action:"login",
										login:document.querySelector("#username").value,
										pass:document.querySelector("#pass").value
									},
									success: function(data){
										if (data.errauth){									
											document.getElementById("errmsg").innerHTML = data.errmsg;
										} else {
											
											document.getElementById("user_view").innerHTML = data.user_panel;
										}
									}
								})'>Войти</button>
<span id="errmsg"></span>
</form>