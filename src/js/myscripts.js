
function swichButtnDisable (buttnName, value) {
		buttnName.disabled = value;

}
	
function displayHTML(form) {
	var inf = form.value;
	win = window.open(", ", 'popup', 'toolbar = no, status = no', "width=100,height=90");
	win.document.write("<pre>" + inf + "</pre>");
}

function XmlHttp()	{
		var xmlhttp;
		try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
		catch(e)
		{
		 try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");} 
		 catch (E) {xmlhttp = false;}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		{
		 xmlhttp = new XMLHttpRequest();
		}
		  return xmlhttp;
	}
	 
function reqAjaxJsun(param,ContType="")
{
	if (window.XMLHttpRequest) req = XmlHttp(); 
					!req?console.log("Объект req несоздан"):console.log("Объект req создан");
	method = (!param.method ? "POST" : param.method.toUpperCase());
	if(method=="GET"){
	   send=null;
	   param.url=param.url+"&ajax=true";
	}
	else {
	   send="";
	   for (var i in param.data) send+= i+"="+param.data[i]+"&";
	   send=send+"ajax=true";
	}
	

	req.open(method, param.url, true);
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(send);
	
	req.onreadystatechange = function()
	{
	   if (req.readyState == 4 && req.status == 200) { //если ответ положительный
			if(param.success) {
				console.log("зона success");
				console.log(req.responseText);
				var data = eval("(" + req.responseText + ")");
				param.success(data); 
			}
		   
	   }
	}
}