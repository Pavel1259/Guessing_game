<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Клиент</title>
<script src="jquery-1.7.2.min.js"></script>
</head>
<body>
<table>
<tr>
	<td>
		<p>Пользователь:</p>
		<p>Баланс:</p>
		<div id="status"></div>
	</td>
</tr>
<tr>
	<td>
		<p class="coefficient">5.7</p>
		<div class="buttons">
			<input type="button" name="take" value="Взять" class="take"/>
			<input type="button" name="put" value="Поставить" />
		</div>
	</td>
	<td>
		<div class="history" style="float:right;">
		<h2>История</h2>
			<p>1.4</p>
			<p>2.3</p>
			<p>2.0</p>
			<p>2.1</p>
			<p>2.5</p>
		</div>
	</td>
</table>

<script>
window.onload = function(){
	var socket = new WebSocket("ws://echo.websocket.org");
	var status = document.querySelector("#status");
	// открытие соединения
	socket.onopen = function(){
		status.innerHTML = "соединение установлено";
	}
	
	// закрытие соединения
	socket.onclose = function(event){
		if(event.wasClean){
			console.log("соединение закрыто");
		}else{
			console.log("соединение как-то закрыто");
		}
		console.log("код" + event.code + " причина: " + event.reason);
	}
	
	// получение данных
	socket.onmessage = function(){
		//status.innerHTML = "Пришли данные" + event.data;
		var message = JSON.parse(event.data);
		console.log(message);
		status.innerHTML = "Пришли даные: " + message.name + " " + message.msg;
	}
	
	// возникновение ошибки
	socket.onerror = function(){
		status.innerHTML = "Ошибка: " + event.message;
	}
	// отправка
	jQuery(".take").bind("click", function() {
		var message = {
			name: "Hello!!!",
			msg: "Web"
		}
		socket.send(JSON.stringify(message));
		return false;
	});
}
</script>
</body>

</html>
